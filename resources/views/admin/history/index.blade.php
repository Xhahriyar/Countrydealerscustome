@extends('admin.app')
@section('content')
    <div class="content-wrapper">
        <div class="d-flex justify-content-end mb-2">
            <a href="{{route('payroll.print.ladger' , $employeeId)}}" class="btn btn-sm btn-primary" target="_blank"> <i class="fas fa-print"></i> Print All</a>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table id="myTable" class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>CNIC</th>
                                        <th>Employee Type</th>
                                        <th>Total Loan</th>
                                        <th>Loan Return</th>
                                        <th>Remaining Loan</th>
                                        <th>Salary</th>
                                        <th>Other Allowances</th>
                                        <th>Net Salary</th>
                                        <th>Paid Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $key => $data)
                                        <tr>
                                            <td>{{ $key += 1 }}</td>
                                            <td>{{ $data->first_name }} {{ $data->last_name }}</td>
                                            <td>{{ $data->cnic }}</td>
                                            <td>{{ $data->employee_type }}</td>
                                            <td>{{ number_format($data->loan_amount )}}</td>
                                            <td>{{ number_format($data->loan_return )}}</td>
                                            <td>{{ number_format($data->loan_amount - $data->sum('loan_return') ) }}</td>
                                            <td>{{ number_format($data->salary) }}</td>
                                            <td>{{ number_format($data->other_allowance )}}</td>
                                            <td>{{ number_format($data->salary - $data->loan_return + $data->other_allowance) }}</td>
                                            <td>{{ $data->created_at->format('d-m-Y') }}</td>
                                            <td>
                                                <a href="{{route('payroll.print' , $data->id)}}" class="btn btn-sm btn-primary" target="_blank"><i class="fas fa-print"></i></a>
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
    </script>
@endsection
