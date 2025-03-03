<div class="modal fade" id="expenseModal" tabindex="-1" role="dialog" aria-labelledby="expenseModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="expenseModalLabel">Expense Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('expense.store') }}" id="formWithAmountInputsFields" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        @csrf
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control mt-3 ml-1" name="name" id="name"
                                        placeholder="Name here" value="{{ $data['name'] ?? old('name') }}">
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Date</label>
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
                                <label class="col-sm-3 col-form-label">Picture</label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control mt-3 ml-1" name="picture"
                                        accept="image/*">
                                    @error('picture')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Amount <sup class="text-danger">*</sup></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="amount" id='amount'
                                        placeholder="Amount here" oninput="formatAmount(this)"  onblur="formatAmount(this)">
                                    @error('amount')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Expense Type <sup
                                        class="text-danger">*</sup></label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="expense_type">
                                        <option disabled selected>-- select an option --</option>
                                        @foreach (App\Services\TypeService::getExpenseTypes() as $clientType)
                                            <option value="{{ $clientType->name }}"
                                                @if (!empty($data->clientType) && $data->clientType == $clientType) selected @endif>
                                                {{ $clientType->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('expense_type')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Expense Category <sup
                                        class="text-danger">*</sup></label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="expense_category">
                                        <option disabled selected>-- select an option --</option>
                                        @foreach (App\Services\TypeService::getExpenseCategories() as $clientType)
                                            <option value="{{ $clientType->name }}"
                                                @if (!empty($data->clientType) && $data->clientType == $clientType) selected @endif>
                                                {{ $clientType->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('expense_category')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Description <sup
                                        class="text-danger">*</sup></label>
                                <div class="col-sm-12">
                                    <textarea name="description" id="" cols="30" rows="10" class="form-control"
                                        placeholder="Enter Expense Details"></textarea>
                                    @error('description')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success">Submit</button>
                    <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
