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
            'label3' => 'Pending Commission',
            'label4' => 'Total Commission',
            'val1' => App\Services\CountService::getCountDataForInstallments($salesOfficerId, $clientId)[0],
            'val2' => App\Services\CountService::getCountDataForInstallments($salesOfficerId, $clientId)[1],
            'val3' => App\Services\CountService::getCountDataForInstallments($salesOfficerId, $clientId)[2],
            'val4' => App\Services\CountService::getCountDataForInstallments($salesOfficerId, $clientId)[3]->commission_received,
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
                                        <th>Client Name</th>
                                        <th>Plot Number</th>
                                        <th style="width: 350px">Commission Decided</th>
                                        <th style="width: 350px">Approved Commission</th>
                                        <th style="width: 350px">Pending Commission</th>
                                        <th>Plot Size</th>
                                        <th>Paid By</th>
                                        <th>Paid Date</th>
                                        <th style="width: 350px">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $key => $data)
                                        <tr>
                                            <td>{{ $key += 1 }}</td>
                                            <td>{{ $data->client->name }}</td>
                                            <td>{{ $data->client->plot_number }}</td>
                                            <td>{{ App\Services\CountService::getTotalCommissionAmountForOneDeal($salesOfficerId, $clientId)->commission_received }}
                                            </td>
                                            <td>{{ $data->commission_received }}</td>
                                            <td>{{ App\Services\CountService::getTotalCommissionAmountForOneDeal($salesOfficerId, $clientId)->commission_received - $data->commission_received }}
                                            </td>
                                            <td>{{ $data->client->plot_size }}</td>
                                            <td>{{$data->paid_by}}</td>
                                            <td>{{$data->paid_date}}</td>
                                            <td>
                                                <a href="javascript:;" class="btn btn-sm btn-danger"
                                                    onclick="confirmAction('{{ route('sales.officer.commission.delete', $data->id) }}')">
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
