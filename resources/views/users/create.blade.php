@extends('admin.app')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                User / Create
            </h3>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('users.store') }}" method="post">
                    @csrf
                    @include('users.fields')
                    <div class="mt-4 gap-2 d-flex justify-content-end">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <button class="btn btn-light text-decoration-none"> <a href="{{ route('users.index') }}"
                                class="text-decoration-none underline-none text-dark">Cancel</a> </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
