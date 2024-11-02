@extends('admin.app')

@section('content')
    @include('admin.salesOfficer.salesdetail.addInstallmentModal')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                Sales Officer
            </h3>
            <a href="javascript:;" data-toggle="modal" data-target="#dealModal" class="btn btn-sm btn-primary">+ New</a>
        </div>

        @include('admin.partials.count', [
            'label1' => 'Total Installments',
            'label2' => 'Approved Commission',
            'label3' => 'Pending Commissions',
            'val1' => App\Services\CountService::getCountDataForInstallments($salesOfficerId , $clientId)[0],
            'val2' => App\Services\CountService::getCountDataForInstallments($salesOfficerId , $clientId)[1],
            'val3' => App\Services\CountService::getCountDataForInstallments($salesOfficerId , $clientId)[2],
        ])
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table id="myTable" class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Sale Officer</th>
                                        <th>Client Name</th>
                                        <th>Plot Number</th>
                                        <th style="width: 350px">Commission Amount
                                        </th>
                                        {{-- <th>Remaining Commission</th> --}}
                                        <th>Plot Size</th>
                                        <th>Status</th>
                                        <th style="width: 350px">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $key => $data)
                                        <tr>
                                            <td>{{ $key += 1 }}</td>
                                            <td>{{ $data->officer->name }}</td>
                                            <td>{{ $data->client->name }}</td>
                                            <td>{{ $data->client->plot_number }}</td>
                                            <td class="pending_approved_commission">
                                                {{ $data->commission_received }}
                                            </td>

                                            <td>{{ $data->client->plot_size }}</td>

                                            <td>
                                                <span
                                                    class="badge @if ($data->commission_received_status == 'PAID') badge-outline-success @else badge-outline-warning @endif  badge-pill">
                                                    {{ $data->commission_received_status }}
                                                </span>
                                            </td>

                                            <td>
                                                <a href="javascript:;" class="btn btn-sm btn-danger"
                                                onclick="confirmAction('{{ route('sales.officer.commission.delete', $data->id) }}')">
                                                <i class="fas fa-check"></i>
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

        // $(document).ready(function() {
        //     let total = 0;
        //     $('.remaining_commission').each(function() {
        //         const value = parseFloat($(this).text()) || 0;
        //         total += value;
        //     });
        //     // $('#countVal3').text(total.toFixed(2));
        //     $('#count-main-div').append(`
    //     <div class="statistics-item">
    //         <p>
    //             <i class="icon-sm fas fa-dollar mr-2"></i>
    //             Pending Commissions
    //         </p>
    //         <label class="badge badge-outline-secondary badge-pill">
    //             ${totalPendingCommission}
    //         </label>
    //     </div>
    // `);
        // });
    </script>
@endsection
