@isset($employee)
    @method('PUT')
    <input type="hidden" value="{{ $employee->id }}" name="id">
@endisset
@csrf
<div class="card-body border-top p-9">

    <!--begin::Input group-->
    <div class="row mb-6">
        <!--begin::Label-->
        <label class="col-lg-4 col-form-label required fw-semibold fs-6">{{ __('lang.name') }}</label>
        <!--end::Label-->

        <!--begin::Col-->
        <div class="col-lg-8">
            <!--begin::Row-->
            <div class="row">
                <!--begin::Col-->
                <div class="col-lg-12 fv-row fv-plugins-icon-container">
                    <input type="text" name="name"
                        class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                        placeholder="{{ __('lang.name') }}" value="{{ old('name', $employee->name ?? '') }}">
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    </div>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="row mb-6">
        <!--begin::Label-->
        <label class="col-lg-4 col-form-label required fw-semibold fs-6">{{ __('lang.email') }}</label>
        <!--end::Label-->

        <!--begin::Col-->
        <div class="col-lg-8">
            <!--begin::Row-->
            <div class="row">
                <!--begin::Col-->
                <div class="col-lg-12 fv-row fv-plugins-icon-container">
                    <input type="email" name="email"
                        class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                        placeholder="{{ __('lang.email') }}" value="{{ old('email', $employee->email ?? '') }}">
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    </div>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="row mb-6">
        <!--begin::Label-->
        <label class="col-lg-4 col-form-label required fw-semibold fs-6">{{ __('lang.phone') }}</label>
        <!--end::Label-->

        <!--begin::Col-->
        <div class="col-lg-8">
            <!--begin::Row-->
            <div class="row">
                <!--begin::Col-->
                <div class="col-lg-12 fv-row fv-plugins-icon-container">

                    <!--begin::Wrapper-->
                    <div class="mb-1">
                        <!--begin::Input wrapper-->
                        <div class="position-relative mb-3">
                            <input class="form-control bg-transparent" type="text"
                                placeholder="{{ __('lang.phone') }}" name="phone" autocomplete="off"
                                {{ !isset($employee) ? 'required' : '' }}
                                value="{{ old('phone', $employee->phone ?? '') }}">
                        </div>
                        <!--end::Input wrapper-->
                    </div>
                    <!--end::Wrapper-->


                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    </div>
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    </div>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="row mb-6">
        <!--begin::Label-->
        <label class="col-lg-4 col-form-label required fw-semibold fs-6">{{ __('lang.password') }}</label>
        <!--end::Label-->

        <!--begin::Col-->
        <div class="col-lg-8">
            <!--begin::Row-->
            <div class="row">
                <!--begin::Col-->
                <div class="col-lg-12 fv-row fv-plugins-icon-container">

                    <!--begin::Wrapper-->
                    <div class="mb-1">
                        <!--begin::Input wrapper-->
                        <div class="position-relative mb-3">
                            <input class="form-control bg-transparent" type="password"
                                placeholder="{{ __('lang.password') }}" name="password" autocomplete="off"
                                {{ !isset($employee) ? 'required' : '' }}>
                        </div>
                        <!--end::Input wrapper-->
                    </div>
                    <!--end::Wrapper-->


                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    </div>
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    </div>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="row mb-6">
        <!--begin::Label-->
        <label class="col-lg-4 col-form-label required fw-semibold fs-6">{{ __('lang.rpassword') }}</label>
        <!--end::Label-->

        <!--begin::Col-->
        <div class="col-lg-8">
            <!--begin::Row-->
            <div class="row">
                <!--begin::Col-->
                <div class="col-lg-12 fv-row fv-plugins-icon-container">
                    <input type="password" name="confirm-password"
                        class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                        placeholder="{{ __('lang.rpassword') }}">
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    </div>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->

    <!--begin::Input group-->
    <div class="row mb-6">
        <!--begin::Label-->
        <label class="col-lg-4 col-form-label required fw-semibold fs-6">{{ __('lang.status') }}</label>
        <!--end::Label-->

        <!--begin::Col-->
        <div class="col-lg-8">
            <!--begin::Row-->
            <div class="row">
                <!--begin::Col-->
                <div class="col-lg-12 fv-row fv-plugins-icon-container">
                    <select id="js-example-basic" class=" form-control select2 h-50px" name="status">

                        <option value="1"
                            {{ (isset($employee) && $employee->status == 1) || !isset($employee) ? 'selected' : '' }}>
                            {{ __('lang.active') }}
                        </option>
                        <option value="0" {{ isset($employee) && $employee->status == 0 ? 'selected' : '' }}>
                            {{ __('lang.inactive') }}
                        </option>
                    </select>
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    </div>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->

    <!--begin::Input group-->
    <div class="fv-row mb-10 fv-plugins-icon-container">
        <!--begin::Label-->
        <label class="d-block fw-semibold fs-6 mb-5">
            <span class="required">{{ __('lang.photo') }}</span>
        </label>
        <!--end::Label-->
        <!--begin::Image input placeholder-->
        <style>
            .image-input-placeholder {
                background-image: url({{ asset('assets/media/svg/files/blank-image.svg') }})
            }

            [data-bs-theme="dark"] .image-input-placeholder {
                background-image: url({{ asset('assets/media/svg/files/blank-image-dark.svg') }});
            }
        </style>
        <!--end::Image input placeholder-->
        <!--begin::Image input-->
        <div class="image-input image-input-empty image-input-outline image-input-placeholder"
            data-kt-image-input="true">
            <!--begin::Preview existing avatar-->
            <div class="image-input-wrapper w-125px h-125px"
                @isset($employee->image)
                    style='background-image:url({{ $employee->image }})'@endisset>
            </div>
            <!--end::Preview existing avatar-->
            <!--begin::Label-->
            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                data-kt-image-input-action="change" data-bs-toggle="tooltip" aria-label="Change avatar"
                data-bs-original-title="Change avatar" data-kt-initialized="1">
                <i class="ki-duotone ki-pencil fs-7">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
                <!--begin::Inputs-->
                <input type="file" name="image" accept=".png, .jpg, .jpeg">
                <input type="hidden" name="avatar_remove">
                <!--end::Inputs-->
            </label>
            <!--end::Label-->
            <!--begin::Cancel-->
            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                data-kt-image-input-action="cancel" data-bs-toggle="tooltip" aria-label="Cancel avatar"
                data-bs-original-title="Cancel avatar" data-kt-initialized="1">
                <i class="ki-duotone ki-cross fs-2">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
            </span>
            <!--end::Cancel-->
            <!--begin::Remove-->
            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                data-kt-image-input-action="remove" data-bs-toggle="tooltip" aria-label="Remove avatar"
                data-bs-original-title="Remove avatar" data-kt-initialized="1">
                <i class="ki-duotone ki-cross fs-2">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
            </span>
            <!--end::Remove-->
        </div>
        <!--end::Image input-->
        <!--begin::Hint-->
        <div class="form-text">{{ __('lang.allowedsettingtypes') }}</div>
        <!--end::Hint-->
        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
    </div>
    <!--end::Input group-->

</div>


<script>
    $(document).ready(function() {
        $('#js-example-basic').select2({
            placeholder: "{{ __('lang.select') }}",
            allowClear: true
        });
    });
</script>
