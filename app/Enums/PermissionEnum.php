<?php

namespace App\Enums;

use ArchTech\Enums\InvokableCases;

enum PermissionEnum: string
{
    use InvokableCases;

        // DASHBOARD
    case DASHBOARD = 'dashboard';
    case DASHBOARD_VIEW = 'dashboard-view';

        // EMPLOYEE
    case EMPLOYEE = 'employee';
    case EMPLOYEE_LIST = 'employee-list';
    case EMPLOYEE_VIEW = 'employee-view';
    case EMPLOYEE_CREATE = 'employee-create';
    case EMPLOYEE_STORE = 'employee-store';
    case EMPLOYEE_EDIT = 'employee-edit';
    case EMPLOYEE_UPDATE = 'employee-update';
    case EMPLOYEE_DELETE = 'employee-delete';

        // CLIENT
    case CLIENT = 'client';
    case CLIENT_LIST = 'client-list';
    case CLIENT_VIEW = 'client-view';
    case CLIENT_CREATE = 'client-create';
    case CLIENT_STORE = 'client-store';
    case CLIENT_EDIT = 'client-edit';
    case CLIENT_UPDATE = 'client-update';
    case CLIENT_DELETE = 'client-delete';

        // EXPENSE
    case EXPENSE = 'expense';
    case EXPENSE_LIST = 'expense-list';
    case EXPENSE_VIEW = 'expense-view';
    case EXPENSE_CREATE = 'expense-create';
    case EXPENSE_STORE = 'expense-store';
    case EXPENSE_EDIT = 'expense-edit';
    case EXPENSE_UPDATE = 'expense-update';
    case EXPENSE_DELETE = 'expense-delete';

        // PURCHASE
    case PURCHASE = 'purchase';
    case PURCHASE_LIST = 'purchase-list';
    case PURCHASE_VIEW = 'purchase-view';
    case PURCHASE_CREATE = 'purchase-create';
    case PURCHASE_STORE = 'purchase-store';
    case PURCHASE_EDIT = 'purchase-edit';
    case PURCHASE_UPDATE = 'purchase-update';
    case PURCHASE_DELETE = 'purchase-delete';

        // ROLE
    case ROLE = 'role';
    case ROLE_LIST = 'role-list';
    case ROLE_VIEW = 'role-view';
    case ROLE_CREATE = 'role-create';
    case ROLE_STORE = 'role-store';
    case ROLE_EDIT = 'role-edit';
    case ROLE_UPDATE = 'role-update';
    case ROLE_DELETE = 'role-delete';
}
