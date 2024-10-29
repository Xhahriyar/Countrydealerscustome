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
            'label2' => 'Pending/Approved Commission',
            'label3' => 'Remaining Commission',
            'val1' => App\Services\CountService::getTotalDealsOfSalesOfficer($id),
            'val2' => '',
            'val3' => '',
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
                                        <th style="width: 350px">Pending/Approved Commission <i
                                                class="fas fa-info info-icon"
                                                title="The Commission Amount for Advance, Adjustment payments."></i>

                                        </th>
                                        <th>Remaining Commission</th>
                                        <th>Plot Size</th>
                                        <th>Pending/Approved Commission Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $key => $data)
                                        <tr>
                                            <td>{{ $key += 1 }}</td>
                                            <td>{{ $data->officer->name }}</td>
                                            <td>{{ $data->client->name }}</td>
                                            <td>{{ $data->client->plot_number }}</td>
                                            <td id="pending_approved_commission">{{ $data->commission_received }}</td>
                                            <td id="remaining_commission">
                                                {{ ($data->commission_amount / 100) * $data->client->plot_sale_price - $data->commission_received }}
                                            </td>
                                            <td>{{ $data->client->plot_size }}</td>
                                            <td>{{ $data->commission_received_status ?? 'PENDING' }}</td>

                                            <td>
                                                <a href="javascript:;" class="btn btn-sm btn-primary" onclick="confirmAction('{{route('sales.officer.commission.status' , $data->id)}}')">
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

        $(document).ready(function() {
            $('#h1').text($('#pending_approved_commission').text());
            $('#h2').text($('#remaining_commission').text());
        });
    </script>
@endsection
