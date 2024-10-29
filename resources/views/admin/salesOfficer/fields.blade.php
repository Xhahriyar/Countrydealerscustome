<div class="row">
    <div class="col-md-6">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Name</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="name" value="{{ $data['name'] ?? '' }}"
                    placeholder="Name here">
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">CNIC</label>
            <div class="col-sm-9">
                <input type="number" class="form-control" name="cnic"
                    value="{{ $data['cnic'] ?? '' }}" placeholder="CNIC Here">
                @error('cnic')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>

</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Select Type</label>
            <div class="col-sm-9">
                <select class="form-control" name="expense_type">
                    <option disabled selected>-- select an option --</option>
                    <option value="travel">sales team</option>
                    <option value="office_supplies">Office Employe</option>
                    <option value="other">Other</option>
                </select>

               </select>
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>
</div>
