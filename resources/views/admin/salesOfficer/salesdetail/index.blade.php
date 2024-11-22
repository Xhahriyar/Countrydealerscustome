@extends('admin.app')
@section('styles')
    <style>
        /* Animation to pulse the icon */
        .info-icon {
            color: #007bff;
            /* Customize color if desired */
            cursor: pointer;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(.5);
            }

            100% {
                transform: scale(1);
            }
        }

        .dt-type-numeric {
            text-align: left !important;
        }

        /* Optional hover effect */
        .info-icon:hover {
            color: #0056b3;
            /* Darker shade on hover */
            transform: scale(1.15);
        }
    </style>
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                Sales Officer
            </h3>
            {{-- <a href="{{ route('sales.officer.create') }}" class="btn btn-sm btn-primary">+ New</a> --}}
        </div>
        @include('admin.partials.count', [
            'label1' => 'Total Sales',
            'label2' => 'Approved Commission',
            'label3' => 'Pending Commission',
            'label4' => 'Total Commission',
            'val1' => App\Services\CountService::getCountDataForSalesOfficer($id)[0],
            'val2' => App\Services\CountService::getCountDataForSalesOfficer($id)[1],
            'val3' => App\Services\CountService::getCountDataForSalesOfficer($id)[2],
            'val4' => App\Services\CountService::getCountDataForSalesOfficer($id)[3],
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
                                        <th>Name</th>
                                        <th>Client Name</th>
                                        <th>Plot Number</th>
                                        <th>Total Commission</th>
                                        <th>Approved Commission</th>
                                        <th>Pending Commission</th>
                                        <th style="width: 400px">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $key => $data)
                                        <tr>
                                            <td>{{ $key += 1 }}</td>
                                            <td>{{ $data->officer->name }}</td>
                                            <td>{{ $data->client->name }}</td>
                                            <td>{{ $data->client->plot_number }}</td>
                                            <td>{{ number_format( $data->commission_received) }}</td>
                                            <td>{{  number_format(App\Services\CountService::getCommissionDetailsForOneDeal($id, $data->client->id)) }}
                                            </td>
                                            <td>{{ number_format( $data->commission_received - App\Services\CountService::getCommissionDetailsForOneDeal($id, $data->client->id)) }}
                                            </td>
                                            <td>
                                                @can('sales_officer_commission_installment-view')
                                                    <a href="{{ route('sales.officer.commission.installments', ['salesOfficerId' => $id, 'clientId' => $data->client->id]) }}"
                                                        class="btn btn-sm btn-primary">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                @endcan
                                                @can('sales_officer_commission-delete')
                                                    <a href="javascript:;" class="btn btn-sm btn-danger"
                                                        onclick="confirmAction('{{ route('sales.officer.commission.delete', $data->id) }}')">
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
