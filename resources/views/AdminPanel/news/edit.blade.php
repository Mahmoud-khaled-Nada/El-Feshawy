@extends('AdminPanel.app')
@section('content')
    <x-toolbar title="{{ __('lang.news') }}" />
    <x-partials-errors />
    <div class="card mb-5 mb-xl-10">
        <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
            data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
            <div class="card-title m-0">
                <h3 class="fw-bold m-0">{{ __('lang.edit') }}</h3>
            </div>
        </div>
        <div id="kt_account_settings_profile_details" class="collapse show">
            <form id="kt_account_profile_details_form" class="form fv-plugins-bootstrap5 fv-plugins-framework"
                novalidate="novalidate" enctype="multipart/form-data" action="{{ route('news.update', $news->id) }}"
                method="POST">

                @include('AdminPanel.news.fields')
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <a type="button" class="btn btn-light btn-active-light-primary me-2"
                        href='{{ route('news.index') }}'>{{ __('lang.back') }}</a>
                    <button type="submit" class="btn btn-primary"
                        id="kt_account_profile_details_submit">{{ __('lang.save') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
