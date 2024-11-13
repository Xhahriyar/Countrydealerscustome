<div class="row">
    <div class="col-md-6">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">First Name <sup class="text-danger">*</sup></label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="first_name" value="{{ $data['first_name'] ?? '' }}"
                    placeholder="First Name here">
                @error('first_name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Last Name <sup class="text-danger">*</sup></label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="last_name" value="{{ $data['last_name'] ?? '' }}"
                    placeholder="Last Name here">
                @error('last_name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Email <sup class="text-danger">*</sup></label>
            <div class="col-sm-9">
                <input type="email" class="form-control" name="email" value="{{ $data['email'] ?? '' }}"
                    placeholder="Email address here">
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Select Role <sup class="text-danger">*</sup></label>
            <div class="col-sm-9">
                <select class="form-control" name="role">
                    <option disabled selected>-- select an option --</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}" @if (!empty($data->role) && $data->role == $role->id) selected @endif>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
                @error('role')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>
</div>
