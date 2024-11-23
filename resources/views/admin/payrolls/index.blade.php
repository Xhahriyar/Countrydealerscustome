@extends('admin.app')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                Payroll
            </h3>
            <div class="d-flex justify-content-end">
                <a href="javascript:;" class="btn btn-sm btn-primary" id="export_to_excel">Excel</a>
                <a href="{{ route('payroll.pdf') }}" class="btn btn-sm btn-success ml-1">PDF</a>
            </div>
        </div>
        @include('admin.partials.count', [
            'label1' => 'Total Count',
            'label2' => 'Total Paid Salaries',
            'val1' => $count[0],
            'val2' => $count[1],
        ])
        <h3 class="page-title mb-3">
            Filters
        </h3>
        <form action="{{ route('payroll.index') }}">
            <input type="hidden" name="query" id="" value="">
            <div class="row mb-3">
                <div class="col-md-3">
                    <div class="d-flex justify-content-center align-items-center">
                        <select class="form-control mx-1" id="" name="department">
                            <option disabled selected>-- Department --</option>
                            @foreach (App\Services\TypeService::getEmployeeDepartment() as $department)
                                <option value="{{ $department->name }}">{{ $department->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="d-flex justify-content-center align-items-center">
                        <select class="form-control mx-1" id="" name="employee_type">
                            <option disabled selected>-- Employee Type --</option>
                            @foreach (config('vars.employee_type') as $employeeType)
                                <option value="{{ $employeeType }}" @if (!empty($data->employee_type) && $data->employee_type == $employeeType) selected @endif>
                                    {{ $employeeType }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="d-flex justify-content-center align-items-center">
                        <input type="date" class="form-control" name="from">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="d-flex justify-content-center align-items-center">
                        <input type="date" class="form-control" name="to">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="d-flex justify-content-center align-items-center">
                        <button class="btn btn-sm btn-primary mr-1"><i class="fas fa-filter"></i></button>
                        <a href="{{ route('payroll.index') }}" class="btn btn-sm btn-danger"><i
                                class="fas fa-times"></i></a>
                    </div>
                </div>
            </div>
        </form>
        {{-- filter end --}}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table id="myTable" class="table">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="select_all" /></th>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>CNIC</th>
                                        <th>Employee Type</th>
                                        <th>Loan</th>
                                        <th>Monthly Loan Return</th>
                                        <th>Remaining Loan</th>
                                        <th>Received Loan</th>
                                        <th>Salary</th>
                                        <th>Other Allowances</th>
                                        <th>Net Salary</th>
                                        <th>Pay Salary</th>
                                        <th>History</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $key => $data)
                                        <tr>
                                            <td><input type="checkbox" class="employee_checkbox"
                                                    data-id="{{ $data->id }}" /></td>
                                            <td>{{ $key += 1 }}</td>
                                            <td>{{ $data->first_name }} {{ $data->last_name }}</td>
                                            <td>{{ $data->cnic }}</td>
                                            <td>{{ $data->employee_type }}</td>
                                            <td>{{ formatNumberWithCurrencyExtension($data->loan_amount ?? 0 )}}</td>
                                            <td>{{ formatNumberWithCurrencyExtension($data->loan_return ?? 0 )}}</td>
                                            <td>{{ formatNumberWithCurrencyExtension($data->loan_amount > 0 && $data->loan_amount - $data->histories->sum('loan_return') >= 0 ? $data->loan_amount - $data->histories->sum('loan_return') : 0) }}
                                            </td>

                                            <td>{{formatNumberWithCurrencyExtension( $data->loan_amount > 0 ? $data->histories->sum('loan_return') : 0) }}
                                            </td>

                                            <td>{{ formatNumberWithCurrencyExtension( $data->salary ?? 0 )}}</td>
                                            <td>{{formatNumberWithCurrencyExtension( $data->other_allowance ?? 0 )}}</td>
                                            <td>{{formatNumberWithCurrencyExtension( $data->salary - $data->loan_return + $data->other_allowance ?? 0 )}}</td>
                                            <td>
                                                <a href="javascript:;" class="btn btn-sm btn-outline-primary"
                                                    onclick="confirmAction('{{ route('payroll.store', $data->id) }}')"><i
                                                        class="fa-solid fa-check"></i></a>
                                            </td>
                                            <td>
                                                <a href="{{ route('payroll.history', $data->id) }}"
                                                    class="btn btn-sm btn-outline-primary"><i
                                                        class="fa-solid fa-eye"></i></a>
                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('bottom-scripts')
    <script>
        let table = new DataTable('#myTable');
        $('#select_all').click(function() {
            var isChecked = $(this).prop('checked'); // Get the status of "Select All"
            // Set all checkboxes to the same state
            $('.employee_checkbox').prop('checked', isChecked);
        });

        // Handle individual checkbox click (to uncheck "Select All" if not all are selected)
        $('.employee_checkbox').click(function() {
            var totalCheckboxes = $('.employee_checkbox').length;
            var checkedCheckboxes = $('.employee_checkbox:checked').length;
            // If all checkboxes are checked, check the "Select All"
            $('#select_all').prop('checked', totalCheckboxes === checkedCheckboxes);
        });
        // Get selected employee IDs
        function getSelectedEmployeeIds() {
            var selectedIds = [];
            $(".employee_checkbox:checked").each(function() {
                selectedIds.push($(this).data("id"));
            });
            return selectedIds;
        }

        // Handle the Excel export button click
        $("#export_to_excel").click(function() {
            var selectedIds = getSelectedEmployeeIds();

            // If no employees are selected
            if (selectedIds.length === 0) {
                alert("Please select at least one employee.");
                return;
            }

            // Make an AJAX request to fetch the data and generate Excel
            $.ajax({
                url: "{{ route('payroll.export') }}", // Your export route
                method: "GET",
                data: {
                    ids: selectedIds,
                },
                success: function(response) {
                    if (response.download_url) {
                        // Trigger the download by navigating to the file URL
                        window.location.href = response.download_url;
                    } else {
                        alert("An error occurred while generating the Excel file.");
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    </script>
@endsection
