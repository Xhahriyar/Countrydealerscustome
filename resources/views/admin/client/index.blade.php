@extends('admin.app')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                Sales
            </h3>
            <div class="d-flex">
                @can('client-create')
                    <a href="{{ route('client.create') }}" class="btn btn-sm btn-primary">+ New</a>
                @endcan
            </div>
        </div>
        {{-- count sectionm --}}
        @include('admin.partials.count', [
            'label1' => 'Total Clients',
            'label2' => 'Total Sales Amount',
            'label3' => 'Total Received Amount',
            'label4' => 'Total Pending Amount',
            'val1' => $count[0],
            'val2' => $count[1],
            'val3' => $count[2],
            'val4' => $count[3],
        ])
        {{-- count section end --}}
        <h3 class="page-title mb-3">
            Filters
        </h3>
        <form action="{{ route('client.search') }}">
            <input type="hidden" name="query" id="" value="">
            <div class="row mb-3">
                <div class="col-md-3">
                    <div class="d-flex justify-content-center align-items-center">
                        <select class="form-control mx-1" id="" name="sales_officer">
                            <option disabled selected>-- Sales Officer --</option>
                            @foreach ($salesOfficers as $salesOfficer)
                                <option value="{{ $salesOfficer->id }}">{{ $salesOfficer->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="d-flex justify-content-center align-items-center">
                        <select class="form-control mx-1" id="" name="sale_type">
                            <option disabled selected>-- Sales Type --</option>
                            @foreach (config('vars.sale_type') as $saleType)
                                <option value="{{ $saleType }}" @if (!empty($data->saleType) && $data->saleType == $saleType) selected @endif>
                                    {{ $saleType }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="d-flex justify-content-center align-items-center">
                        <input type="date" class="form-control" name="from">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="d-flex justify-content-center align-items-center">
                        <input type="date" class="form-control" name="to">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="d-flex justify-content-center align-items-center">
                        <button class="btn btn-sm btn-primary mr-1"><i class="fas fa-filter"></i></button>
                        <a href="{{ route('client.index') }}" class="btn btn-sm btn-danger"><i class="fas fa-times"></i></a>
                    </div>
                </div>
            </div>
        </form>
        {{-- filter end --}}
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
                                        <th>Sale Officer</th>
                                        <th>Sale Type</th>
                                        <th>Plot Price</th>
                                        <th>Plot Size (In Marla)</th>
                                        <th>Received</th>
                                        <th>Pending</th>
                                        <th>Actions</th>
                                        <th>Installments</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $key => $client)
                                        @php
                                            // Get unique sale officer names for each client, joined into a comma-separated string
                                            $saleOfficerNames = $client->saleOfficers
                                                ->pluck('officer')
                                                ->unique()
                                                ->map(function ($officer) {
                                                    return $officer['first_name'] . ' ' . $officer['last_name'];
                                                })
                                                ->implode(', ');

                                            // Calculate sums for this client, ensuring no duplicates are included
                                            $paidInstallmentSum = $client->installments
                                                ->where('status', '=', 'PAID')
                                                ->sum('installment_payment');
                                            $paidChequeInstallmentSum = $client->installments
                                                ->where('status', '=', 'PAID')
                                                ->sum('cheque_installment_amount');

                                            // Ensure that you get only the distinct sums for adjustment and advance payment
                                            $adjustmentSum = $client->where('id', $client->id)->sum('adjustment_price'); // This might need a more specific filter if needed
                                            $advancePaymentSum = $client
                                                ->where('id', $client->id)
                                                ->sum('advance_payment');
                                        @endphp
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $client->name }}</td>
                                            <td>{{ $client->father_or_husband_name }}</td>
                                            <td>{{ $saleOfficerNames ? $saleOfficerNames : 'N/A' }}</td>
                                            <!-- Officer names are now distinct and joined as a string -->
                                            <td>{{ $client->sale_type }}</td>
                                            <td>{{ formatNumberWithCurrencyExtension($client->plot_sale_price) }}</td>
                                            <td>{{ $client->plot_size }}M</td>
                                            <td>
                                                {{ formatNumberWithCurrencyExtension($paidInstallmentSum + $paidChequeInstallmentSum + $adjustmentSum + $advancePaymentSum) }}
                                            </td>
                                            <td>
                                                {{ formatNumberWithCurrencyExtension($client->plot_sale_price - ($paidInstallmentSum + $paidChequeInstallmentSum) - ($adjustmentSum + $advancePaymentSum)) }}
                                            </td>
                                            <td class="">
                                                <div class="d-flex">
                                                    @can('client-delete')
                                                        <a href="javascript:;" class="btn btn-danger btn-sm"
                                                            onclick="confirmAction('{{ route('client.delete', $client->id) }}')">
                                                            <i class="fas fa-regular fa-trash"></i>
                                                        </a>
                                                    @endcan
                                                    @can('client-view')
                                                        <a href="{{ route('client.show', $client->id) }}"
                                                            class="btn btn-warning btn-sm mx-1"><i
                                                                class="fas fa-regular fa-eye"></i></a>
                                                    @endcan
                                                    @can('client-edit')
                                                        <a href="{{ route('client.edit', $client->id) }}"
                                                            class="btn btn-primary btn-sm"><i
                                                                class="fas fa-regular fa-pencil"></i></a>
                                                    @endcan
                                                </div>
                                            </td>
                                            <td>
                                                @can('client_installment-view')
                                                    <a href="{{ route('client.installments', $client->id) }}"
                                                        class="btn btn-success btn-sm"><i
                                                            class="fas fa-regular fa-dollar"></i></a>
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
