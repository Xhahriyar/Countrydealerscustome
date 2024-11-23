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
                <form action="{{ route('employee.office.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @include('admin.officeEmployee.fields')
                    <div class="col-md-12">
                        <div class="my-4 gap-2 d-flex justify-content-start">
                            <button class="btn btn-sm btn-warning text-decoration-none"> <a
                                    href="{{ route('employee.office.index') }}"
                                    class="text-decoration-none underline-none text-light">Cancel</a> </button>
                            <button class="btn btn-primary btn-sm" type="submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
