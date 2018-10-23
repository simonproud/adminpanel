<?php

return [
    'name' => 'Structure',
    'menu' => [

        'permissions' => ['structure.basic'],
        'order' => '30',
        'links' => [
            ['icon' => 'fa fa-address-book',
                'title' => 'Структура',
                'url' => '/structure',
                'caret' => false,
                'sub_menu' => [
                ],
            ],
        ],

    ],
];
