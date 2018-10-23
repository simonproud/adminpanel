<?php

return [
    'name' => 'Import',
    'menu' => [

        'permissions' => ['import.basic'],
        'order' => '60',
        'links' => [
            ['icon' => 'fas fa-file-import',
                'title' => 'Import/Export',
                'url' => '/import',
                'caret' => false,
                'sub_menu' => [/*[
                    'url' => '/crm/leads',
                    'title' => 'Заявки'
                ],[
                    'url' => '/crm/orders',
                    'title' => 'Заказы'
                ],[
                    'url' => '/crm/clients',
                    'title' => 'Контакты'
                ],*/
                ],
            ],
        ],

    ],
];
