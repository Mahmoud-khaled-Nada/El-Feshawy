@extends('AdminPanel.app')
@section('content')
<x-toolbar-with-rule title="{{ __('lang.tasks') }}" route="task.create" rule="create tasks"/>
  <x-partials-errors />

    <div class="card mb-5 mb-lg-10">
        <!--begin::Card header-->
        <div class="card-header">
            <!--begin::Heading-->
            <div class="card-title">
                <h3>{{ __('lang.tasks') }}</h3>
            </div>
            <!--end::Heading-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body p-0 m-2">
            <!--begin::Table wrapper-->
            <div class="table-responsive" id="kt_datatable">
                @include('AdminPanel.tasks.table')
            </div>
            <!--end::Table wrapper-->
        </div>
        <!--end::Card body-->
    </div>
@endsection
