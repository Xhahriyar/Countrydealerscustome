<?php

use App\Enums\PermissionEnum;

return [
    'dashboard' => [
        [
            'name' => PermissionEnum::DASHBOARD(),
            'label' => 'DASHBOARD',
            'is_visible' => false,
            'sort_order' => 50
        ],
        [
            'name' => PermissionEnum::DASHBOARD_VIEW(),
            'label' => 'View',
            'is_visible' => true,
            'sort_order' => 100
        ],
    ],
    'employee' => [
        [
            'name' => PermissionEnum::EMPLOYEE(),
            'label' => 'EMPLOYEE',
            'is_visible' => false,
            'sort_order' => 2050
        ],
        [
            'name' => PermissionEnum::EMPLOYEE_LIST(),
            'label' => 'List',
            'is_visible' => true,
            'sort_order' => 2100
        ],
        [
            'name' => PermissionEnum::EMPLOYEE_VIEW(),
            'label' => 'View',
            'is_visible' => true,
            'sort_order' => 2150
        ],
        [
            'name' => PermissionEnum::EMPLOYEE_CREATE(),
            'label' => 'Create',
            'is_visible' => true,
            'sort_order' => 2200
        ],
        [
            'name' => PermissionEnum::EMPLOYEE_STORE(),
            'label' => 'Store',
            'is_visible' => true,
            'sort_order' => 2250
        ],
        [
            'name' => PermissionEnum::EMPLOYEE_EDIT(),
            'label' => 'Edit',
            'is_visible' => true,
            'sort_order' => 2300
        ],
        [
            'name' => PermissionEnum::EMPLOYEE_UPDATE(),
            'label' => 'Update',
            'is_visible' => true,
            'sort_order' => 2350
        ],
        [
            'name' => PermissionEnum::EMPLOYEE_DELETE(),
            'label' => 'Delete',
            'is_visible' => true,
            'sort_order' => 2400
        ],
    ],
    'client' => [
        [
            'name' => PermissionEnum::CLIENT(),
            'label' => 'CLIENT',
            'is_visible' => false,
            'sort_order' => 4050
        ],
        [
            'name' => PermissionEnum::CLIENT_LIST(),
            'label' => 'List',
            'is_visible' => true,
            'sort_order' => 4100
        ],
        [
            'name' => PermissionEnum::CLIENT_VIEW(),
            'label' => 'View',
            'is_visible' => true,
            'sort_order' => 4150
        ],
        [
            'name' => PermissionEnum::CLIENT_CREATE(),
            'label' => 'Create',
            'is_visible' => true,
            'sort_order' => 4200
        ],
        [
            'name' => PermissionEnum::CLIENT_STORE(),
            'label' => 'Store',
            'is_visible' => true,
            'sort_order' => 4250
        ],
        [
            'name' => PermissionEnum::CLIENT_EDIT(),
            'label' => 'Edit',
            'is_visible' => true,
            'sort_order' => 4300
        ],
        [
            'name' => PermissionEnum::CLIENT_UPDATE(),
            'label' => 'Update',
            'is_visible' => true,
            'sort_order' => 4350
        ],
        [
            'name' => PermissionEnum::CLIENT_DELETE(),
            'label' => 'Delete',
            'is_visible' => true,
            'sort_order' => 4400
        ],
    ],
    'expense' => [
        [
            'name' => PermissionEnum::EXPENSE(),
            'label' => 'EXPENSE',
            'is_visible' => false,
            'sort_order' => 6050
        ],
        [
            'name' => PermissionEnum::EXPENSE_LIST(),
            'label' => 'List',
            'is_visible' => true,
            'sort_order' => 6100
        ],
        [
            'name' => PermissionEnum::EXPENSE_VIEW(),
            'label' => 'View',
            'is_visible' => true,
            'sort_order' => 6150
        ],
        [
            'name' => PermissionEnum::EXPENSE_CREATE(),
            'label' => 'Create',
            'is_visible' => true,
            'sort_order' => 6200
        ],
        [
            'name' => PermissionEnum::EXPENSE_STORE(),
            'label' => 'Store',
            'is_visible' => true,
            'sort_order' => 6250
        ],
        [
            'name' => PermissionEnum::EXPENSE_EDIT(),
            'label' => 'Edit',
            'is_visible' => true,
            'sort_order' => 6300
        ],
        [
            'name' => PermissionEnum::EXPENSE_UPDATE(),
            'label' => 'Update',
            'is_visible' => true,
            'sort_order' => 6350
        ],
        [
            'name' => PermissionEnum::EXPENSE_DELETE(),
            'label' => 'Delete',
            'is_visible' => true,
            'sort_order' => 6400
        ],
    ],
    'purchase' => [
        [
            'name' => PermissionEnum::PURCHASE(),
            'label' => 'PURCHASE',
            'is_visible' => false,
            'sort_order' => 8050
        ],
        [
            'name' => PermissionEnum::PURCHASE_LIST(),
            'label' => 'List',
            'is_visible' => true,
            'sort_order' => 8100
        ],
        [
            'name' => PermissionEnum::PURCHASE_VIEW(),
            'label' => 'View',
            'is_visible' => true,
            'sort_order' => 8150
        ],
        [
            'name' => PermissionEnum::PURCHASE_CREATE(),
            'label' => 'Create',
            'is_visible' => true,
            'sort_order' => 8200
        ],
        [
            'name' => PermissionEnum::PURCHASE_STORE(),
            'label' => 'Store',
            'is_visible' => true,
            'sort_order' => 8250
        ],
        [
            'name' => PermissionEnum::PURCHASE_EDIT(),
            'label' => 'Edit',
            'is_visible' => true,
            'sort_order' => 8300
        ],
        [
            'name' => PermissionEnum::PURCHASE_UPDATE(),
            'label' => 'Update',
            'is_visible' => true,
            'sort_order' => 8350
        ],
        [
            'name' => PermissionEnum::PURCHASE_DELETE(),
            'label' => 'Delete',
            'is_visible' => true,
            'sort_order' => 8400
        ],
    ],

    'role' => [
        [
            'name' => PermissionEnum::ROLE(),
            'label' => 'Roles',
            'is_visible' => false,
            'sort_order' => 10050
        ],
        [
            'name' => PermissionEnum::ROLE_LIST(),
            'label' => 'List',
            'is_visible' => true,
            'sort_order' => 10100
        ],
        [
            'name' => PermissionEnum::ROLE_VIEW(),
            'label' => 'View',
            'is_visible' => true,
            'sort_order' => 10150
        ],
        [
            'name' => PermissionEnum::ROLE_CREATE(),
            'label' => 'Create',
            'is_visible' => true,
            'sort_order' => 10200
        ],
        [
            'name' => PermissionEnum::ROLE_STORE(),
            'label' => 'Store',
            'is_visible' => true,
            'sort_order' => 10250
        ],
        [
            'name' => PermissionEnum::ROLE_EDIT(),
            'label' => 'Edit',
            'is_visible' => true,
            'sort_order' => 10300
        ],
        [
            'name' => PermissionEnum::ROLE_UPDATE(),
            'label' => 'Update',
            'is_visible' => true,
            'sort_order' => 10350
        ],
        [
            'name' => PermissionEnum::ROLE_DELETE(),
            'label' => 'Delete',
            'is_visible' => true,
            'sort_order' => 10400
        ],
    ],
];
