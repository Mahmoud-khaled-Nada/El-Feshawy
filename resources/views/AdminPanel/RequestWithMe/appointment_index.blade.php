@extends('AdminPanel.app')
@section('content')
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack m-2">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    {{ __('lang.appointmentReq') }}</h1>
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
    <div class="card mb-5 mb-lg-10">
        <div class="card-header">
            <div class="card-title">
                <h3>{{ __('lang.appointmentReq') }}</h3>
            </div>
        </div>
        <div class="card-body p-0 m-2">
            <div class="table-responsive" id="kt_datatable">
                @include('AdminPanel.RequestWithMe.appointment_table')
            </div>
        </div>
    </div>
@endsection
