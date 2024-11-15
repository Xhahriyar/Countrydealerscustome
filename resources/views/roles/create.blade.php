@extends('admin.app')

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                Role / Create
            </h3>
        </div>
        <div class="card">
            <div class="card-body">
                <form class="card-body" method="POST" action="{{ route('roles.store') }}">
                    @csrf
                    @include('roles.fields')
                    {{-- Submit & Cancel --}}
                    <div class="mt-4 d-flex justify-content-end gap-2">
                        <button class="btn btn-warning text-decoration-none"> <a href="{{ route('roles.index') }}"
                                class="text-decoration-none underline-none text-light">Cancel</a> </button> <button
                            type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
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
