@extends('admin.app')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                Clients
            </h3>
            <div class="d-flex">
                <a href="{{ route('client.create') }}" class="btn btn-sm btn-primary">+ New</a>
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
                <div class="col-md-3">
                    <div class="d-flex justify-content-center align-items-center">
                        <input type="date" class="form-control" name="from">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="d-flex justify-content-center align-items-center">
                        <input type="date" class="form-control" name="to">
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="d-flex justify-content-center align-items-center">
                        <button class="btn btn-sm btn-primary"><i class="fas fa-search"></i></button>
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
                                        <th>Plot Size</th>
                                        <th>Received</th>
                                        <th>Pending</th>
                                        <th style="width: 200px">Actions</th>
                                        <th>Installments</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $key => $data)
                                        <tr>
                                            <td>{{ $key += 1 }}</td>
                                            <td>{{ $data->name }}</td>
                                            <td>{{ $data->father_or_husband_name }}</td>
                                            <td>
                                                @foreach ($data->saleOfficers as $saleOfficer)
                                                    {{ $saleOfficer->officer->name . ',' }}
                                                @endforeach
                                            </td>
                                            <td>{{ $data->sale_type }}</td>
                                            <td>{{ $data->plot_sale_price }}</td>
                                            <td>{{ $data->plot_size }}</td>
                                            <td>
                                                {{ $data->installments->where('status', '=', 'PAID')->sum('installment_payment') +  $data->installments->where('status', '=', 'PAID')->sum('cheque_installment_amount')}}
                                            </td>
                                            <td>{{ $data->plot_sale_price - $data->installments->where('status', '=', 'PAID')->sum('installment_payment') +  $data->installments->where('status', '=', 'PAID')->sum('cheque_installment_amount')}}
                                            </td>
                                            <td class="d-flex">
                                                <a href="javascript:;" class="btn btn-danger btn-sm"
                                                    onclick="confirmAction('{{ route('client.delete', $data->id) }}')">
                                                    <i class="fas fa-regular fa-trash"></i>
                                                </a>
                                                <a href="{{ route('client.show', $data->id) }}"
                                                    class="btn btn-warning btn-sm mx-1"><i
                                                        class="fas fa-regular fa-eye"></i>
                                                </a>
                                                <a href="{{ route('client.edit', $data->id) }}"
                                                    class="btn btn-primary btn-sm"><i class="fas fa-regular fa-pencil"></i>
                                                </a>
                                            </td>
                                            <td><a href="{{ route('client.installments', $data->id) }}"
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
