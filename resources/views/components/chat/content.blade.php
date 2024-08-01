<div class="flex-lg-row-fluid ms-lg-7 ms-xl-10">
    <div class="card" id="kt_chat_messenger">
        <!--begin::Card header-->
        <div class="card-header" id="kt_chat_messenger_header">
            <div class="card-title">
                <div class="d-flex justify-content-center flex-column me-3">
                    <a class="fs-4 fw-bold text-gray-900 text-hover-primary me-1 mb-2 lh-1" id="chat-title"></a>
                    {{-- <div class="mb-0 lh-1">
                        <span class="badge badge-success badge-circle w-10px h-10px me-1"></span>
                        <span class="fs-7 fw-semibold text-muted">Active</span>
                    </div> --}}
                </div>
            </div>
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Menu-->
                {{-- <div class="me-n3">
                    <button class="btn btn-sm btn-icon btn-active-light-primary" data-kt-menu-trigger="click"
                        data-kt-menu-placement="bottom-end">
                        <i class="ki-duotone ki-dots-square fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                            <span class="path4"></span>
                        </i>
                    </button>
                    <!--begin::Menu 3-->

                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-3"
                        data-kt-menu="true">
                        <!--begin::Heading-->
                        <div class="menu-item px-3">
                            <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">Contacts
                            </div>
                        </div>
                        <!--end::Heading-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link px-3" data-bs-toggle="modal"
                                data-bs-target="#kt_modal_users_search">Add Contact</a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link flex-stack px-3" data-bs-toggle="modal"
                                data-bs-target="#kt_modal_invite_friends">Invite Contacts
                                <span class="ms-2" data-bs-toggle="tooltip"
                                    aria-label="Specify a contact email to send an invitation"
                                    data-bs-original-title="Specify a contact email to send an invitation"
                                    data-kt-initialized="1">
                                    <i class="ki-duotone ki-information fs-7">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i>
                                </span></a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-start">
                            <a href="#" class="menu-link px-3">
                                <span class="menu-title">Groups</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <!--begin::Menu sub-->
                            <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3" data-bs-toggle="tooltip"
                                        data-bs-original-title="Coming soon" data-kt-initialized="1">Create Group</a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3" data-bs-toggle="tooltip"
                                        data-bs-original-title="Coming soon" data-kt-initialized="1">Invite Members</a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3" data-bs-toggle="tooltip"
                                        data-bs-original-title="Coming soon" data-kt-initialized="1">Settings</a>
                                </div>
                                <!--end::Menu item-->
                            </div>
                            <!--end::Menu sub-->
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-3 my-1">
                            <a href="#" class="menu-link px-3" data-bs-toggle="tooltip"
                                data-bs-original-title="Coming soon" data-kt-initialized="1">Settings</a>
                        </div>
                        <!--end::Menu item-->
                    </div>

                    <!--end::Menu 3-->
                </div> --}}
                <!--end::Menu-->
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body" id="kt_chat_messenger_body">
            <!--begin::Messages-->
            <div class="scroll-y me-n5 pe-5 h-300px h-lg-auto" id="chat-body" data-kt-element="messages" data-kt-scroll="true"
                data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                data-kt-scroll-dependencies="#kt_header, #kt_app_header, #kt_app_toolbar, #kt_toolbar, #kt_footer, #kt_app_footer, #kt_chat_messenger_header, #kt_chat_messenger_footer"
                data-kt-scroll-wrappers="#kt_content, #kt_app_content, #kt_chat_messenger_body"
                data-kt-scroll-offset="5px" style="max-height: 103px;">
                <div id="chat-messages">
                </div>
            </div>
        </div>
        <!--end::Card body-->
        <!--begin::Card footer-->
        <div class="card-footer pt-4" id="kt_chat_messenger_footer">
            <input type="hidden" id="current_conversation_id">
            <textarea class="form-control form-control-flush mb-3" rows="1" data-kt-element="input"
                placeholder="Type a message" id="message_textarea"></textarea>
            <div class="d-flex flex-stack">
                <div class="d-flex align-items-center me-2">
                    {{-- <button class="btn btn-sm btn-icon btn-active-light-primary me-1" type="button"
                        data-bs-toggle="tooltip" aria-label="Coming soon"
                        data-bs-original-title="Coming soon" data-kt-initialized="1">
                        <i class="ki-duotone ki-paper-clip fs-3"></i>
                    </button>
                    <button class="btn btn-sm btn-icon btn-active-light-primary me-1" type="button"
                        data-bs-toggle="tooltip" aria-label="Coming soon"
                        data-bs-original-title="Coming soon" data-kt-initialized="1">
                        <i class="ki-duotone ki-exit-up fs-3">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </button> --}}
                </div>
                <button class="btn btn-primary" type="button" data-kt-element="send" id="message_sent_btn" disabled>Send</button>
            </div>
        </div>
        <!--end::Card footer-->
    </div>
</div>
