@extends('admin.app')
@section('content')

    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                Sales Officer
            </h3>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="{{route('sales.officer.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @include('admin.salesOfficer.fields')
                    <div class="col-md-12">
                        <div class="form-group mt-4 gap-2 d-flex justify-content-start">
                            <button class="btn btn-light text-decoration-none"> <a href="{{ route('sales.officer.index') }}"
                                    class="text-decoration-none underline-none text-dark">Cancel</a> </button>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
