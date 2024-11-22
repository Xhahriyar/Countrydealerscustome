<div class="row">
    <div class="col-md-12">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Employee Type</label>
            <div class="col-sm-12">
                <select class="form-control" name="employee_type">
                    <option disabled selected>-- select an option --</option>
                    @foreach (config('vars.employee_type') as $employeeType)
                        <option value="{{ $employeeType }}" @if (!empty($data->employee_type) && $data->employee_type == $employeeType) selected @endif>
                            {{ $employeeType }}
                        </option>
                    @endforeach
                </select>
                @error('employee_type')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">First Name</label>
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
            <label class="col-sm-3 col-form-label">Last Name</label>
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
            <label class="col-sm-3 col-form-label">Father Name</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="father_name" value="{{ $data['father_name'] ?? '' }}"
                    placeholder="Father Name here">
                @error('father_name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Joining Date</label>
            <div class="col-sm-9">
                <input type="date" class="form-control" name="joining_date"
                    value="{{ $data['joining_date'] ?? '' }}">
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
            <label class="col-sm-3 col-form-label">Bank Title</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="bank_name" value="{{ $data['bank_name'] ?? '' }}"
                    placeholder="Bank Name/Title here">
                @error('bank_name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Account #</label>
            <div class="col-sm-9">
                <input type="number" class="form-control" name="account_number" min="0"
                    value="{{ $data['account_number'] ?? '' }}" placeholder="Account Number here">
                @error('account_number')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">CNIC #</label>
            <div class="col-sm-9">
                <input type="number" class="form-control" name="cnic" min="0"
                    value="{{ $data['cnic'] ?? '' }}" placeholder="CNIC here">
                @error('cnic')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Profile Image</label>
            <div class="col-sm-9">
                <input type="file" class="form-control" name="image" accept="image/*">
                @error('image')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">CNIC Front Image</label>
            <div class="col-sm-9">
                <input type="file" class="form-control" name="cnic_front_image" accept="image/*">
                @error('cnic_front_image')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">CNIC Back Image</label>
            <div class="col-sm-9">
                <input type="file" class="form-control" name="cnic_back_image" accept="image/*">
                @error('cnic_back_image')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Father CNIC Front Image</label>
            <div class="col-sm-9">
                <input type="file" class="form-control" name="father_cnic_front_image" accept="image/*">
                @error('father_cnic_front_image')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Fatehr CNIC Back Image</label>
            <div class="col-sm-9">
                <input type="file" class="form-control" name="father_cnic_back_image" accept="image/*">
                @error('father_cnic_back_image')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Previous Experience</label>
            <div class="col-sm-9">
                <textarea class="form-control" name="previous_experience" placeholder="Your Previous Experience here">{{ $data['previous_experience'] ?? '' }}</textarea>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">CV</label>
            <div class="col-sm-9">
                <input type="file" class="form-control" name="cv" accept=".pdf , .txt , .docx">
                @error('cv')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group row">
            <label class="col-sm-3">Reference</label>
            <div class="col-sm-12">
                <textarea name="" id="" cols="30" rows="5" class="form-control" name="reference"
                    placeholder="Your Reference here">{{ $data['reference'] ?? '' }}</textarea>
                @error('reference')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Salary</label>
            <div class="col-sm-9">
                <input type="number" class="form-control" name="salary" min="0"
                    value="{{ $data['salary'] ?? '' }}" placeholder="Salary here">
                @error('salary')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Designation</label>
            <div class="col-sm-9">
                <select class="form-control" name="designation">
                    <option disabled selected>-- select an option --</option>
                    @foreach (App\Services\TypeService::getEmployeeDesignation() as $designation)
                        <option value="{{ $designation->name }}" @if (!empty($data->designation) && $data->designation == $designation->name) selected @endif>
                            {{ $designation->name }}
                        </option>
                    @endforeach
                </select>

                @error('designation')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Department</label>
            <div class="col-sm-9">
                <select class="form-control" name="department">
                    <option disabled selected>-- select an option --</option>
                    @foreach (App\Services\TypeService::getEmployeeDepartment() as $department)
                        <option value="{{ $department->name }}" @if (!empty($data->department) && $data->department == $department->name) selected @endif>
                            {{ $department->name }}
                    @endforeach
                </select>
                @error('department')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Loan Amount</label>
            <div class="col-sm-9">
                <input type="number" class="form-control" name="loan_amount" min="0"
                    value="{{ $data['loan_amount'] ?? '' }}" placeholder="Loan Amount here">
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Loan Return (Monthly)</label>
            <div class="col-sm-9">
                <input type="number" class="form-control" name="loan_return" min="0"
                    value="{{ $data['loan_return'] ?? '' }}" placeholder="Monthly Return Loan Amount">
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Loan Duration (In Months)</label>
            <div class="col-sm-9">
                <input type="number" class="form-control" name="loan_duration" min="0"
                    value="{{ $data['loan_duration'] ?? '' }}" placeholder="Loan Duration (eg : 10)">
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Date of Birth</label>
            <div class="col-sm-9">
                <input class="form-control" placeholder="dd/mm/yyyy" name="date_of_birth" type="date"
                    value="{{ $data['joining_date'] ?? '' }}">
                @error('date_of_birth')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Gender</label>
            <div class="col-sm-9">
                <select class="form-control" name="gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
                @error('gender')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group row">
            <label class="col-sm-3">Other Allowances</label>
            <div class="col-sm-12">
                <input type="number" class="form-control" name="other_allowance" min="0"
                    value="{{ $data['other_allowance'] ?? '' }}" placeholder="Other Allowances (eg : 10000)">
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group row">
            <label class="col-sm-3">Other Allowances (Description)</label>
            <div class="col-sm-12">
                <textarea class="form-control" name="fuel_adjustment" rows="5"
                    placeholder="Briefly Describe the allowance given to the employee (Fuel , Residence)">{{ $data['fuel_adjustment'] ?? '' }}</textarea>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group row">
            <label class="col-sm-3">Address</label>
            <div class="col-sm-12">
                <textarea class="form-control" name="address" rows="5" placeholder="Address Here..">{{ $data['address'] ?? '' }}</textarea>
            </div>
        </div>
    </div>
</div>
