@extends('admin.app')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                Sales Officers
            </h3>
            <a href="{{ route('sales.officer.create') }}" class="btn btn-sm btn-primary">+ New</a>
        </div>
        {{-- count sectionm --}}
        @include('admin.partials.count', [
            'label1' => 'Total Sales',
            'label2' => 'Total Paid Commissions',
            'label3' => 'Pending Commissions',
            'val1' => App\Services\CountService::getCountForSalesForAllOfficers()[0],
            'val2' => App\Services\CountService::getCountForSalesForAllOfficers()[1],
            'val3' => App\Services\CountService::getCountForSalesForAllOfficers()[2],
        ])
        {{-- count section end --}}
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
                                        <th>Total Deals</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $key => $data)
                                        <tr>
                                            <td>{{ $key += 1 }}</td>
                                            <td>{{ $data->name }}</td>
                                            <td>{{ $data->cnic }}</td>
                                            <td>
                                                {{ App\Services\CountService::getCountDataForSalesOfficer($data->id)[0] }}
                                            </td>
                                            <td class="d-flex">
                                                {{-- View button --}}
                                                <a href="{{ route('sales.officer.show', $data->id) }}"
                                                    class="btn btn-warning btn-sm mr-2"><i
                                                        class="fas fa-regular fa-eye"></i>
                                                </a>
                                                {{-- <a href="{{route('sales.officer.delete' , $data->id)}}" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></a> --}}
                                                <form id="delete-form"
                                                    action="{{ route('sales.officer.delete', $data->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" onclick="confirmDelete()"
                                                        class="btn btn-sm btn-danger">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </form>

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
