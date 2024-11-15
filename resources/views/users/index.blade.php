@extends('admin.app')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/moment/min/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                Users
            </h3>
            @can('role-create')
                <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary">+ New</a>
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
                                <h2>{{ $userCount }}</h2>
                            </div>
                            {{-- <div class="statistics-item">
                                <p>
                                    <i class="icon-sm fas fa-check-circle mr-2"></i>
                                    Total Expences
                                </p>
                                <h2>{{ $count[1] }}</h2>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h3 class="page-title mb-3">
            Filters
        </h3>
        <form action="{{ route('users.index') }}" method="get">
            <input type="hidden" name="query">
            <div class="row mb-3">
                <div class="col-2">
                    <div class="d-flex justify-content-center align-items-center">
                        <input type="text" class="form-control" placeholder="search by name" name="search"
                            value="" />
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
                    <a href="{{ route('users.index') }}" class="btn btn-sm btn-danger"><i class="fas fa-times"></i></a>
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
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Created At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $key => $user)
                                        <tr>
                                            <td>{{ $key += 1 }}</td>
                                            <td>{{ $user->first_name }}</td>
                                            <td>{{ $user->last_name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->created_at }}</td>
                                            <td>
                                                @can('user-delete')
                                                    <form id="delete-form" action="{{ route('users.delete', $user->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" onclick="confirmDelete()"
                                                            class="btn btn-sm btn-danger">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </button>
                                                    </form>
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
