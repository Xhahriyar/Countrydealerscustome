@extends('admin.app')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                Sales Officers (Sulaman)
            </h3>
            {{-- <a href="{{ route('sales.officer.create') }}" class="btn btn-sm btn-primary">+ New</a> --}}
        </div>
        <div class="row grid-margin">
            <div class="col-12">
                <div class="card card-statistics">
                    <div class="card-body">
                        <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                            <div class="statistics-item">
                                <p>
                                    <i class="icon-sm fas fa-hourglass-half mr-2"></i>
                                    Total Sales
                                </p>
                                <h2>10</h2>
                                {{-- <label class="badge badge-outline-danger badge-pill">50</label> --}}
                            </div>
                            <div class="statistics-item">
                                <p>
                                    <i class="icon-sm fas fa-check-circle mr-2"></i>
                                    Total Paid Commission
                                </p>
                                <h2>67896</h2>
                                {{-- <label class="badge badge-outline-success badge-pill"></label> --}}
                            </div>
                            <div class="statistics-item">
                                <p>
                                    <i class="icon-sm fas fa-chart-line mr-2"></i>
                                    Total UnPaid Commission
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
                                        <th>Name Sale Officer</th>
                                        <th>Client Name</th>
                                        <th>Plaot Number</th>
                                        <th>Commission Desided</th>
                                        <th>Ploat Size</th>
                                        <th>Phone</th>
                                        <th>Agent</th>
                                        <th>Actione</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @forelse ($data as $key => $data) --}}
                                        <tr>
                                            <td>1</td>
                                            <td>Sulaman</td>
                                            <td>Hassan</td>
                                            <td>123</td>
                                            <td>120</td>
                                            <td>5 Parla</td>
                                            <td>03004423989</td>
                                            {{-- <td>(Shuld be a type of Department we will auto fetch this when we creating the sale office we tell which type of this Sale officer)</td> --}}
                                            <td>Sale team</td>
                                            <td>
                                                <a href=""
                                                    class="btn btn-warning btn-sm mr-2"><i
                                                        class="fas fa-regular fa-dollar"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    {{-- @empty --}}
                                    {{-- @endforelse --}}
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
