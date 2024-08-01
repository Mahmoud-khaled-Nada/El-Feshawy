@isset($contact)
    @method('PUT')
    <input type="hidden" value="{{ $contact->id }}" name="id">
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

                <div class="row mb-3">
                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">{{ __('lang.address') }}</label>
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-lg-12 fv-row fv-plugins-icon-container">
                                <input type='text' name="{{ $name }}[address]"
                                    class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 "
                                    placeholder="{{ __('lang.address') }}"
                                    value="{{ old($name . '.address', isset($contact) ? $contact->getTranslation($name)->address : '') }}">
                                <div
                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">{{ __('lang.message') }}</label>
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-lg-12 fv-row fv-plugins-icon-container">
                                <textarea name="{{ $name }}[message]"
                                    class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 summernote">{{ old($name . '.message', isset($contact) ? $contact->getTranslation($name)->message : '') }}
                                </textarea>
                                <div
                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>

    <div class="row mb-3">
        <label class="col-lg-4 col-form-label required fw-semibold fs-6">
            {{ __('lang.email') }}
        </label>
        <div class="col-lg-8">
            <div class="row">
                <div class="col-lg-12 fv-row fv-plugins-icon-container">
                    <input type='email' name="email"
                        class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 "
                        placeholder=" {{ __('lang.email') }}" value="{{ old('email', $contact->email ?? '') }}">
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <label class="col-lg-4 col-form-label required fw-semibold fs-6">
            {{ __('lang.phone') }}
        </label>
        <div class="col-lg-8">
            <div class="row">
                <div class="col-lg-12 fv-row fv-plugins-icon-container">
                    <input type='number' name="phone"
                        class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 "
                        placeholder=" {{ __('lang.phone') }}" value="{{ old('phone', $contact->phone ?? '') }}">
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <label class="col-lg-4 col-form-label required fw-semibold fs-6">
            {{ __('lang.facebook') }}
        </label>
        <div class="col-lg-8">
            <div class="row">
                <div class="col-lg-12 fv-row fv-plugins-icon-container">
                    <input type='text' name="facebook"
                        class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 "
                        placeholder=" {{ __('lang.facebook') }}" value="{{ old('facebook', $contact->facebook ?? '') }}">
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <label class="col-lg-4 col-form-label required fw-semibold fs-6">
            {{ __('lang.linkedin') }}
        </label>
        <div class="col-lg-8">
            <div class="row">
                <div class="col-lg-12 fv-row fv-plugins-icon-container">
                    <input type='text' name="linkedin"
                        class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 "
                        placeholder=" {{ __('lang.linkedin') }}" value="{{ old('linkedin', $contact->linkedin ?? '') }}">
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <label class="col-lg-4 col-form-label required fw-semibold fs-6">
            {{ __('lang.instagram') }}
        </label>
        <div class="col-lg-8">
            <div class="row">
                <div class="col-lg-12 fv-row fv-plugins-icon-container">
                    <input type='text' name="instagram"
                        class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 "
                        placeholder=" {{ __('lang.instagram') }}" value="{{ old('instagram', $contact->instagram ?? '') }}">
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <label class="col-lg-4 col-form-label required fw-semibold fs-6">
            {{ __('lang.X') }}
        </label>
        <div class="col-lg-8">
            <div class="row">
                <div class="col-lg-12 fv-row fv-plugins-icon-container">
                    <input type='text' name="X"
                        class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 "
                        placeholder=" {{ __('lang.X') }}" value="{{ old('X', $contact->X ?? '') }}">
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <label class="col-lg-4 col-form-label required fw-semibold fs-6">
            {{ __('lang.youtube') }}
        </label>
        <div class="col-lg-8">
            <div class="row">
                <div class="col-lg-12 fv-row fv-plugins-icon-container">
                    <input type='text' name="youtube"
                        class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 "
                        placeholder=" {{ __('lang.youtube') }}" value="{{ old('youtube', $contact->youtube ?? '') }}">
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <label class="col-lg-4 col-form-label required fw-semibold fs-6">
            {{ __('lang.location') }}
        </label>
        <div class="col-lg-8">
            <div class="row">
                <div class="col-lg-12 fv-row fv-plugins-icon-container">
                    <input type='text' name="location"
                        class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 "
                        placeholder=" {{ __('lang.location') }}" value="{{ old('location', $contact->location ?? '') }}">
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
