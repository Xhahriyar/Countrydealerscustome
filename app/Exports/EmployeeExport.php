<?php

namespace App\Exports;

use App\Models\AdminOfficeEMployee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class EmployeeExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return AdminOfficeEMployee::with('histories')->get();
    }
    public function headings(): array
    {
        return [
            '#',
            'Name',
            'CNIC',
            'Employee Type',
            'Loan',
            'Monthly Loan Return',
            'Remaining Loan',
            'Received Loan',
            'Salary',
            'Other Allowances',
            'Net Salary',
        ];
    }

    public function map($data): array
    {
        // Calculate remaining and received loan
        $loanAmount = $data->loan_amount ?? 0;
        $loanReturn = $data->loan_return ?? 0;
        $receivedLoan = $data->histories->sum('loan_return');
        $remainingLoan = $loanAmount > 0 && $loanAmount - $receivedLoan >= 0 ? $loanAmount - $receivedLoan : 0;

        return [
            $data->id,
            $data->first_name . ' ' . $data->last_name,
            $data->cnic,
            $data->employee_type,
            $loanAmount,
            $loanReturn,
            $remainingLoan,
            $receivedLoan,
            $data->salary ?? 0,
            $data->other_allowance ?? 0,
            ($data->salary ?? 0) - $loanReturn + ($data->other_allowance ?? 0),
        ];
    }
}
