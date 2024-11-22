<?php

use App\Enums\PermissionEnum;

return [
    'user' => [
        [
            'name' => PermissionEnum::USER(),
            'label' => 'User',
            'is_visible' => false,
            'sort_order' => 50
        ],
        [
            'name' => PermissionEnum::USER_VIEW(),
            'label' => 'View',
            'is_visible' => true,
            'sort_order' => 100
        ],
        [
            'name' => PermissionEnum::USER_CREATE(),
            'label' => 'Create',
            'is_visible' => true,
            'sort_order' => 150
        ],
        // [
        //     'name' => PermissionEnum::USER_EDIT(),
        //     'label' => 'Edit',
        //     'is_visible' => true,
        //     'sort_order' => 200
        // ],
        [
            'name' => PermissionEnum::USER_DELETE(),
            'label' => 'Delete',
            'is_visible' => true,
            'sort_order' => 250
        ],
    ],
    'role' => [
        [
            'name' => PermissionEnum::ROLE(),
            'label' => 'Role',
            'is_visible' => false,
            'sort_order' => 2050
        ],
        [
            'name' => PermissionEnum::ROLE_VIEW(),
            'label' => 'View',
            'is_visible' => true,
            'sort_order' => 2100
        ],
        [
            'name' => PermissionEnum::ROLE_CREATE(),
            'label' => 'Create',
            'is_visible' => true,
            'sort_order' => 2150
        ],
        // [
        //     'name' => PermissionEnum::ROLE_EDIT(),
        //     'label' => 'Edit',
        //     'is_visible' => true,
        //     'sort_order' => 2200
        // ],
        [
            'name' => PermissionEnum::ROLE_DELETE(),
            'label' => 'Delete',
            'is_visible' => true,
            'sort_order' => 2250
        ],
    ],
    'dashboard' => [
        [
            'name' => PermissionEnum::DASHBOARD(),
            'label' => 'Dashboard',
            'is_visible' => false,
            'sort_order' => 4050
        ],
        [
            'name' => PermissionEnum::DASHBOARD_VIEW(),
            'label' => 'View',
            'is_visible' => true,
            'sort_order' => 4100
        ],
    ],
    'employee' => [
        [
            'name' => PermissionEnum::EMPLOYEE(),
            'label' => 'Employee',
            'is_visible' => false,
            'sort_order' => 6050
        ],
        [
            'name' => PermissionEnum::EMPLOYEE_VIEW(),
            'label' => 'View',
            'is_visible' => true,
            'sort_order' => 6100
        ],
        [
            'name' => PermissionEnum::EMPLOYEE_CREATE(),
            'label' => 'Create',
            'is_visible' => true,
            'sort_order' => 6150
        ],
        [
            'name' => PermissionEnum::EMPLOYEE_EDIT(),
            'label' => 'Edit',
            'is_visible' => true,
            'sort_order' => 6200
        ],
        [
            'name' => PermissionEnum::EMPLOYEE_DELETE(),
            'label' => 'Delete',
            'is_visible' => true,
            'sort_order' => 6250
        ],
    ],
    'client' => [
        [
            'name' => PermissionEnum::CLIENT(),
            'label' => 'Client',
            'is_visible' => false,
            'sort_order' => 8050
        ],
        [
            'name' => PermissionEnum::CLIENT_VIEW(),
            'label' => 'View',
            'is_visible' => true,
            'sort_order' => 8100
        ],
        [
            'name' => PermissionEnum::CLIENT_CREATE(),
            'label' => 'Create',
            'is_visible' => true,
            'sort_order' => 8150
        ],
        [
            'name' => PermissionEnum::CLIENT_EDIT(),
            'label' => 'Edit',
            'is_visible' => true,
            'sort_order' => 8200
        ],
        [
            'name' => PermissionEnum::CLIENT_DELETE(),
            'label' => 'Delete',
            'is_visible' => true,
            'sort_order' => 8250
        ],
        [
            'name' => PermissionEnum::CLIENT_INSTALLMENT_VIEW(),
            'label' => 'Installment View',
            'is_visible' => true,
            'sort_order' => 8300
        ],
        [
            'name' => PermissionEnum::CLIENT_CASH_INSTALLMENT_ADD(),
            'label' => 'Cash Installment Add',
            'is_visible' => true,
            'sort_order' => 8350
        ],
        [
            'name' => PermissionEnum::CLIENT_CHECK_INSTALLMENT_ADD(),
            'label' => 'Check Installment Add',
            'is_visible' => true,
            'sort_order' => 8400
        ],
        [
            'name' => PermissionEnum::CLIENT_INSTALLMENT_STATUS(),
            'label' => 'Installment Status',
            'is_visible' => true,
            'sort_order' => 8450
        ],
        [
            'name' => PermissionEnum::CLIENT_INSTALLMENT_DELETE(),
            'label' => 'Installment Delete',
            'is_visible' => true,
            'sort_order' => 8500
        ],

    ],
    'expense' => [
        [
            'name' => PermissionEnum::EXPENSE(),
            'label' => 'Expense',
            'is_visible' => false,
            'sort_order' => 10050
        ],
        // [
        //     'name' => PermissionEnum::EXPENSE_VIEW(),
        //     'label' => 'View',
        //     'is_visible' => true,
        //     'sort_order' => 10100
        // ],
        [
            'name' => PermissionEnum::EXPENSE_CREATE(),
            'label' => 'Create',
            'is_visible' => true,
            'sort_order' => 10150
        ],
        // [
        //     'name' => PermissionEnum::EXPENSE_EDIT(),
        //     'label' => 'Edit',
        //     'is_visible' => true,
        //     'sort_order' => 10200
        // ],
        [
            'name' => PermissionEnum::EXPENSE_DELETE(),
            'label' => 'Delete',
            'is_visible' => true,
            'sort_order' => 10250
        ],
    ],
    'purchase' => [
        [
            'name' => PermissionEnum::PURCHASE(),
            'label' => 'Purchase',
            'is_visible' => false,
            'sort_order' => 12050
        ],
        [
            'name' => PermissionEnum::PURCHASE_VIEW(),
            'label' => 'View',
            'is_visible' => true,
            'sort_order' => 12100
        ],
        [
            'name' => PermissionEnum::PURCHASE_CREATE(),
            'label' => 'Create',
            'is_visible' => true,
            'sort_order' => 12150
        ],
        [
            'name' => PermissionEnum::PURCHASE_EDIT(),
            'label' => 'Edit',
            'is_visible' => true,
            'sort_order' => 12200
        ],
        [
            'name' => PermissionEnum::PURCHASE_DELETE(),
            'label' => 'Delete',
            'is_visible' => true,
            'sort_order' => 12250
        ],
        [
            'name' => PermissionEnum::PURCHASE_INSTALLMENT_VIEW(),
            'label' => 'Installment View',
            'is_visible' => true,
            'sort_order' => 12300
        ],
        [
            'name' => PermissionEnum::PURCHASE_CASH_INSTALLMENT_ADD(),
            'label' => 'Cash Installment Add',
            'is_visible' => true,
            'sort_order' => 12350
        ],
        [
            'name' => PermissionEnum::PURCHASE_CHECK_INSTALLMENT_ADD(),
            'label' => 'Check Installment Add',
            'is_visible' => true,
            'sort_order' => 12400
        ],
        [
            'name' => PermissionEnum::PURCHASE_INSTALLMENT_STATUS_EDIT(),
            'label' => 'Installment Status Edit',
            'is_visible' => true,
            'sort_order' => 12450
        ],
    ],
    'payroll' => [
        [
            'name' => PermissionEnum::PAYROLL(),
            'label' => 'Payroll',
            'is_visible' => false,
            'sort_order' => 14050
        ],
        [
            'name' => PermissionEnum::PAYROLL_VIEW(),
            'label' => 'View',
            'is_visible' => true,
            'sort_order' => 14100
        ],
        [
            'name' => PermissionEnum::PAYROLL_CREATE(),
            'label' => 'Create',
            'is_visible' => true,
            'sort_order' => 14150
        ],
    ],
    'sales_officer' => [
        [
            'name' => PermissionEnum::SALES_OFFICER(),
            'label' => 'Sales Officer',
            'is_visible' => false,
            'sort_order' => 16050
        ],
        [
            'name' => PermissionEnum::SALES_OFFICER_VIEW(),
            'label' => 'View',
            'is_visible' => true,
            'sort_order' => 16100
        ],
        [
            'name' => PermissionEnum::SALES_OFFICER_CREATE(),
            'label' => 'Create',
            'is_visible' => true,
            'sort_order' => 16150
        ],
        [
            'name' => PermissionEnum::SALES_OFFICER_EDIT(),
            'label' => 'Edit',
            'is_visible' => true,
            'sort_order' => 16200
        ],
        [
            'name' => PermissionEnum::SALES_OFFICER_DELETE(),
            'label' => 'Delete',
            'is_visible' => true,
            'sort_order' => 16250
        ],
        [
            'name' => PermissionEnum::SALES_OFFICER_COMMISSION_INSTALLMENT_VIEW(),
            'label' => 'Commission Installment View',
            'is_visible' => true,
            'sort_order' => 16300
        ],
        [
            'name' => PermissionEnum::SALES_OFFICER_COMMISSION_INSTALLMENT_CREATE(),
            'label' => 'Commission Installment Create',
            'is_visible' => true,
            'sort_order' => 16350
        ],
        [
            'name' => PermissionEnum::SALES_OFFICER_COMMISSION_STATUS(),
            'label' => 'Commission Status',
            'is_visible' => true,
            'sort_order' => 16400
        ],
        [
            'name' => PermissionEnum::SALES_OFFICER_COMMISSION_INSTALLMENT_STATUS(),
            'label' => 'Commisssion Installment Status',
            'is_visible' => true,
            'sort_order' => 16450
        ],
        // [
        //     'name' => PermissionEnum::SALES_OFFICER_COMMISSION_INSTALLMENT_EDIT(),
        //     'label' => 'Commisssion Installment Edit',
        //     'is_visible' => true,
        //     'sort_order' => 16500
        // ],
        [
            'name' => PermissionEnum::SALES_OFFICER_COMMISSION_DELETE(),
            'label' => 'Commisssion Delete',
            'is_visible' => true,
            'sort_order' => 16550
        ],
    ],
    'setting' => [
        [
            'name' => PermissionEnum::SETTINGS(),
            'label' => 'Setting',
            'is_visible' => false,
            'sort_order' => 18050
        ],
        [
            'name' => PermissionEnum::SETTINGS_VIEW(),
            'label' => 'View',
            'is_visible' => true,
            'sort_order' => 18100
        ],
        [
            'name' => PermissionEnum::SETTINGS_TYPE_CREATE(),
            'label' => 'Type Create',
            'is_visible' => true,
            'sort_order' => 18150
        ],
        [
            'name' => PermissionEnum::SETTINGS_TYPE_DELETE(),
            'label' => 'Type Delete',
            'is_visible' => true,
            'sort_order' => 18200
        ],
    ],
];
