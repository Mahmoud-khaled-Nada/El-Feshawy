@props(['conversations'])

<div class="flex-column flex-lg-row-auto w-100 w-lg-300px w-xl-400px mb-10 mb-lg-0">
    <div class="card card-flush">
        {{-- search --}}
        <div class="card-header pt-7" id="kt_chat_contacts_header">
            <form class="w-100 position-relative" autocomplete="off">
                <i class="ki-duotone ki-magnifier fs-3 text-gray-500 position-absolute top-50 ms-5 translate-middle-y">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
                <input type="text" class="form-control form-control-solid px-13" name="search" value=""
                    placeholder="Search by username or email...">
            </form>
        </div>
        <div class="card-body pt-5" id="kt_chat_contacts_body">
            <div class="scroll-y me-n5 pe-5 h-200px h-lg-auto" data-kt-scroll="true"
                data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                data-kt-scroll-dependencies="#kt_header, #kt_app_header, #kt_toolbar, #kt_app_toolbar, #kt_footer, #kt_app_footer, #kt_chat_contacts_header"
                data-kt-scroll-wrappers="#kt_content, #kt_app_content, #kt_chat_contacts_body"
                data-kt-scroll-offset="5px" style="max-height: 249px;">
                @foreach ($conversations as $item)
                    <!--begin::User-->
                    <div class="d-flex flex-stack py-4">
                        <div class="d-flex align-items-center">
                            <div class="symbol symbol-45px symbol-circle">
                                @if ($item->employee->image)
                                    <img alt="{{ $item->employee->id }}" src="{{ $item->employee->image }}">
                                @else
                                    <span
                                        class="symbol-label bg-light-danger text-danger fs-6 fw-bolder">{{ $item->employee->name }}</span>
                                @endif
                            </div>
                            <div class="ms-5">
                                <a href="#"
                                    class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2 get-conversation"
                                    data-conversation-id="{{ $item->id }}">
                                    {{ $item->employee->name }}
                                </a>
                                <div class="fw-semibold text-muted">
                                    {{ $item->last_message }}
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-column align-items-end ms-2">
                            <span class="text-muted fs-7 mb-1">
                                {{ Carbon\Carbon::parse($item->last_message_send_at)->diffForHumans() }}
                            </span>
                        </div>
                    </div>
                    <!--end::User-->
                    <div class="separator separator-dashed d-none"></div>
                @endforeach
            </div>
        </div>
    </div>
</div>



