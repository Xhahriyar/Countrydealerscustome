@extends('admin.app')
@section('content')
    <div class="content-wrapper">
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
                                        <th>Loan</th>
                                        <th>Loan Return</th>
                                        <th>Salary</th>
                                        <th>Other Allowances</th>
                                        <th>Net Salary</th>
                                        <th>Paid Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $key => $data)
                                        <tr>
                                            <td>{{ $key += 1 }}</td>
                                            <td>{{ $data->first_name }} {{ $data->last_name }}</td>
                                            <td>{{ $data->cnic }}</td>
                                            <td>{{ $data->employee_type }}</td>
                                            <td>{{ $data->loan_amount }}</td>
                                            <td>{{ $data->loan_return }}</td>
                                            <td>{{ $data->salary }}</td>
                                            <td>{{ $data->other_allowance }}</td>
                                            <td>{{ $data->salary - $data->loan_return + $data->other_allowance }}</td>
                                            <td>{{ $data->created_at->format('d-m-Y') }}</td>
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
