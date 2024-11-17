@extends('admin.app')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/moment/min/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

@section('content')
    @include('admin.expense.modals.expense')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                Expenses
            </h3>
            @can('expense-create')
                <a href="javascript:;" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#expenseModal">+ New</a>
            @endcan
        </div>
        <div class="row grid-margin">
            <div class="col-12">
                <div class="card card-statistics">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="statistics-item">
                                <p>
                                    <i class="icon-sm fas fa-hourglass-half mr-2"></i>
                                    Total Count
                                </p>
                                <h2>{{ $count[0] }}</h2>
                            </div>
                            <div class="statistics-item">
                                <p>
                                    <i class="icon-sm fas fa-check-circle mr-2"></i>
                                    Total Expences
                                </p>
                                <h2>{{ $count[1] }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h3 class="page-title mb-3">
            Filters
        </h3>
        <form action="{{ route('expense.index') }}" method="get">
            <input type="hidden" name="query">
            <div class="row mb-3">
                <div class="col-2">
                    <div class="d-flex justify-content-center align-items-center">
                        <select class="form-control mx-1" id="" name="expense_category">
                            <option disabled selected>-- Expence category --</option>
                            @foreach (App\Services\TypeService::getExpenseCategories() as $clientType)
                                <option value="{{ $clientType->name }}" @if (!empty($data->clientType) && $data->clientType == $clientType) selected @endif>
                                    {{ $clientType->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-2">
                    <div class="d-flex justify-content-center align-items-center">
                        <select class="form-control mx-1" name="expense_type">
                            <option disabled selected>-- Expence Type --</option>
                            @foreach (App\Services\TypeService::getExpenseTypes() as $clientType)
                                <option value="{{ $clientType->name }}" @if (!empty($data->clientType) && $data->clientType == $clientType) selected @endif>
                                    {{ $clientType->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-2">
                    <div class="d-flex justify-content-center align-items-center">
                        <select class="form-control mx-1" name="name">
                            <option disabled selected>-- Filter By Name --</option>
                            @foreach (App\Services\TypeService::getExpenseNames() as $clientType)
                                <option value="{{ $clientType->name }}">
                                    {{ $clientType->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-2">
                    <input type="date" class="form-control" name="from" value="" />
                </div>
                <div class="col-2">
                    <input type="date" class="form-control" name="to" value="" />
                </div>
                <div class="col-md-2">
                    <button class="btn btn-sm btn-primary"><i class="fas fa-filter"></i></button>
                    <a href="{{ route('expense.index') }}" class="btn btn-sm btn-danger"><i class="fas fa-times"></i></a>
                </div>
            </div>
        </form>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table id="myTable" class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Amount</th>
                                        <th>Type</th>
                                        <th>Category</th>
                                        <th>Description</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $key => $expense)
                                        <tr>
                                            <td>{{ $key += 1 }}</td>
                                            <td>
                                                <a href="{{ Storage::url($expense->picture) }}" target="_blank">
                                                    <img src="{{ Storage::url($expense->picture) }}" alt=""
                                                        width="20px">
                                                </a>
                                            </td>
                                            <td>{{ $expense->name }}</td>
                                            <td>{{ $expense->amount }}</td>
                                            <td>{{ $expense->expense_type }}</td>
                                            <td>{{ $expense->expense_category }}</td>
                                            <td>{{ \Illuminate\Support\Str::words($expense->description, 5, '...') }}</td>
                                            <td>
                                                @can('expense-delete')
                                                    <a href="javascript:;" class="btn btn-danger"
                                                        onclick="confirmAction('{{ route('expense.delete', $expense->id) }}')">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
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
