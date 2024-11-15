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
                            <input type="checkbox" id="select-all" class="form-check-input"
                                onclick="toggleSelectAll(this)">
                            <label for="select-all" class="form-check-label fw-bold">Select All Permissions</label>
                        </div>

                        {{-- Permissions --}}
                        <div>
                            @foreach ($permissions as $permission)
                                @if (!$permission->is_visible)
                                    {{-- Parent (Top-Level Permission) --}}
                                    <div class="my-3 form-check form-check-flat form-check-primary">
                                        <input type="checkbox"
                                            class="form-check-input me-3 parent-checkbox shadow-sm outline-none"
                                            id="permission-{{ $permission->id }}" name="permissions[]"
                                            value="{{ $permission->name }}" onclick="toggleParent(this)"
                                            {{ in_array($permission->name, old('permissions', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label fw-bold text-dark fs-20"
                                            for="permission-{{ $permission->id }}">
                                            {{ $permission->label }}
                                        </label>
                                    </div>
                                @else
                                    {{-- Child Permission --}}
                                    <div class="col-md-3 mb-3 d-inline-block">
                                        <div class="form-check">
                                            <input type="checkbox"
                                                class="form-check-input me-2 child-checkbox shadow-sm outline-none"
                                                id="permission-{{ $permission->id }}" name="permissions[]"
                                                value="{{ $permission->name }}"
                                                data-parent-id="{{ $permission->parent_id }}"
                                                onclick="toggleChild(this, {{ $permission->parent_id }})"
                                                {{ in_array($permission->name, old('permissions', [])) ? 'checked' : '' }}>
                                            <label for="permission-{{ $permission->id }}"
                                                class="form-check-label fs-5 text-dark fw-semibold">
                                                {{ $permission->label }}
                                            </label>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
