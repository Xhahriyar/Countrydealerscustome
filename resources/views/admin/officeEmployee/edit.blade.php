@extends('admin.app')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                Admin Office Employee Update
            </h3>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('employee.office.update', $data->id) }}" id='formWithAmountInputsFields' method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @include('admin.officeEmployee.fields')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card rounded border mb-2">
                                <div class="card-body p-3">
                                    <div class="media">
                                        <div class="media-body">
                                            <h6 class="mb-1">Profile Image</h6>
                                            <img src="{{ Storage::url($data->image) }}" alt="{{ $data->image }}"
                                                width="100%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card rounded border mb-2">
                                <div class="card-body p-3">
                                    <div class="media">
                                        <div class="media-body">
                                            <h6 class="mb-1">CNIC Front Image</h6>
                                            <img src="{{ Storage::url($data->cnic_front_image) }}" alt="{{ $data->image }}"
                                                width="100%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card rounded border mb-2">
                                <div class="card-body p-3">
                                    <div class="media">
                                        <div class="media-body">
                                            <h6 class="mb-1">CNIC Back Image</h6>
                                            <img src="{{ Storage::url($data->cnic_back_image) }}" alt="{{ $data->image }}"
                                                width="100%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card rounded border mb-2">
                                <div class="card-body p-3">
                                    <div class="media">
                                        <div class="media-body">
                                            <h6 class="mb-1">Father's CNIC Front Image</h6>
                                            <img src="{{ Storage::url($data->father_cnic_front_image) }}"
                                                alt="{{ $data->image }}" width="100%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card rounded border mb-2">
                                <div class="card-body p-3">
                                    <div class="media">
                                        <div class="media-body">
                                            <h6 class="mb-1">Father's CNIC Back Image</h6>
                                            <img src="{{ Storage::url($data->father_cnic_back_image) }}"
                                                alt="{{ $data->image }}" width="100%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card rounded border mb-2">
                                <div class="card-body p-3">
                                    <div class="media">
                                        <div class="media-body">
                                            <h6 class="mb-1">CV</h6>
                                            <a href="{{ Storage::url($data->cv) }}" class="btn btn-sm btn-primary"
                                                target="_blank"><i class="fa fa-eye"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="my-4 gap-2 d-flex justify-content-start">
                            <button class="btn btn-sm btn-light text-decoration-none"> <a
                                    href="{{ route('employee.office.index') }}"
                                    class="text-decoration-none underline-none text-dark">Cancel</a> </button>
                            <button class="btn btn-success btn-sm" type="submit">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('bottom-scripts')
    <script>
        // Function to format the input with commas
        function formatAmount(input) {
            const value = input.value.replace(/,/g, '');
            if (!isNaN(value) && value !== "") {
                input.value = parseFloat(value).toLocaleString('en-US');
            } else {
                input.value = "";
            }
        }

        // Remove formatting on form submission
        document.getElementById('formWithAmountInputsFields').addEventListener('submit', function() {
            const salary = document.getElementById('salary');
            salary.value = salary.value.replace(/,/g, '');
            const loanAmount = document.getElementById('loanAmount');
            loanAmount.value = loanAmount.value.replace(/,/g, '');
            const loanReturn = document.getElementById('loanReturn');
            loanReturn.value = loanReturn.value.replace(/,/g, '');
            const otherAllowance = document.getElementById('otherAllowance');
            otherAllowance.value = otherAllowance.value.replace(/,/g, '');
        });
    </script>
@endsection
