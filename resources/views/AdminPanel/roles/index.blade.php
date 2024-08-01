@extends('AdminPanel.app')
@section('content')
    <x-toolbar title="{{ __('lang.role') }}" route="role.create" />
    <x-partials-errors />
    <div class="card mb-5 mb-lg-10">
        <div class="card-header">
            <div class="card-title">
                <h3>{{ __('lang.role') }}</h3>
            </div>
        </div>
        <div class="card-body p-0 m-2">
            <div class="table-responsive" id="kt_datatable">
                @include('AdminPanel.roles.table')
            </div>
        </div>
    </div>
@endsection
