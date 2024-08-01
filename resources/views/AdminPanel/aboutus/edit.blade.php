@extends('AdminPanel.app')
@section('content')
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    {{ __('lang.aboutus') }}</h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">{{ __('lang.home') }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">{{ __('lang.dashboard') }}</li>
                </ul>
            </div>

        </div>

    </div>
    @include('AdminPanel.partials.errors')
    <div class="card mb-5 mb-xl-10">
        <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
            data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
            <div class="card-title m-0">
                <h3 class="fw-bold m-0">{{ __('lang.edit') }}</h3>
            </div>
        </div>

        <div id="kt_account_settings_profile_details" class="collapse show">
            <form id="kt_account_profile_details_form" class="form fv-plugins-bootstrap5 fv-plugins-framework"
            novalidate="novalidate" enctype="multipart/form-data" 
            action="{{ route('aboutus.update', $aboutus->id) }}" method="POST">
                @include('AdminPanel.aboutus.fields')
        </div>
        <div class="card-footer d-flex justify-content-end py-6 px-9">
            <a type="button" class="btn btn-light btn-active-light-primary me-2"
                href='{{ route('aboutus.index') }}'>{{ __('lang.back') }}</a>
            <button type="submit" class="btn btn-primary"
                id="kt_account_profile_details_submit">{{ __('lang.save') }}</button>
        </div>
        </form>
    </div>
@endsection
