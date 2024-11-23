@extends('admin.app')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                Sales Officers
            </h3>
            @can('sales_officer-create')
                <a href="{{ route('sales.officer.create') }}" class="btn btn-sm btn-primary">+ New</a>
            @endcan
        </div>
        {{-- count sectionm --}}
        @include('admin.partials.count', [
            'label1' => 'Total Sales',
            'label2' => 'Total Paid Commission',
            'label3' => 'Pending Commission',
            'label4' => 'Total Commission',
            'val1' => App\Services\CountService::getCountForSalesForAllOfficers()[0],
            'val2' => App\Services\CountService::getCountForSalesForAllOfficers()[1],
            'val3' => App\Services\CountService::getCountForSalesForAllOfficers()[2],
            'val4' => App\Services\CountService::getCountForSalesForAllOfficers()[3],
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
                                        <th>Type</th>
                                        <th>Total commission</th>
                                        <th>Approved commission</th>
                                        <th>Pending commission</th>
                                        {{-- <th>CNIC</th> --}}
                                        <th>Total Deals</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $totalRemainingCommissions = 0;
                                    @endphp
                                    @foreach ($data as $key => $data)
                                        @foreach ($data->deals as $deal)
                                            @if ($deal->commission_type == 'percent' && $deal->commission_received_status == 'PENDING')
                                                @php
                                                    $remainingCommission =
                                                        ($deal->commission_amount / 100) *
                                                            $deal->client->plot_sale_price -
                                                        $deal->commission_received;
                                                    $totalRemainingCommissions += $remainingCommission;
                                                @endphp
                                            @endif
                                        @endforeach

                                        <tr>
                                            <td>{{ $key += 1 }}</td>
                                            <td>{{ $data->name }}</td>
                                            <td>{{ $data->officer_type }}</td>
                                            {{-- <td>{{ $data->cnic }}</td> --}}
                                            <td>{{ formatNumberWithCurrencyExtension(App\Services\CountService::getCommissionDetails($data->id)[0]) }}</td>
                                            <td>{{ formatNumberWithCurrencyExtension( App\Services\CountService::getCommissionDetails($data->id)[1] )}}</td>
                                            <td>{{  formatNumberWithCurrencyExtension(App\Services\CountService::getCommissionDetails($data->id)[2] )}}</td>
                                            <td>
                                                {{ number_format( App\Services\CountService::getCountDataForSalesOfficer($data->id)[0] )}}
                                            </td>
                                            <td class="d-flex">
                                                @can('sales_officer-view')
                                                    <a href="{{ route('sales.officer.show', $data->id) }}"
                                                        class="btn btn-warning btn-sm mr-2"><i
                                                            class="fas fa-regular fa-eye"></i>
                                                    </a>
                                                @endcan
                                                @can('sales_officer-delete')
                                                    <form id="delete-form"
                                                        action="{{ route('sales.officer.delete', $data->id) }}" method="POST">
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
                                    {{-- <p>Total Remaining Commissions: {{ $totalRemainingCommissions }}</p> --}}
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
