<div class="modal fade" id="dealModal" tabindex="-1" role="dialog" aria-labelledby="dealModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dealModalLabel">Commission Amount</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form
                action="{{ route('update.sales.officer.commission', ['salesOfficerId' => $salesOfficerId, 'clientId' => $clientId]) }}"
                method="post">
                <div class="modal-body">
                    <div class="row">
                        @csrf
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-sm-12 col-form-label">Commission Amount</label>
                                <div class="col-sm-12">
                                    {{-- {{$salesOfficerId}} {{$clientId}} --}}
                                    <input type="number" class="form-control" name="commission_payment"
                                        placeholder="Commission Amount Here" value="{{ old('commission_payment') }}">
                                    @error('commission_payment')
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
