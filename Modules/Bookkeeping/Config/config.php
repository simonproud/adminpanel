<?php

return [
    'name' => 'Bookkeeping',
    'menu' => [

        'permissions' => ['bookkeeping.basic'],
        'order' => '20',
        'links' => [
            ['icon' => 'fa fa-address-book',
                'title' => 'Бухгалтерия',
                'url' => '/bookkeeping',
                'caret' => false,
                'sub_menu' => [],
            ],
        ],

    ],
];
