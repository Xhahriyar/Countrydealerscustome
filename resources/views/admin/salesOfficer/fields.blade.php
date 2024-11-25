<div class="row">
    <div class="col-md-6">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">First Name<sup class="text-danger">*</sup></label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="first_name" value="{{ $data['first_name'] ?? '' }}"
                    placeholder="First name here">
                @error('first_name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Last Name<sup class="text-danger">*</sup></label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="last_name" value="{{ $data['last_name'] ?? '' }}"
                    placeholder="Last name here">
                @error('last_name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">CNIC<sup class="text-danger">*</sup></label>
            <div class="col-sm-9">
                <input type="number" class="form-control" name="cnic" value="{{ $data['cnic'] ?? '' }}"
                    placeholder="CNIC Here">
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
                <input type="text" class="form-control" name="contact_no" value="{{ $data['contact_no'] ?? '' }}"
                    placeholder="Contact No Here">
                @error('contact_no')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Email</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="email" value="{{ $data['email'] ?? '' }}"
                    placeholder="Email Here">
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Joining Date<sup class="text-danger">*</sup></label>
            <div class="col-sm-9">
                <input type="date" class="form-control" name="joining_date" id="joining_date"
                    placeholder="joining_date" value="{{ $data['joining_date'] ?? old('joining_date') }}">
                @error('joining_date')
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
                <select class="form-control" name="officer_type">
                    <option disabled selected>-- select an option --</option>
                    @foreach ($salesOfficerTypes as $item)
                        <option value="{{ $item->name }}">{{ $item->name }}</option>
                    @endforeach
                </select>

                </select>
                @error('officer_type')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Select Designation</label>
            <div class="col-sm-9">
                <select class="form-control" name="designation">
                    <option disabled selected>-- select an option --</option>
                    @foreach ($salesOfficerDesignations as $item)
                        <option value="{{ $item->name }}">{{ $item->name }}</option>
                    @endforeach
                </select>

                </select>
                @error('designation')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>
</div>
