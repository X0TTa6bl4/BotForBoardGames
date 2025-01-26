<?php

declare(strict_types=1);

return [
    'default' => [
        'type' => 'keyboard',
        'message' => 'Добро пожаловать',
        'handler' => \src\Telegraph\Infrastructure\Screen\Keyboard\MultiplayerMenu::class
    ],
    'multiplayerMenu' => [
        'type' => 'keyboard',
        'message' => 'Добро пожаловать',
        'handler' => \src\Telegraph\Infrastructure\Screen\Keyboard\MultiplayerMenu::class
    ],
    'connectToWorld' => [
        'type' => 'input',
        'message' => 'Введите публичный идентификатор мира',
        'handler' => \src\Telegraph\Infrastructure\Screen\Input\InputPublicId::class
    ],
    'mainMenu' => [
        'type' => 'keyboard',
        'message' => 'Главное меню',
        'handler' => \src\Telegraph\Infrastructure\Screen\Keyboard\MainMenu\MainMenu::class
    ],
    'createEntityMain' => [
        'type' => 'keyboard',
        'message' => 'Cоздание персонажа',
        'handler' => \src\Telegraph\Infrastructure\Screen\Keyboard\CreateEntityMainMenu::class
    ],
    'showEntities' => [
        'type' => 'keyboard',
        'message' => 'Список персонажей',
        'handler' => \src\Telegraph\Infrastructure\Screen\Keyboard\ShowEntitiesMenu::class
    ],
    'showAllEntities' => [
        'type' => 'keyboard',
        'message' => 'Список всех персонажей',
        'handler' => \src\Telegraph\Infrastructure\Screen\Keyboard\ShowAllEntitiesMenu::class
    ],
    'showAllEntitiesForAttack' => [
        'type' => 'keyboard',
        'message' => 'Список всех персонажей для атаки',
        'handler' => \src\Telegraph\Infrastructure\Screen\Keyboard\ShowAllEntitiesForAttackMenu::class
    ],
    'showAllEntitiesForHeal' => [
        'type' => 'keyboard',
        'message' => 'Список всех персонажей для лечения',
        'handler' => \src\Telegraph\Infrastructure\Screen\Keyboard\ShowAllEntitiesForHealMenu::class
    ],

    //inputs
    'setName' => [
        'type' => 'input',
        'message' => 'Введите имя',
        'handler' => \src\Telegraph\Infrastructure\Screen\Input\SetName::class
    ],
    'setHealthPoints' => [
        'type' => 'input',
        'message' => 'Введите количество очков здоровья',
        'handler' => \src\Telegraph\Infrastructure\Screen\Input\SetHealthPoints::class
    ],
    'setPower' => [
        'type' => 'input',
        'message' => 'Введите силу',
        'handler' => \src\Telegraph\Infrastructure\Screen\Input\SetPower::class
    ],
    'setInitiative' => [
        'type' => 'input',
        'message' => 'Введите инициативу',
        'handler' => \src\Telegraph\Infrastructure\Screen\Input\SetInitiative::class
    ],
    'setIntelligence' => [
        'type' => 'input',
        'message' => 'Введите интеллект',
        'handler' => \src\Telegraph\Infrastructure\Screen\Input\SetIntelligence::class
    ],
    'setProtection' => [
        'type' => 'input',
        'message' => 'Введите защиту',
        'handler' => \src\Telegraph\Infrastructure\Screen\Input\SetProtection::class
    ],
];
