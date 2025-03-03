@extends('admin.app')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                Client Details
            </h3>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body d-flex justify-content-between">
                        <div class="col-md-4">
                            <p><strong for="">Name</strong></p>
                            <label for="">{{ $data->name }}</label>
                        </div>
                        <div class="col-md-4">
                            <p><strong for="">Email</strong></p>
                            <label for="">{{ $data->email }}</label>
                        </div>
                        <div class="col-md-4">
                            <p><strong for="">Phone</strong></p>
                            <label for="">{{ $data->number }}</label>
                        </div>
                    </div>
                    <div class="card-body d-flex justify-content-between">
                        <div class="col-md-4">
                            <p><strong for="">Father/Husband Name</strong></p>
                            <label for="">{{ $data->father_or_husband_name }}</label>
                        </div>
                        <div class="col-md-4">
                            <p><strong for="">Client Type</strong></p>
                            <label for="">{{ $data->client_type }}</label>
                        </div>
                        <div class="col-md-4">
                            <p><strong for="">Sale Type</strong></p>
                            <label for="">{{ $data->sale_type }}</label>
                        </div>
                    </div>
                    <div class="card-body d-flex justify-content-between">
                        <div class="col-md-4">
                            <p><strong for="">Paid By</strong></p>
                            <label for="">{{ $data->paid_by }}</label>
                        </div>
                        <div class="col-md-4">
                            <p><strong for="">Plot Number</strong></p>
                            <label for="">{{ $data->plot_number }}</label>
                        </div>
                        <div class="col-md-4">
                            <p><strong for="">Location</strong></p>
                            <label for="">{{ $data->location }}</label>
                        </div>
                    </div>
                    <div class="card-body d-flex justify-content-between">
                        <div class="col-md-4">
                            <p><strong for="">Plot Price</strong></p>
                            <label for="">{{ formatNumberWithCurrencyExtension($data->plot_price) }}</label>
                        </div>
                        <div class="col-md-4">
                            <p><strong for="">Plot Demand</strong></p>
                            <label for="">{{ formatNumberWithCurrencyExtension($data->plot_demand) }}</label>
                        </div>
                        <div class="col-md-4">
                            <p><strong for="">Plot Sale Price</strong></p>
                            <label for="">{{ formatNumberWithCurrencyExtension($data->plot_sale_price) }}</label>
                        </div>
                    </div>
                    <div class="card-body d-flex justify-content-between">
                        <div class="col-md-3">
                            <p><strong for="">Vehicles Adjustment</strong></p>
                            <label for="">{{ $data->vehicles_adjustment }}</label>
                        </div>
                        <div class="col-md-3">
                            <p><strong for="">Adjustment Price</strong></p>
                            <label for="">{{ formatNumberWithCurrencyExtension($data->adjustment_price) }}</label>
                        </div>
                        <div class="col-md-3">
                            <p><strong for="">Advance Payment</strong></p>
                            <label for="">{{ formatNumberWithCurrencyExtension($data->advance_payment) }}</label>
                        </div>
                        <div class="col-md-3">
                            <p><strong for="">Adjustment Product</strong></p>
                            <a href="{{ Storage::url($data->adjustment_product) }}" target="_blank"><img
                                    src="{{ Storage::url($data->adjustment_product) }}" alt="Adjustment Image"
                                    height="20px"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (count($data->installments) > 0)
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">
                    Installment Details
                </h3>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        @forelse ($data->installments as $installment)
                            @if ($installment->payment_method === 'cash')
                                <div class="card-body d-flex justify-content-between">
                                    <div class="col-md-3">
                                        <p><strong for="">Payment Type</strong></p>
                                        {{ $installment->payment_type === 'yes' ? 'Full Payment' : 'Installment' }}
                                    </div>
                                    <div class="col-md-3">
                                        <p><strong for="">Payment Method</strong></p>
                                        {{ $installment->payment_method }}
                                    </div>
                                    <div class="col-md-3">
                                        <p><strong for="">Installment Payment</strong></p>
                                        {{ formatNumberWithCurrencyExtension($installment->installment_payment) }}
                                    </div>
                                    <div class="col-md-3">
                                        <p><strong for="">Payment Installment Due Date</strong></p>
                                        {{ Carbon\Carbon::parse($installment->payment_installment_due_date)->format('D-M-Y') }}
                                    </div>
                                </div>
                            @else
                                <div class="card-body d-flex justify-content-between">
                                    <div class="col-md-4">
                                        <p><strong for="">Payment Type</strong></p>
                                        {{ $installment->payment_type === 'yes' ? 'Full Payment' : 'Installment' }}
                                    </div>
                                    <div class="col-md-4">
                                        <p><strong for="">Payment Method</strong></p>
                                        {{ $installment->payment_method }}
                                    </div>
                                    <div class="col-md-4">
                                        <p><strong for="">Cheque Image</strong></p>
                                        <a href="{{ Storage::url($installment->cheque_image) }}" target="_blank"><img
                                                src="{{ Storage::url($installment->cheque_image) }}" alt="Cheque Image"
                                                height="20px"></a>
                                    </div>
                                </div>
                                <div class="card-body d-flex">
                                    <div class="col-md-4">
                                        <p><strong for="">Cheque Installment Amount</strong></p>
                                        {{ formatNumberWithCurrencyExtension($installment->cheque_installment_amount) }}
                                    </div>
                                    <div class="col-md-4">
                                        <p><strong for="">Cheque Installment Due Date</strong></p>
                                        {{ Carbon\Carbon::parse($installment->cheque_installment_due_date)->format('D-M-Y') }}
                                    </div>
                                </div>
                            @endif
                        @empty
                            <h5 class="text-center m-0 py-4">No data found.</h5>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (count($data->payments) > 0)
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">
                    Plot Payments
                </h3>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        @forelse ($data->payments as $payment)
                            <div class="card-body d-flex justify-content-between">
                                @if ($payment->payment_method == 'cash')
                                    <div class="col-md-3">
                                        <p><strong for="">Payment Type</strong></p>
                                        {{ $payment->payment_type === 'yes' ? 'Full Payment' : 'Installment' }}
                                    </div>
                                    <div class="col-md-3">
                                        <p><strong for="">Payment Method</strong></p>
                                        {{ $payment->payment_method }}
                                    </div>
                                    <div class="col-md-3">
                                        <p><strong for="">Full Payment</strong></p>
                                        {{ formatNumberWithCurrencyExtension($payment->full_payment) }}
                                    </div>
                            </div>
                        @else
                            <div class="card-body d-flex justify-content-between">
                                <div class="col-md-2">
                                    <p><strong for="">Payment Type</strong></p>
                                    {{ $payment->payment_type === 'yes' ? 'Full Payment' : 'Installment' }}
                                </div>
                                <div class="col-md-3">
                                    <p><strong for="">Payment Method</strong></p>
                                    {{ $payment->payment_method }}
                                </div>
                                <div class="col-md-3">
                                    <p><strong for="">Cheque Image</strong></p>
                                    <a href="{{ Storage::url($payment->cheque_image) }}" target="_blank"><img
                                            src="{{ Storage::url($payment->cheque_image) }}" alt="Cheque Image"
                                            height="20px"></a>
                                </div>
                                <div class="col-md-2">
                                    <p><strong for="">Cheque Amount</strong></p>
                                    {{ formatNumberWithCurrencyExtension($payment->check_amount) }}
                                </div>
                                <div class="col-md-2">
                                    <p><strong for="">Due Date</strong></p>
                                    {{ Carbon\Carbon::parse($payment->due_date)->format('D-M-Y') }}
                                </div>
                            </div>
                        @endif
                    </div>
                @empty
                    <h5 class="text-center m-0 py-4">No data found.</h5>
    @endforelse
    </div>
    </div>
    </div>
    @endif
@endsection

@section('bottom-scripts')
@endsection
