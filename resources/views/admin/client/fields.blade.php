<div class="row">
    <div class="col-md-6">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Client Type</label>
            <div class="col-sm-9">
                <select class="form-control" name="client_type">
                    <option disabled selected>-- select an option --</option>
                    @foreach (config('vars.client_type') as $clientType)
                        <option value="{{ $clientType }}" @if (!empty($data->clientType) && $data->clientType == $clientType) selected @endif>
                            {{ $clientType }}
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
            <label class="col-sm-3 col-form-label">Paid By</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="paid_by" value="{{ $data['paid_by'] ?? '' }}"
                    placeholder="Paid by">
                @error('paid_by')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Plot #</label>
            <div class="col-sm-9">
                <input type="number" class="form-control" name="plot_number" value="{{ $data['plot_number'] ?? '' }}"
                    placeholder="Plot Number">
                @error('plot_number')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Location</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="location" value="{{ $data['location'] ?? '' }}"
                    placeholder="location here">
                @error('location')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Plot Price</label>
            <div class="col-sm-9">
                <input type="number" class="form-control" name="plot_price" value="{{ $data['plot_price'] ?? '' }}"
                    placeholder="Plot price">
                @error('plot_price')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Plot Demand</label>
            <div class="col-sm-9">
                <input type="number" class="form-control" name="plot_demand" value="{{ $data['plot_demand'] ?? '' }}"
                    placeholder="Plot Demand">
                @error('plot_demand')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Plot Sale Price</label>
            <div class="col-sm-9">
                <input type="number" class="form-control" name="plot_sale_price"
                    value="{{ $data['plot_sale_price'] ?? '' }}" placeholder="Plot Sale Price">
                @error('plot_sale_price')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Agreement (check for agreement)</label>
            <div class="">
                <input type="checkbox" class="form-control mt-3 ml-1" name="agreement"
                    value="{{ $data['agreement'] ?? '' }}">
                @error('agreement')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Properties/Vehicles Adjusted</label>
            <div class="col-md-12">
                <textarea name="vehicles_adjustment" rows="10" id="" class="form-control"
                    placeholder="Details of any properties or vehicles adjusted"></textarea>
                @error('agreement')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Price of adjustment</label>
            <div class="col-sm-9">
                <input type="number" class="form-control" name="adjustment_price"
                    value="{{ $data['adjustment_price'] ?? '' }}" placeholder="Price Of Adjustment">
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
                    value="{{ $data['adjustment_product'] ?? '' }}" placeholder="Picture of adjustment product" accept="image/*">
                @error('adjustment_product')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Select Payment Type</label>
            <div class="col-sm-9">
                <select name="full_payment_check" id="payment_type" class="form-control">
                    <option disabled selected>-- selelc if payment is full or not --</option>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
                @error('full_payment_check')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-md-6" id="full_payment_box">
        {{-- dynamic html --}}
    </div>
    <div class="col-md-6 full_payment_box">

    </div>
    <div class="col-md-6 cash_field_count_box">

    </div>

</div>
<div class="cheque_boxes row">

</div>
<div class="row">
    <label class="col-sm-3 col-form-label">Select Sales Officer</label>
    <select name="" id="" class="form-control">
        <option selected disabled>-- select sales officer --</option>
        @foreach ($salesOfficers as $salesOfficer)
        <option value="{{$salesOfficer->id}}">{{$salesOfficer->name}}</option>
        @endforeach
    </select>
</div>
<div class="row" id="cheque_fields_container">

</div>
