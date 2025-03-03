@extends('admin.app')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                Purchase
            </h3>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('purchase.update', $data->id) }}" method="post" id="formWithAmountInputsFields"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 my-2">
                            <h5 class="">Personal Info</h5>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Name <sup class="text-danger">*</sup></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="name"
                                        value="{{ $data['name'] ?? old('name') }}" placeholder="Name Here">
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="email"
                                        value="{{ $data['email'] ?? old('email') }}" placeholder="Email Here">
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">CNIC<sup class="text-danger">*</sup></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="cnic"
                                        value="{{ $data['cnic'] ?? old('cnic') }}" placeholder="CNIC Here">
                                    @error('cnic')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Contact No<sup class="text-danger">*</sup></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="contact_no"
                                        value="{{ $data['contact_no'] ?? old('contact_no') }}"
                                        placeholder="Contact No Here">
                                    @error('contact_no')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Fatehr/Husband Name<sup
                                        class="text-danger">*</sup></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="father_or_husband_name"
                                        value="{{ $data['father_or_husband_name'] ?? old('father_or_husband_name') }}"
                                        placeholder="Father/Husband Name Here">
                                    @error('father_or_husband_name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 my-2">
                            <h5 class="">Property Info</h5>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Client Type<sup class="text-danger">*</sup></label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="client_type">
                                        <option disabled selected>-- select an option --</option>
                                        @foreach (App\Services\TypeService::getPurchaseTypes() as $clientType)
                                            <option value="{{ $clientType->name }}"
                                                @if (!empty($data->client_type) && $data->client_type == $clientType->name) selected @endif>
                                                {{ $clientType->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('client_type')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Sale Type<sup class="text-danger">*</sup></label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="sale_type">
                                        <option disabled selected>-- select an option --</option>
                                        @foreach (config('vars.sale_type') as $saleType)
                                            <option value="{{ $saleType }}"
                                                @if (!empty($data->sale_type) && $data->sale_type == $saleType) selected @endif>
                                                {{ $saleType }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('client_type')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Paid By<sup class="text-danger">*</sup></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="paid_by"
                                        value="{{ $data['paid_by'] ?? old('paid_by') }}" placeholder="Paid by">
                                    @error('paid_by')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Plot No <sup class="text-danger">*</sup></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="plot_number"
                                        value="{{ $data['plot_number'] ?? old('plot_number') }}"
                                        placeholder="Plot Number">
                                    @error('plot_number')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Plot Size <sup class="text-danger">*</sup></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="plot_size"
                                        value="{{ $data['plot_size'] ?? old('plot_size') }}" placeholder="Plot Size">
                                    @error('plot_size')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Address<sup class="text-danger">*</sup></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="address"
                                        value="{{ $data['address'] ?? old('address') }}" placeholder="Address here">
                                    @error('address')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Plot Sale Price<sup
                                        class="text-danger">*</sup></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control amount-field" name="plot_sale_price"
                                        value="{{ $data['plot_sale_price'] ?? old('plot_sale_price') }}"
                                        placeholder="Plot Sale Price" id="plotSalePrice">
                                    @error('plot_sale_price')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Advance Payment</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control amount-field" name="advance_payment"
                                        id="advancePayment" placeholder="Advance Payment"
                                        value="{{ $data['advance_payment'] ?? old('advance_payment') }}">
                                    @error('advance_payment')
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
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Last Date to Clear Payment<sup
                                        class="text-danger">*</sup></label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" name="last_date_to_clear_payment"
                                        id="last_date_to_clear_payment" placeholder="Last date to clear payment here"
                                        value="{{ $data['last_date_to_clear_payment'] ?? old('last_date_to_clear_payment') }}">
                                    @error('last_date_to_clear_payment')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 my-2">
                            <h5 class="">Adjustment Info</h5>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Properties/Vehicles Adjusted</label>
                                <div class="col-md-12">
                                    <textarea name="vehicles_adjustment" rows="10" id="" class="form-control"
                                        placeholder="Details of any properties or vehicles adjusted">{{ $data['vehicles_adjustment'] ?? old('vehicles_adjustment') }}</textarea>
                                    @error('vehicles_adjustment')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Price of adjustment</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control amount-field" name="adjustment_price"
                                        value="{{ $data['adjustment_price'] ?? old('adjustment_price') }}"
                                        placeholder="Price Of Adjustment" id="adjustmentPrice">
                                    @error('adjustment_price')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Picture of adjustment product</label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control" name="adjustment_product"
                                        accept="image/*">
                                    @error('adjustment_product')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            @if (!empty($data['adjustment_product']))
                                <img src="{{ Storage::url($data->adjustment_product) }}" alt="" width="200px">
                            @endif
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mt-4 gap-2 d-flex justify-content-start">
                                <button class="btn btn-light text-decoration-none"> <a
                                        href="{{ route('purchase.index') }}"
                                        class="text-decoration-none underline-none text-dark">Cancel</a> </button>
                                <button type="submit" class="btn btn-success">Update</button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection

@section('bottom-scripts')
    <script>
        // Format the amount with commas
        function formatAmount(input) {
            const value = input.value.replace(/,/g, ''); // Remove commas
            if (!isNaN(value) && value !== "") {
                input.value = parseFloat(value).toLocaleString('en-US'); // Add commas
            } else {
                input.value = ""; // Clear invalid input
            }
        }
        // Remove formatting (commas) when focusing or before submission
        function removeFormatting(input) {
            input.value = input.value.replace(/,/g, ''); // Remove commas
        }

        // Handle dynamic input formatting
        document.addEventListener('input', function(event) {
            if (event.target.classList.contains('amount-field')) {
                formatAmount(event.target);
            }
        });

        document.addEventListener('focusin', function(event) {
            if (event.target.classList.contains('amount-field')) {
                formatAmount(event.target);
            }
        });

        document.addEventListener('focusout', function(event) {
            if (event.target.classList.contains('amount-field')) {
                formatAmount(event.target); // Reapply formatting on blur
            }
        });

        // Remove formatting before form submission
        document.getElementById('formWithAmountInputsFields').addEventListener('submit', function(event) {
            const amountFields = document.querySelectorAll('.amount-field');
            amountFields.forEach(input => {
                input.value = input.value.replace(/,/g, ''); // Remove commas before submission
            });
        });
    </script>
@endsection
