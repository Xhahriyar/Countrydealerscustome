@section('title', 'Create Role')

@section('content')
    {{-- @include('components.breadcrumb', ['pageName' => 'Roles / Create']) --}}
    <div class="grid grid-cols-1 gap-9">
        <div class="flex flex-col gap-9">
            <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                <div class="border-b border-stroke py-4 px-6.5 dark:border-strokedark">
                    <h3 class="font-medium text-black dark:text-white">
                        Roles Form
                    </h3>
                </div>

                <form method="POST" action="{{ route('roles.store') }}">
                    @csrf

                    <div class="p-6.5">
                        {{-- Name Field --}}
                        <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                            <div class="w-full xl:w-1/2">
                                <label class="mb-2.5 block text-black dark:text-white">Name</label>
                                <input id="name" name="name" type="text" value="{{ old('name') }}"
                                    placeholder="Enter role name"
                                    class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-white dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" />
                                {{-- @error('name')
                                    @include('components.input-error', ['message' => $message])
                                @enderror --}}
                            </div>
                        </div>

                        {{-- Select All Checkbox --}}
                        <div class="mb-4.5">
                            <input type="checkbox" id="select-all" onclick="toggleSelectAll(this)"
                                {{ count($permissions) > 0 && count(old('permissions', [])) === count($permissions) ? 'checked' : '' }} />
                            <label class="ml-2 text-black dark:text-white" for="select-all">Select All Permissions</label>
                        </div>

                        {{-- Permissions List --}}
                        <div class="grid grid-cols-4">
                            @foreach ($permissions as $permission)
                                <div
                                    class="{{ !$permission->is_visible ? 'mb-7 border-b-2 border-primary pb-4 flex col-span-4 items-center w-fit' : 'inline ml-5 mb-10' }}">
                                    <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                        class="w-5 h-5 rounded border" id="permission-{{ $permission->id }}"
                                        {{ in_array($permission->name, old('permissions', [])) ? 'checked' : '' }}
                                        onclick="{{ !$permission->is_visible ? 'toggleParent(this)' : 'toggleChild(this, ' . $permission->parent_id . ')' }}" />
                                    <label class="ml-2 text-md font-semibold"
                                        for="permission-{{ $permission->id }}">{{ $permission->label }}</label>
                                </div>
                            @endforeach
                        </div>

                        {{-- Action Buttons --}}
                        <div class="flex items-center mt-5">
                            <a href="{{ route('roles.index') }}"
                                class="mr-2 flex h-11 items-center justify-center rounded bg-slate-500 px-6 text-white font-medium hover:bg-opacity-90">
                                Cancel
                            </a>
                            <button type="submit"
                                class="flex h-11 items-center justify-center rounded bg-primary px-6 text-white transition hover:bg-opacity-90">
                                Save
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
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
            document.querySelectorAll(`input[name='permissions[]'][data-parent-id='${parentId}']`).forEach(child => {
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
@endpush
