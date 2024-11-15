<?php

namespace App\Enums;

use ArchTech\Enums\InvokableCases;

enum PermissionEnum: string
{
    use InvokableCases;

        // USER
    case USER = 'user';
    case USER_VIEW = 'user-view';
    case USER_CREATE = 'user-create';
    case USER_EDIT = 'user-edit';
    case USER_DELETE = 'user-delete';

        // ROLE
    case ROLE = 'role';
    case ROLE_VIEW = 'role-view';
    case ROLE_CREATE = 'role-create';
    case ROLE_EDIT = 'role-edit';
    case ROLE_DELETE = 'role-delete';

        // DASHBOARD
    case DASHBOARD = 'dashboard';
    case DASHBOARD_VIEW = 'dashboard-view';

        // EMPLOYEE
    case EMPLOYEE = 'employee';
    case EMPLOYEE_VIEW = 'employee-view';
    case EMPLOYEE_CREATE = 'employee-create';
    case EMPLOYEE_EDIT = 'employee-edit';
    case EMPLOYEE_DELETE = 'employee-delete';

        // CLIENT
    case CLIENT = 'client';
    case CLIENT_VIEW = 'client-view';
    case CLIENT_CREATE = 'client-create';
    case CLIENT_EDIT = 'client-edit';
    case CLIENT_DELETE = 'client-delete';
    case CLIENT_INSTALLMENT_VIEW = 'client_installment-view';
    case CLIENT_CASH_INSTALLMENT_ADD = 'client_cash_installment-add';
    case CLIENT_CHECK_INSTALLMENT_ADD = 'client_check_installment-add';
    case CLIENT_INSTALLMENT_STATUS = 'client_installment-status';

        // EXPENSE
    case EXPENSE = 'expense';
    case EXPENSE_VIEW = 'expense-view';
    case EXPENSE_CREATE = 'expense-create';
    case EXPENSE_EDIT = 'expense-edit';
    case EXPENSE_DELETE = 'expense-delete';

        // PURCHASE
    case PURCHASE = 'purchase';
    case PURCHASE_VIEW = 'purchase-view';
    case PURCHASE_CREATE = 'purchase-create';
    case PURCHASE_EDIT = 'purchase-edit';
    case PURCHASE_DELETE = 'purchase-delete';
    case PURCHASE_INSTALLMENT_VIEW = 'purchase_installment-view';
    case PURCHASE_CASH_INSTALLMENT_ADD = 'purchase_cash_installment-add';
    case PURCHASE_CHECK_INSTALLMENT_ADD = 'purchase_check_installment-add';
    case PURCHASE_INSTALLMENT_STATUS_EDIT = 'purchase_installment_status-edit';
        // PAYROLLS
    case PAYROLL = 'payroll';
    case PAYROLL_VIEW = 'payroll-view';

        // SALES OFFICER
    case SALES_OFFICER = 'sales_officer';
    case SALES_OFFICER_VIEW = 'sales_officer-view';
    case SALES_OFFICER_CREATE = 'sales_officer-create';
    case SALES_OFFICER_EDIT = 'sales_officer-edit';
    case SALES_OFFICER_DELETE = 'sales_officer-delete';
    case SALES_OFFICER_COMMISSION_INSTALLMENT_VIEW = 'sales_officer_commission_installment-view';
    case SALES_OFFICER_COMMISSION_INSTALLMENT_CREATE = 'sales_officer_commission_installment-create';
    case SALES_OFFICER_COMMISSION_STATUS = 'sales_officer_commission-status';
    case SALES_OFFICER_COMMISSION_INSTALLMENT_STATUS = 'sales_officer_commission_installment-status';
    case SALES_OFFICER_COMMISSION_INSTALLMENT_EDIT = 'sales_officer_commission_installment-edit';
    case SALES_OFFICER_COMMISSION_INSTALLMENT_DELETE = 'sales_officer_commission_installment-delete';

        // SETTINGS
    case SETTINGS = 'settings';
    case SETTINGS_VIEW = 'settings-view';
    case SETTINGS_TYPE_CREATE = 'settings_type-create';
    case SETTINGS_TYPE_DELETE = 'settings_type-delete';
}
