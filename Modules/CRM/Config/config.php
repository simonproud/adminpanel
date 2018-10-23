<?php

return [
    'name' => 'CRM',
    'menu' => [

        'permissions' => ['crm.basic'],
        'order' => '10',
        'links' => [
            ['icon' => 'fa fa-address-book',
                'title' => 'CRM',
                'url' => '/crm',
                'caret' => true,
                'sub_menu' => [[
                    'url' => '/crm/leads',
                    'title' => 'Заявки'
                ],[
                    'url' => '/crm/orders',
                    'title' => 'Заказы'
                ],[
                    'url' => '/crm/clients',
                    'title' => 'Клиенты',
                ],[
                    'url' => '/crm/contacts',
                    'title' => 'Контакты'
                ],[
                    'url' => '/crm/settings',
                    'title' => 'Настройки',
                    'permissions' => 'crm.settings'
                ],
                ],
            ],
        ],

    ],
    'permissions' => [
        'crm.basic',
        'crm:permissions.role.edit',
        'crm:permissions.access.edit',
        'crm:permissions.role.delete',
        'crm:permissions.role.create',
        'crm:permissions.role.show'
    ],
    'models' => [
        'Lead', 'Order', 'Client', 'Contact'
    ],
    'cstm_models' => [
        'Client' => 'ClientCstm', 'Order' => 'OrderCstm', 'Contact' => 'ContactCstm', 'Lead' => 'LeadCstm'
    ]
];
