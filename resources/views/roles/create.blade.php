@extends('admin.app')

@section('content')
    {{-- Breadcrumb (optional) --}}

    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">Role / Create</h3>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('roles.store') }}">
                    @csrf
                    {{-- Name Field --}}
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Name <sup class="text-danger">*</sup></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="name" value="{{ $data['name'] ?? '' }}"
                                placeholder=" Name here">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    {{-- Select All Checkbox --}}
                    <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" id="select-all" onclick="toggleSelectAll(this)"
                            {{ count($permissions) > 0 && count(old('permissions', [])) === count($permissions) ? 'checked' : '' }}>
                        <label for="select-all" class="form-check-label">Select All Permissions</label>
                    </div>

                    {{-- Permissions List --}}
                    <div class="row">
                        @foreach ($permissions as $permission)
                            <div class="col-md-3 mb-2">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="permissions[]"
                                        value="{{ $permission->name }}" id="permission-{{ $permission->id }}"
                                        data-parent-id="{{ $permission->parent_id }}"
                                        {{ in_array($permission->name, old('permissions', [])) ? 'checked' : '' }}
                                        onclick="{{ $permission->is_visible ? 'toggleChild(this, ' . $permission->parent_id . ')' : 'toggleParent(this)' }}">
                                    <label for="permission-{{ $permission->id }}" class="form-check-label">
                                        {{ $permission->label }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Action Buttons --}}
                    <div class="mt-4 gap-2 d-flex justify-content-end">
                        <button class="btn btn-primary text-decoration-none"> <a href="{{ route('roles.index') }}" class="text-decoration-none text-light">Cancel</a> </button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('bottom-scripts')
    <script>
        function toggleSelectAll(checkbox) {
            const isChecked = checkbox.checked;
            document.querySelectorAll("input[name='permissions[]']").forEach(input => {
                input.checked = isChecked;
            });
        }

        function toggleParent(checkbox) {
            const isChecked = checkbox.checked;
            const parentId = checkbox.value;
            console.log(parentId);
            document.querySelectorAll(`input[data-parent-id='${parentId}']`).forEach(child => {
                child.checked = isChecked;
            });
        }

        function toggleChild(checkbox, parentId) {
            const parentCheckbox = document.querySelector(`input[value='${parentId}']`);
            const siblings = document.querySelectorAll(`input[data-parent-id='${parentId}']`);
            const allChecked = Array.from(siblings).every(sibling => sibling.checked);

            if (parentCheckbox) {
                parentCheckbox.checked = allChecked;
            }
        }
    </script>
@endsection
