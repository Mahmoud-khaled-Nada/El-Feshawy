@extends('AdminPanel.app')
@section('content')
    <x-toolbar-with-rule title="{{ __('lang.contactus') }}" route="contact.create" rule="create contact" />
    <x-partials-errors />
    <div class="card mb-5 mb-lg-10">
        <div class="card-header">
            <div class="card-title">
                <h3>{{ __('lang.contactus') }}</h3>
            </div>
        </div>
        <div class="card-body p-0 m-2">
            <div class="table-responsive" id="kt_datatable">
                @include('AdminPanel.contact.table')
            </div>
        </div>
    </div>
@endsection
