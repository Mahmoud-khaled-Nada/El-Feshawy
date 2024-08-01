@extends('AdminPanel.app')
@section('content')
    <x-toolbar title="{{ __('lang.admins') }}" route="admins.create" />
    <x-partials-errors />
    <div class="card mb-5 mb-lg-10">
        <div class="card-header">
            <div class="card-title">
                <h3>{{ __('lang.admins') }}</h3>
            </div>
        </div>
        <div class="card-body p-0 m-2">
            <div class="table-responsive" id="kt_datatable">
                @include('AdminPanel.admins.table')
            </div>
        </div>
    </div>
@endsection
