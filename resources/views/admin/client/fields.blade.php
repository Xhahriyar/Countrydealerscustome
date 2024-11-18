<div class="row">
    <div class="card col-md-12">
        <div class="card-body row">
            <div class="col-md-12 mb-4">
                <h5 class="">Personal Info</h5>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Name <sup class="text-danger">*</sup> </label>
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
                    <label class="col-sm-3 col-form-label">Email <sup class="text-danger">*</sup> </label>
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
                    <label class="col-sm-3 col-form-label">CNIC <sup class="text-danger">*</sup></label>
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
                    <label class="col-sm-3 col-form-label">Contact No <sup class="text-danger">*</sup></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="number"
                            value="{{ $data['contact_no'] ?? old('contact_no') }}" placeholder="Contact No Here">
                        @error('contact_no')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Fatehr/Husband Name <sup class="text-danger">*</sup></label>
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
        </div>
    </div>
    <div class="card col-md-12 mt-3">
        <div class="card-body row">
            <div class="col-md-12 mb-4">
                <h5 class="">Property Info</h5>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">
                        @if ($type == 'purchase')
                            Purchase
                        @else
                            Client
                        @endif Type <sup class="text-danger">*</sup>
                    </label>
                    <div class="col-sm-9">
                        @if ($type == 'client')
                            <select class="form-control" name="client_type">
                                <option disabled selected>-- select an option --</option>
                                @foreach (App\Services\TypeService::getClientTypes() as $clientType)
                                    <option value="{{ $clientType->name }}"
                                        @if (!empty($data->clientType) && $data->clientType == $clientType) selected @endif>
                                        {{ $clientType->name }}
                                    </option>
                                @endforeach
                            </select>
                        @else
                            <select class="form-control" name="client_type">
                                <option disabled selected>-- select an option --</option>
                                @foreach (App\Services\TypeService::getPurchaseTypes() as $clientType)
                                    <option value="{{ $clientType->name }}"
                                        @if (!empty($data->clientType) && $data->clientType == $clientType) selected @endif>
                                        {{ $clientType->name }}
                                    </option>
                                @endforeach
                            </select>
                        @endif
                        @error('client_type')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Sale Type <sup class="text-danger">*</sup></label>
                    <div class="col-sm-9">
                        <select class="form-control" name="sale_type">
                            <option disabled selected>-- select an option --</option>
                            @foreach (config('vars.sale_type') as $saleType)
                                <option value="{{ $saleType }}" @if (!empty($data->saleType) && $data->saleType == $saleType) selected @endif>
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
                    <label class="col-sm-3 col-form-label">Paid By <sup class="text-danger">*</sup></label>
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
                    <label class="col-sm-3 col-form-label">Plot # <sup class="text-danger">*</sup></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="plot_number"
                            value="{{ $data['plot_number'] ?? old('plot_number') }}" placeholder="Plot Number">
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
                    <label class="col-sm-3 col-form-label">
                        Address<sup class="text-danger">*</sup>
                    </label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="location"
                            value="{{ $data['address'] ?? old('address') }}" placeholder="address here">
                        @error('address')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Plot Sale Price <sup class="text-danger">*</sup></label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" name="plot_sale_price"
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
                        <input type="number" class="form-control mt-3 ml-1" name="advance_payment"
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
                    <label class="col-sm-3 col-form-label">Date</label>
                    <div class="col-sm-9">
                        <input type="date" class="form-control mt-3 ml-1" name="date" id="date"
                            placeholder="date" value="{{ $data['date'] ?? old('date') }}">
                        @error('date')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card col-md-12 mt-3">
        <div class="card-body row">
            <div class="col-md-12 my-2">
                <h5 class="">Adjustment Info</h5>
            </div>
            <div class="col-md-12">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Properties/Vehicles Adjusted</label>
                    <div class="col-md-12">
                        <textarea name="vehicles_adjustment" rows="10" id="vehicles_adjustment" class="form-control"
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
                        <input type="text" class="form-control" name="adjustment_price"
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
                        <input type="file" class="form-control" name="adjustment_product" accept="image/*">
                        @error('adjustment_product')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12" style="display: none" id="priceNoteShow">
        <div class="alert alert-danger" role="alert">
            <strong>Note : </strong> <span id="totalCountAlertText"></span>
        </div>
    </div>
    <div class="cheque_boxes row">
    </div>
    <div class="row" id="cheque_fields_container">
    </div>
    @if ($type == 'client')
        <div class="card col-md-12 mt-3">
            <div class="card-body row">
                <div class="col-md-12 mb-4">
                    <h5 class="">Sales Officers Info</h5>
                </div>
                <div class="row col-md-12" id="sales_officer_box">
                    <div class="col-md-4">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Officer</label>
                            <div class="">
                                <select name="sales_officer_id[]" id="" class="form-control">
                                    <option selected disabled>-- select sales officer --</option>
                                    @foreach ($salesOfficers as $salesOfficer)
                                        <option value="{{ $salesOfficer->id }}">{{ $salesOfficer->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Type</label>
                            <div class="col-sm-9">
                                <select name="commission_type[]" id="" class="form-control">
                                    <option selected disabled>-- select type --</option>
                                    <option value="percent">Percent</option>
                                    <option value="cash">Cash</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Commission</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" placeholder="Commission here"
                                    name="commission_amount[]">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group row">
                            <button class="btn btn-sm btn-primary" id="add_more_officers">+</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card col-md-12 mt-3">
            <div class="card-body row">
                <div class="col-md-12 my-2">
                    <h5 class="">Other Owners Info</h5>
                </div>
                <div class="col-md-12">
                    <div class="form-group row my-2 d-flex justify-content-end">
                        <button class="btn btn-sm btn-primary" id="add_more_owners">+ More Owners</button>
                    </div>
                </div>
                <div class="row" id="add_more_owners_box">

                </div>
            </div>
        </div>
    @endif
</div>
