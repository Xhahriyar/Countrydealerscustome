@extends('admin.app')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                Purchases
            </h3>
            <a href="{{route('purchase.create')}}" class="btn btn-sm btn-primary">+ New</a>
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
                                        <th>Father/Husband Name</th>
                                        <th>Client Type</th>
                                        <th>Sale Type</th>
                                        <th>Actions</th>
                                        <th>Installments</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $key => $data)
                                    <tr>
                                        <td>{{ $key += 1 }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->father_or_husband_name }}</td>
                                        <td>{{ $data->client_type }}</td>
                                        <td>{{ $data->sale_type }}</td>
                                        <td>
                                            <a href="javascript:;" class="btn btn-danger btn-sm" onclick="confirmAction('{{ route('purchase.delete', $data->id) }}')">
                                                <i class="fas fa-regular fa-trash"></i>
                                            </a>
                                            <a href="{{ route('purchase.show', $data->id) }}"
                                                class="btn btn-warning btn-sm"><i class="fas fa-regular fa-eye"></i>
                                            </a>
                                            <a href="{{ route('purchase.edit', $data->id) }}"
                                                class="btn btn-primary btn-sm"><i class="fas fa-regular fa-pencil"></i>
                                            </a>
                                        </td>
                                        <td><a href="{{ route('purchase.installments', $data->id) }}"
                                                class="btn btn-success btn-sm"><i
                                                    class="fas fa-regular fa-dollar"></i></a></td>
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
