<div class="modal fade show custom-modal" id="confirmPaidInstallmentModal" tabindex="-1" role="dialog" data-backdrop="true"
    data-keyboard="true" aria-labelledby="confirmPaidInstallmentModalLabel"
    style="display: block; background-color: rgba(0, 0, 0, 0.48) !important;
    opacity: 7;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmPaidInstallmentModalLabel">Confirm Pay Installment</h5>
                <button class="btn text-dark text-decoration-none"> <a
                        href="{{ route('client.installments', ['id' => $id]) }}"
                        class="text-decoration-none underline-none text-dark"><span aria-hidden="true">×</span></a>
                </button>

            </div>
            <form action="{{ route('client.installment.status.update', ['id' => $installmentId]) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 d-none">
                            <div class="form-group row">
                                <div class="col-sm-9">
                                    <input type="hidden" class="form-control" name="id" id="id" value="{{ $id }}">
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Payment Method</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="payment_type" id="payment_type">
                                        <option value="">Select Payment Method</option>
                                        <option value="check" {{ old('payment_type') == 'check' ? 'selected' : '' }}>
                                            Check</option>
                                        <option value="cash" {{ old('payment_type') == 'cash' ? 'selected' : '' }}>
                                            Cash</option>
                                        <option value="online_transfer"
                                            {{ old('payment_type') == 'online_transfer' ? 'selected' : '' }}>Online
                                            Transfer</option>
                                    </select>
                                    @error('payment_type')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Receipt Image</label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control" name="receipt_image" accept=".jpeg,.png,.jpg,.gif">
                                    @error('receipt_image')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Date<sup class="text-danger">*</sup></label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" name="date" id="date"
                                        placeholder="date" value="{{ $data['date'] ?? old('date') }}">
                                    @error('date')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="my-4 gap-2 d-flex justify-content-end">
                        <button class="btn btn-md btn-warning text-decoration-none"> <a
                                href="{{ route('client.installments', ['id' => $id]) }}"
                                class="text-decoration-none underline-none text-light">Cancel</a> </button>
                        <button class="btn btn-success btn-md" type="submit">Paid</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
