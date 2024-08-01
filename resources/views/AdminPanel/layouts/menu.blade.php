    <!--begin::Menu wrapper-->
    <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper overflow-scroll-x h-100">
        <!--begin::Scroll wrapper-->
        <div id="kt_app_sidebar_menu_scroll" class="scroll-y my-5 mx-3" data-kt-scroll="true" data-kt-scroll-activate="true"
            data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
            data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
            <!--begin::Menu-->
            <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6" id="#kt_app_sidebar_menu"
                data-kt-menu="true" data-kt-menu-expand="false">
                <div class="menu-item">
                    <!--begin:Menu link-->
                    <a class="menu-link {{ Route::currentRouteName() == 'dashboard' ? 'active' : '' }}"
                        href="{{ route('dashboard') }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">{{ __('lang.dashboard') }}</span>
                    </a>
                    <!--end:Menu link-->
                </div>

                <x-menus.main-menu title="Administrator" icon="bi bi-people-fill">
                    @if (auth()->user()->hasRole('superadmin'))
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link {{ in_array(Route::currentRouteName(), ['admins.index', 'admins.create', 'admins.edit']) ? 'active' : '' }}"
                                href="{{ route('admins.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{ __('lang.admin') }}</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                    @endif
                    @if (auth()->user()->hasRole('superadmin'))
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link {{ in_array(Route::currentRouteName(), ['role.index', 'role.create', 'role.edit']) ? 'active' : '' }}"
                                href="{{ route('role.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{ __('lang.role') }}</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                    @endif
                    @if (auth()->user()->can('view employees'))
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link {{ in_array(Route::currentRouteName(), ['employees.index', 'employees.create', 'employees.edit', 'employees.import']) ? 'active' : '' }}"
                                href="{{ route('employees.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{ __('lang.employees') }}</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                    @endif
                    @if (auth()->user()->can('view customers'))
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link {{ in_array(Route::currentRouteName(), ['customers.index', 'customers.create', 'customers.edit']) ? 'active' : '' }}"
                                href="{{ route('customers.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">
                                    {{ __('lang.customers') }}
                                </span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                    @endif
                </x-menus.main-menu>
                <x-menus.main-menu title="settings" icon="bi bi-gear-fill">
                    @if (auth()->user()->can('view pages'))
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link {{ in_array(Route::currentRouteName(), ['pages.index', 'pages.edit']) ? 'active' : '' }}"
                                href="{{ route('pages.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{ __('lang.pages') }}</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                    @endif
                    @if (auth()->user()->can('view news'))
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link {{ in_array(Route::currentRouteName(), ['news.index', 'news.create', 'news.edit']) ? 'active' : '' }}"
                                href="{{ route('news.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{ __('lang.news') }}</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                    @endif
                    @if (auth()->user()->can('view aboutus'))
                        <div class="menu-item">
                            <a class="menu-link {{ in_array(Route::currentRouteName(), ['aboutus.index', 'aboutus.create', 'aboutus.edit']) ? 'active' : '' }}"
                                href="{{ route('aboutus.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{ __('lang.aboutus') }}</span>
                            </a>
                        </div>
                    @endif
                    @if (auth()->user()->can('view people'))
                        <div class="menu-item">
                            <a class="menu-link {{ in_array(Route::currentRouteName(), ['people.index', 'people.create', 'people.edit']) ? 'active' : '' }}"
                                href="{{ route('people.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{ __('lang.ourpeople') }}</span>
                            </a>
                        </div>
                    @endif
                    @if (auth()->user()->can('view services'))
                        <div class="menu-item">
                            <a class="menu-link {{ in_array(Route::currentRouteName(), ['services.index', 'services.create', 'services.edit']) ? 'active' : '' }}"
                                href="{{ route('services.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{ __('lang.services') }}</span>
                            </a>
                        </div>
                    @endif
                    @if (auth()->user()->can('view contact'))
                        <div class="menu-item">
                            <a class="menu-link {{ in_array(Route::currentRouteName(), ['contact.index', 'contact.create', 'contact.edit']) ? 'active' : '' }}"
                                href="{{ route('contact.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{ __('lang.contactus') }}</span>
                            </a>
                        </div>
                    @endif
                </x-menus.main-menu>

                @if (auth()->user()->can('view events'))
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ in_array(Route::currentRouteName(), ['events.index', 'events.create', 'events.edit']) ? 'active' : '' }}"
                            href="{{ route('events.index') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">{{ __('lang.events') }}</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                @endif
                @if (auth()->user()->can('view tasks'))
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ in_array(Route::currentRouteName(), ['task.index', 'task.create', 'task.edit']) ? 'active' : '' }}"
                            href="{{ route('task.index') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">{{ __('lang.tasks') }}</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                @endif
                @if (auth()->user()->can('view meeting'))
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ in_array(Route::currentRouteName(), ['meetings.index', 'meetings.create', 'meetings.edit']) ? 'active' : '' }}"
                            href="{{ route('meetings.index') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title"> {{ __('lang.meetings') }}</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                @endif
                @if (auth()->user()->can('view inquiries'))
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ in_array(Route::currentRouteName(), ['inquiries.index', 'inquirie.create', 'inquirie.edit']) ? 'active' : '' }}"
                            href="{{ route('inquiries.index') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title"> {{ __('lang.inquiries') }}</span>
                            <span class="badge badge-outline badge-success">
                                mobile
                            </span>
                        </a>
                    </div>
                @endif
                <x-menus.main-menu title="Inquiries web" icon="bi bi-file-earmark-text-fill">
                    <div class="menu-item">
                        <a class="menu-link {{ in_array(Route::currentRouteName(), ['appointmentReq.index', 'appointmentReq.create', 'appointmentReq.edit']) ? 'active' : '' }}"
                            href="{{ route('appointmentReq.index') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title"> {{ __('lang.appointmentReq') }}</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link {{ in_array(Route::currentRouteName(), ['contactUsReq.index', 'contactUsReq.create', 'contactUsReq.edit']) ? 'active' : '' }}"
                            href="{{ route('contactUsReq.index') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title"> {{ __('lang.contactUsReq') }}</span>
                        </a>
                    </div>
                </x-menus.main-menu>
                @if (auth()->user()->can('view messages'))
                    <div class="menu-item">
                        <a class="menu-link {{ in_array(Route::currentRouteName(), ['conversations.index', 'conversations.create', 'conversations.edit']) ? 'active' : '' }}"
                            href="{{ route('conversations.index') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title"> {{ __('lang.messages') }}</span>
                            @if (isset($messageNotification) && $messageNotification)
                                <div class="badge badge-circle bg-primary ms-5 text-white">
                                    {{ $messageNotification }}
                                </div>
                            @endif
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
