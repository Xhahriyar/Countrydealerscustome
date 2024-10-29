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
            <a href="javascript:;" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#expenseModal">+ New</a>
        </div>
        <div class="row grid-margin">
            <div class="col-12">
                <div class="card card-statistics">
                    <div class="card-body">
                        <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                            <div class="statistics-item">
                                <p>
                                    <i class="icon-sm fas fa-hourglass-half mr-2"></i>
                                    Total Expence Site
                                </p>
                                <h2>10</h2>
                                {{-- <label class="badge badge-outline-danger badge-pill">50</label> --}}
                            </div>
                            <div class="statistics-item">
                                <p>
                                    <i class="icon-sm fas fa-check-circle mr-2"></i>
                                    Total Expence Home
                                </p>
                                <h2>67896</h2>
                                {{-- <label class="badge badge-outline-success badge-pill"></label> --}}
                            </div>
                            <div class="statistics-item">
                                <p>
                                    <i class="icon-sm fas fa-chart-line mr-2"></i>
                                    Total Expence Office
                                </p>
                                <h2>9879</h2>
                                {{-- <label class="badge badge-outline-success badge-pill">{{$salesCount}}</label> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                                        <th>Image</th>
                                        <th>Amount</th>
                                        <th>Type</th>
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
                                            <td>{{ $expense->amount }}</td>
                                            <td>{{ $expense->expense_type }}</td>
                                            <td>{{ $expense->description }}</td>
                                            <td>
                                                <a href="javascript:;" class="btn btn-danger"
                                                    onclick="confirmAction('{{ route('expense.delete', $expense->id) }}')">
                                                    <i class="fas fa-trash"></i>
                                                </a>
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
