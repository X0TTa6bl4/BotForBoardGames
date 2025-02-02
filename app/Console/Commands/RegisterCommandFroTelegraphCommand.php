<?php

namespace App\Console\Commands;

use DefStudio\Telegraph\Models\TelegraphBot;
use Illuminate\Console\Command;

class RegisterCommandFroTelegraphCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'telegraph:register-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        /** @var TelegraphBot $bot */
        $bot = TelegraphBot::query()->find(1);

        $bot->registerCommands([
            'start' => 'Начинаем!',
            'menu' => 'Меню',
            'test' => 'Тест',
        ])->send();

        $this->info('Commands registered successfully');
        return 0;
    }
}
