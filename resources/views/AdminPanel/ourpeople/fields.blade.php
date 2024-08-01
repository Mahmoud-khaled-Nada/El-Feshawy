@isset($people)
    @method('PUT')
    <input type="hidden" value="{{ $people->id }}" name="id">
@endisset
@csrf
<div class="card-body border-top p-9">
    <ul class="nav nav-light-success nav-pills" id="myTab" role="tablist">

        @foreach (LaravelLocalization::getSupportedLocales() as $name => $value)
            <li class="nav-item" data-bs-toggle="tab">
                <a class="nav-link {{ LaravelLocalization::getCurrentLocale() == $name ? 'active' : '' }}"
                    id="{{ $name }}-tab" data-bs-toggle="tab" href="#{{ $name }}" role="tab"
                    aria-controls="{{ $name }}"
                    aria-selected="{{ LaravelLocalization::getCurrentLocale() == $name ? 'true' : 'false' }}">{{ $value['native'] }}</a>
            </li>
        @endforeach
    </ul>
    <div class="tab-content mt-5" id="myTabContent">
        @foreach (LaravelLocalization::getSupportedLocales() as $name => $value)
            <div class="tab-pane fade {{ LaravelLocalization::getCurrentLocale() == $name ? 'show active' : '' }}"
                id="{{ $name }}" role="tabpanel" aria-labelledby="{{ $name }}-tab">

                <!--begin::Input group-->
                <div class="row mb-3">
                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">{{ __('lang.title') }}</label>
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-lg-12 fv-row fv-plugins-icon-container">
                                <label class="fw-semibold fs-6">
                                    please enter here the job title
                                </label>
                                <input type='text' name="{{ $name }}[title]"
                                    class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 "
                                    placeholder="{{ __('lang.title') }}"
                                    value="{{ old($name . '.title', isset($people) ? $people->getTranslation($name)->title : '') }}">
                                <div
                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row mb-3">
                    <label
                        class="col-lg-4 col-form-label required fw-semibold fs-6">{{ __('lang.description') }}</label>
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-lg-12 fv-row fv-plugins-icon-container">
                                <label class="fw-semibold fs-6">
                                    Enter the employee name first, then the description <br />
                                    <span class="text-danger">DR. ASHRAF AL-FESHAWY , description...</span><br />
                                    <span> After entering the name keep the (,) mark.</span>
                                </label>
                                <textarea name="{{ $name }}[description]"
                                    class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 summernote">{{ old($name . '.description', isset($people) ? $people->getTranslation($name)->description : '') }}
                                </textarea>
                                <div
                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Input group-->
            </div>
        @endforeach

    </div>


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
                @isset($people->image)
                    style='background-image:url({{ $people->image }})'@endisset>
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
