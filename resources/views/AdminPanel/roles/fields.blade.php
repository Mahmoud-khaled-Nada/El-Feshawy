@isset($role)
    @method('PUT')
@endisset
@csrf
<div class="card-body border-top p-9">
    @isset($role)
        <input type="hidden" value="{{ $role->id }}" name='id'>
    @endisset
    <div class="row mb-6 border border-secondary p-5">
        <label class="col-lg-4 col-form-label required fw-semibold fs-6">{{ __('lang.name') }}</label>
        <div class="col-lg-8">
            <div class="row">
                <div class="col-lg-12 fv-row fv-plugins-icon-container">
                    <input type="text" name="name"
                        class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                        placeholder="{{ __('lang.permession') }}"
                        value="{{ old('name', $role->name ?? '') }}">
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-6">
        <label class="row col-form-label required fw-semibold fs-4 border-bottom">{{ __('lang.permession') }}</label>
        <div class="col-lg-12">
            <div class="row w-100 mb-3">
                <div class="col-2">
                    <label class="row col-form-label fw-semibold fs-6">{{ __('lang.selectall') }}</label>
                </div>
                <div class="col-10">
                    <input type="checkbox" id="selectAll">
                    <label for="selectAll" class="col-form-label fw-semibold fs-6">{{ __('lang.selectall') }}</label>
                </div>
            </div>
            <div class="row w-100">
                @php
                    $c = 1;
                @endphp
                @foreach ($pages as $page)
                    <div class="col-2">
                        <label class="row col-form-label fw-semibold fs-6">{{ __('lang.' . $page) }}</label>
                    </div>
                    <div class="col-10">
                        @foreach ($permessions as $permission)
                            <span class="col-3">
                                <input type="checkbox" class="permission-checkbox" name="permessions[]"
                                    value="{{ $c++ }}"
                                    {{ isset($role) && in_array($c - 1, $rolePermissions) ? 'checked' : '' }}>
                                <label class="col-form-label fw-semibold fs-6">{{ __('lang.' . $permission) }}</label>
                            </span>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>


<script>
    document.getElementById('selectAll').addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('.permission-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });
</script>