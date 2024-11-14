@extends('admin.app')
@section('content')

    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                Profile Update
            </h3>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="{{route('users.profile.update')}}" method="POST">
                    @csrf
                    @method('PATCH')
                    @include('profile.fields')
                    <div class="col-md-12">
                        <div class="form-group row">
                            <button class="btn btn-sm btn-primary" type="submit">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
