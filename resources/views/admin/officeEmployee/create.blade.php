@extends('admin.app')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                Admin Office Employee
            </h3>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('employee.office.store') }}" id='formWithAmountInputsFields' method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @include('admin.officeEmployee.fields')
                    <div class="col-md-12">
                        <div class="my-4 gap-2 d-flex justify-content-start">
                            <button class="btn btn-sm btn-light text-decoration-none"> <a
                                    href="{{ route('employee.office.index') }}"
                                    class="text-decoration-none underline-none text-dark">Cancel</a> </button>
                            <button class="btn btn-success btn-sm" type="submit">Submit</button>
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

        // Function to remove formatting before form submission or editing
        function removeFormatting(input) {
            input.value = input.value.replace(/,/g, ''); // Remove commas
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
