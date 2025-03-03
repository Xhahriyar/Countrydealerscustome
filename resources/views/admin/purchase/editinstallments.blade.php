@extends('admin.app')

@section('content')
    @include('admin.purchase.modals.installment')
    @include('admin.purchase.modals.chequeInstallment')
    @include('admin.purchase.modals.confirmPaidInstallment')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                Cash Installment Details
            </h3>
            <div>
                @can('purchase_cash_installment-add')
                    <a href="javascript:;" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#installmentModal">+
                        New</a>
                @endcan
                {{-- <a href="{{ route('print.all.installments', $id) }}" class="btn btn-primary btn-sm" target="_blank">Print
                    All</a> --}}
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card px-2">
                    <div class="table-responsive">
                        <table id="cashInstallmentTable" class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Payment Type</th>
                                    <th>Payment Method</th>
                                    <th>Installment Payment</th>
                                    <th>Due Date</th>
                                    <th>Paid Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cashInstallments as $key => $installment)
                                    <tr>
                                        <td>{{ $key += 1 }}</td>
                                        <td>{{ $installment->payment_type === 'yes' ? 'Full Payment' : 'Installment' }}
                                        </td>
                                        <td>{{ $installment->payment_method }}</td>
                                        <td>{{ $installment->installment_payment }}</td>
                                        <td>{{ Carbon\Carbon::parse($installment->payment_installment_due_date)->format('D-M-Y') }}
                                        </td>
                                        <td>
                                            @if ($installment->status == 'PAID')
                                                {{ Carbon\Carbon::parse($installment->updated_at)->format('D-M-Y') }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($installment->status == null)
                                                <div class="badge badge-danger badge-pill">UNPAID</div>
                                            @else
                                                <div class="badge badge-success badge-pill">PAID</div>
                                            @endif
                                        </td>
                                        <td class="d-flex">
                                            @if ($installment->status == 'PAID')
                                                <button class="btn btn-sm btn-success mr-1" disabled>Paid</button>
                                                {{-- this id is client id --}}
                                                <a href="{{ route('purchase.print', ['client_id' => $id, 'installment_id' => $installment->id]) }}"
                                                    class="btn btn-outline-primary btn-sm" target="_blank">
                                                    <i class="fas fa-solid fa-print"></i>
                                                </a>
                                            @else
                                                @can('purchase_installment-status')
                                                    <a href="javascript:;" class="btn btn-outline-success btn-sm" data-toggle="modal"
                                                        data-target="#confirmPaidInstallmentModal"
                                                        data-id="{{ $installment->id }}">
                                                        Pay
                                                    </a>
                                                @endcan
                                            @endif
                                            @can('purchase_installment-delete')
                                                @if ($installment->status != 'PAID')
                                                    <form id="delete-form"
                                                        action="{{ route('purchase.installment.delete', $installment->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" onclick="confirmDelete()"
                                                            class="btn btn-sm btn-danger ml-2">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </button>
                                                    </form>
                                                @endif
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
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                Cheque Installment Details
            </h3>
            @can('client_check_installment-add')
                <a href="javascript:;" class="btn btn-primary btn-sm" data-toggle="modal"
                    data-target="#chequechequeInstallmentModal">+ New</a>
            @endcan
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card px-2">
                    <div class="table-responsive">
                        <table id="chequeInstallmentTable" class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Payment Type</th>
                                    <th>Payment Method</th>
                                    <th>Cheque Image</th>
                                    <th>Installment Amount</th>
                                    <th>Due Date</th>
                                    <th>Paid Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($chequeInstallments as $key => $installment)
                                    <tr>
                                        <td>{{ $key += 1 }}</td>
                                        <td>{{ $installment->payment_type === 'yes' ? 'Full Payment' : 'Installment' }}
                                        </td>
                                        <td>{{ $installment->payment_method }}</td>
                                        <td><a href="{{ Storage::url($installment->cheque_image) }}" target="_blank"><img
                                                    src="{{ Storage::url($installment->cheque_image) }}" alt="Cheque Image"
                                                    height="20px"></a>
                                        </td>
                                        <td>{{ $installment->cheque_installment_amount }}</td>
                                        <td>{{ Carbon\Carbon::parse($installment->cheque_installment_due_date)->format('D-M-Y') }}
                                        </td>
                                        <td>
                                            @if ($installment->status == 'PAID')
                                                {{ Carbon\Carbon::parse($installment->updated_at)->format('D-M-Y') }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($installment->status == null)
                                                <div class="badge badge-danger badge-pill">UNPAID</div>
                                            @else
                                                <div class="badge badge-success badge-pill">PAID</div>
                                            @endif
                                        </td>
                                        <td class="d-flex">
                                            @if ($installment->status == 'PAID')
                                                <button class="btn btn-sm btn-success" disabled>Paid</button>
                                                <a href="{{ route('client.print', ['client_id' => $id, 'installment_id' => $installment->id]) }}"
                                                    class="btn btn-outline-primary btn-sm ml-1" target="_blank">
                                                    <i class="fas fa-solid fa-print"></i>
                                                </a>
                                            @else
                                                @can('client_installment-status')
                                                    <a href="javascript:;" class="btn btn-outline-success btn-sm"
                                                        onclick="confirmAction('{{ route('client.installment.status.update', $installment->id) }}')">
                                                        <i class="fas fa-regular fa-check"></i></a>
                                                @endcan
                                            @endif
                                            @can('purchase_installment-delete')
                                                @if ($installment->status != 'PAID')
                                                    <form id="delete-form"
                                                        action="{{ route('purchase.installment.delete', $installment->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" onclick="confirmDelete()"
                                                            class="btn btn-sm btn-danger ml-2">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </button>
                                                    </form>
                                                @endif
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
@endsection

@section('bottom-scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const modal = document.getElementById('confirmPaidInstallmentModal');

            // Redirect to a specific route on modal close
            modal.addEventListener('hidden.bs.modal', function() {
                window.location.href =
                "{{ route('client.installments', ['id' => $id]) }}"; // Replace with your desired route
            });
        });
    </script>
@endsection
