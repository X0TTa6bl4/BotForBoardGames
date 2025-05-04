#!/bin/sh
set -e

# Ждем Ngrok (проверяем доступность API)
until curl -s http://ngrok:4040/api/tunnels > /dev/null; do
    echo "Ожидание Ngrok..."
    sleep 1
done

# Получаем URL Ngrok
NGROK_URL=$(curl -s http://ngrok:4040/api/tunnels | jq -r '.tunnels[0].public_url')
echo "Получен URL Ngrok: $NGROK_URL"

# Путь к .env (явно указываем /www/.env)
ENV_FILE="/www/.env"

# Проверяем существование .env
if [ ! -f "$ENV_FILE" ]; then
    echo "Ошибка: .env не найден в $ENV_FILE!"
    exit 1
fi

# Обновляем APP_URL
if grep -q "APP_URL=" "$ENV_FILE"; then
    sed -i "s|APP_URL=.*|APP_URL=$NGROK_URL|" "$ENV_FILE"
else
    echo "APP_URL=$NGROK_URL" >> "$ENV_FILE"
fi

echo "Обновлен .env: $(grep 'APP_URL=' "$ENV_FILE")"

# Даем время на применение
sleep 2

# Чистим кэш Laravel и устанавливаем вебхук
php artisan config:clear
php artisan telegraph:set-webhook

echo "Вебхук установлен на $NGROK_URL"

exec "$@"
