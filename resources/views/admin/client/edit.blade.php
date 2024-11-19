@extends('admin.app')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                Clients
            </h3>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('client.update', $data->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 my-2">
                            <h5 class="">Personal Info</h5>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Name</label>
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
                                <label class="col-sm-3 col-form-label">CNIC</label>
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
                                <label class="col-sm-3 col-form-label">Contact No</label>
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
                                <label class="col-sm-3 col-form-label">Fatehr/Husband Name</label>
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
                                <label class="col-sm-3 col-form-label">Client Type</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="client_type">
                                        <option disabled selected>-- select an option --</option>
                                        @foreach (App\Services\TypeService::getClientTypes() as $clientType)
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
                                <label class="col-sm-3 col-form-label">Sale Type</label>
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
                                <label class="col-sm-3 col-form-label">Paid By</label>
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
                                <label class="col-sm-3 col-form-label">Plot #</label>
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
                                <label class="col-sm-3 col-form-label">Plot Size</label>
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
                                <label class="col-sm-3 col-form-label">Address</label>
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
                                <label class="col-sm-3 col-form-label">Plot Sale Price</label>
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
                                <label class="col-sm-3 col-form-label">Date<sup class="text-danger">*</sup></label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control mt-3 ml-1" name="date" id="date"
                                        placeholder="date" value="{{ $data['date'] ?? old('date') }}">
                                    @error('date')
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
                        {{-- @if (count($data->saleOfficers) > 0)
                            <div class="card col-md-12 mt-3">
                                <div class="card-body row">
                                    <div class="col-md-12 mb-4">
                                        <h5 class="">Sales Officers Info</h5>
                                    </div>
                                    @foreach ($data->saleOfficers as $officer)
                                        <div class="row col-md-12" id="sales_officer_box">
                                            <div class="col-md-4">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Officer</label>
                                                    <div class="">
                                                        <select name="sales_officer_id[]" id=""
                                                            class="form-control" disabled>
                                                            <option selected disabled>-- select sales officer --</option>
                                                            <option value="{{$officer->officer}}" selected>{{ $officer->officer->name }}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Type</label>
                                                    <div class="col-sm-9">
                                                        <select name="commission_type[]" id=""
                                                            class="form-control" >
                                                            <option selected disabled>-- select type --</option>
                                                            <option value="percent"
                                                                @if ($officer->commission_type == 'percent') selected @endif>Percent
                                                            </option>
                                                            <option value="cash"
                                                                @if ($officer->commission_type == 'cash') selected @endif>Cash
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Commission</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control"
                                                            placeholder="Commission here" name="commission_amount[]"
                                                            value="{{ $officer->commission_received / $data->saleOfficers->count() }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif --}}
                        <div class="col-md-12">
                            <div class="mt-4 gap-2 d-flex justify-content-start">
                                <button class="btn btn-warning text-decoration-none"> <a
                                        href="{{ route('client.index') }}"
                                        class="text-decoration-none underline-none text-light">Cancel</a> </button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('bottom-scripts')
    <script>
        function getResults() {
            let adjustmentPrice = parseFloat($('#adjustmentPrice').val()) || 0;
            let advancePayment = parseFloat($('#advancePayment').val()) || 0;
            let plotSalePrice = parseFloat($('#plotSalePrice').val()) || 0;
            let totalPrice = (plotSalePrice) - (adjustmentPrice + advancePayment);
            $('#totalCountAlertText').text('Remaining Amount For Installments ' + totalPrice);
        }
        $(document).on('input', '#advancePayment', function() {
            $('#priceNoteShow').show()
            getResults()
        })
        $(document).on('input', '#adjustmentPrice', function() {
            $('#priceNoteShow').show()
            getResults()
        })
        $(document).on('input', '#plotSalePrice', function() {
            $('#priceNoteShow').show()
            getResults()
        })
    </script>
@endsection
