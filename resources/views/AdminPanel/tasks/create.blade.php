@extends('AdminPanel.app')
@section('content')
    <x-toolbar title="{{ __('lang.tasks') }}" />
    <x-partials-errors />
    <div class="card mb-5 mb-xl-10">
        <!--begin::Card header-->
        <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
            data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
            <!--begin::Card title-->
            <div class="card-title m-0">
                <h3 class="fw-bold m-0">{{ __('lang.create') }}</h3>
            </div>
            <!--end::Card title-->
        </div>
        <!--begin::Card header-->

        <!--begin::Content-->
        <div id="kt_account_settings_profile_details" class="collapse show">
            <!--begin::Form-->
            <form id="kt_account_profile_details_form" class="form fv-plugins-bootstrap5 fv-plugins-framework"
                enctype="multipart/form-data" novalidate="novalidate" action="{{ route('task.store') }}" method="POST">
                <!--begin::Card body-->
                @include('AdminPanel.tasks.fields')
                <!--end::Card body-->
        <!--begin::Actions-->
        <div class="card-footer d-flex justify-content-end py-6 px-9">
            <a type="button" href="{{ route('admins.index') }}"
                class="btn btn-light btn-active-light-primary me-2">{{ __('lang.back') }}</a>
            <button type="submit" class="btn btn-primary"
                id="kt_account_profile_details_submit">{{ __('lang.save') }}</button>
        </div>
        <!--end::Actions-->
        </form>
        </div>
        <!--end::Form-->
    </div>
    <!--end::Content-->
@endsection
