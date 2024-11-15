@extends('admin.app')

@section('content')
    <div class="m-4">
        <div class="p-4">
            {{-- Heading --}}
            <h4 class="mb-3">Role / Create</h4>

            {{-- Form --}}
            <form method="POST" action="{{ route('roles.store') }}">
                @csrf
                {{-- Name Field --}}
                <div class="mb-3">
                    <label for="role-name" class="form-label">Name <sup class="text-danger">*</sup></label>
                    <input type="text" class="form-control" id="role-name" name="name"
                           value="{{ $data['name'] ?? '' }}" placeholder="Enter role name">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Select All Checkbox --}}
                <div class="form-check mb-3">
                    <input type="checkbox" id="select-all" class="form-check-input" onclick="toggleSelectAll(this)">
                    <label for="select-all" class="form-check-label fw-bold">Select All Permissions</label>
                </div>

                {{-- Permissions --}}
                <div>
                    @foreach ($permissions as $permission)
                        @if (!$permission->is_visible)
                            {{-- Parent (Top-Level Permission) --}}
                            <div class="my-2 fw-bold">
                                <input type="checkbox" class="form-check-input me-2 parent-checkbox"
                                       id="permission-{{ $permission->id }}"
                                       name="permissions[]" value="{{ $permission->name }}"
                                       onclick="toggleParent(this)"
                                       {{ in_array($permission->name, old('permissions', [])) ? 'checked' : '' }}>
                                <label for="permission-{{ $permission->id }}">{{ $permission->label }}</label>
                            </div>
                        @else
                            {{-- Child Permission --}}
                            <div class="col-md-2 mb-2 d-inline-block">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input child-checkbox"
                                           id="permission-{{ $permission->id }}"
                                           name="permissions[]" value="{{ $permission->name }}"
                                           data-parent-id="{{ $permission->parent_id }}"
                                           onclick="toggleChild(this, {{ $permission->parent_id }})"
                                           {{ in_array($permission->name, old('permissions', [])) ? 'checked' : '' }}>
                                    <label for="permission-{{ $permission->id }}" class="form-check-label">
                                        {{ $permission->label }}
                                    </label>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

                {{-- Submit & Cancel --}}
                <div class="mt-4 d-flex justify-content-end gap-2">
                    <button class="btn btn-warning text-decoration-none"> <a href="{{ route('roles.index') }}"
                        class="text-decoration-none underline-none text-light">Cancel</a> </button>                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('bottom-scripts')
    <script>
        // Function to toggle the "Select All" checkbox
        function toggleSelectAll(checkbox) {
            const isChecked = checkbox.checked;
            document.querySelectorAll("input[name='permissions[]']").forEach(input => {
                input.checked = isChecked;
            });

            updateSelectAllState();
        }

        // Function to toggle the state of parent checkboxes
        function toggleParent(checkbox) {
            const isChecked = checkbox.checked;
            const parentId = checkbox.value;

            // Check/uncheck all child checkboxes related to this parent
            document.querySelectorAll(`input[data-parent-id='${parentId}']`).forEach(child => {
                child.checked = isChecked;
            });

            updateSelectAllState();
        }

        // Function to toggle the state of child checkboxes
        function toggleChild(checkbox, parentId) {
            const parentCheckbox = document.querySelector(`input[value='${parentId}']`);
            const siblings = document.querySelectorAll(`input[data-parent-id='${parentId}']`);
            const allChecked = Array.from(siblings).every(sibling => sibling.checked);

            // If all children are checked, check the parent
            if (parentCheckbox) {
                parentCheckbox.checked = allChecked;
            }

            updateSelectAllState();
        }

        // Function to update the "Select All" checkbox state
        function updateSelectAllState() {
            const allCheckboxes = document.querySelectorAll("input[name='permissions[]']");
            const selectAllCheckbox = document.getElementById('select-all');
            const allChecked = Array.from(allCheckboxes).every(checkbox => checkbox.checked);

            selectAllCheckbox.checked = allChecked;
        }
    </script>
@endsection
