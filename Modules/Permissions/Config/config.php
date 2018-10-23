<?php

return [
    'name' => 'Permissions',
    'menu' => [

           'permissions' => ['permissions.basic'],
            'order' => '999',
            'links' => [
                ['icon' => 'fa fa-lock',
                'title' => 'Настройки доступа',
                'url' => '/permissions',
                'caret' => true,
                'sub_menu' => [[
                    'url' => '/permissions/role/create',
                    'title' => 'Создать роль'
                ],
                ],
                ],
            ],

    ],
    'permissions' => [
        'permission:permissions.basic',
        'permission:permissions.role.edit',
        'permission:permissions.access.edit',
        'permission:permissions.role.delete',
        'permission:permissions.role.create',
        'permission:permissions.role.show'
    ]
];
