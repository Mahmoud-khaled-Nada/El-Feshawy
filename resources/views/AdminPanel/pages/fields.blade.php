@isset($page)
    @method('PUT')
    <input type="hidden" value="{{ $page->id }}" name="id">
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
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">{{ __('lang.title') }}</label>
                    <!--end::Label-->

                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <!--begin::Row-->
                        <div class="row">
                            <!--begin::Col-->
                            <div class="col-lg-12 fv-row fv-plugins-icon-container">
                                <input type='text' name="{{ $name }}[title]"
                                    class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 "
                                    placeholder="{{ __('lang.title') }}"
                                    value="{{ old($name . '.title', isset($page) ? $page->getTranslation($name)->title : '') }}"
                                    disabled>
                                <div
                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
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
                <div class="row mb-3">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">{{ __('lang.content') }}</label>
                    <!--end::Label-->

                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <!--begin::Row-->
                        <div class="row">
                            <!--begin::Col-->
                            <div class="col-lg-12 fv-row fv-plugins-icon-container">
                                <textarea name="{{ $name }}[content]"
                                    class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 summernote">{{ old($name . '.content', isset($page) ? $page->getTranslation($name)->content : '') }}
                                </textarea>
                                <div
                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                </div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->


            </div>
        @endforeach

    </div>

</div>
