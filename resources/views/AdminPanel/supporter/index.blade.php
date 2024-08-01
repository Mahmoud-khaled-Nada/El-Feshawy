@extends('AdminPanel.app')

@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <x-toolbar title="Chat" />
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-xxl">
                <div class="d-flex flex-column flex-lg-row">
                    <!--begin::Sidebar-->
                    <x-chat.sidebar :conversations="$conversations" />  {{-- get all $conversations --}}
                    <!--end::Sidebar-->
                    <!--begin::Content-->
                    <x-chat.content/>
                    <!--end::Content-->
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const csrf_token = "{{ csrf_token() }}";
        const authenticatedUserId = {{ auth()->id() }};
    </script>
    <script src="{{ asset('assets/js/apis/chat.js') }}"></script>
@endpush