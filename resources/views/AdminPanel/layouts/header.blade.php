<!--begin::Header-->
<!--begin::Header container-->
<div class="app-container container-fluid d-flex align-items-stretch justify-content-between"
    {{ app()->getLocale() == 'ar' ? 'style' . '=' . 'padding-left:1500px' : '' }} id="kt_app_header_container">
    <!--begin::Sidebar mobile toggle-->
    <div class="d-flex align-items-center d-lg-none ms-n3 me-1 me-md-2" title="Show sidebar menu">
        <div class="btn btn-icon btn-active-color-primary w-35px h-35px" id="kt_app_sidebar_mobile_toggle">
            <i class="ki-duotone ki-abstract-14 fs-2 fs-md-1">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
        </div>
    </div>
    <!--end::Sidebar mobile toggle-->
    <!--begin::Mobile logo-->
    <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
        <a href="{{ route('dashboard') }}" class="d-lg-none border-bottom">
            <img alt="Logo" src="{{ asset('xlogo.jpeg') }}" class="h-75px w-150px" />
        </a>
    </div>
    <!--end::Mobile logo-->
    <!--begin::Header wrapper-->
    <div class="d-flex align-items-stretch justify-content-end flex-lg-grow-1" id="kt_app_header_wrapper">
        <!--begin::Menu wrapper-->
        <div class="app-header-menu app-header-mobile-drawer align-items-stretch" data-kt-drawer="true"
            data-kt-drawer-name="app-header-menu" data-kt-drawer-activate="{default: true, lg: false}"
            data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="end"
            data-kt-drawer-toggle="#kt_app_header_menu_toggle" data-kt-swapper="true"
            data-kt-swapper-mode="{default: 'append', lg: 'prepend'}"
            data-kt-swapper-parent="{default: '#kt_app_body', lg: '#kt_app_header_wrapper'}">
            <!--begin::Menu-->
            <div class="menu menu-rounded menu-column menu-lg-row my-5 my-lg-0 align-items-stretch fw-semibold px-2 px-lg-0"
                id="kt_app_header_menu" data-kt-menu="true">

            </div>
            <!--end::Menu-->
        </div>

        @if (auth()->user()->can('view notifications'))
        <!--begin::Navbar Nada-->
        <div class="app-navbar flex-shrink-0">
            <!--begin::User menu-->
            <div class="app-navbar-item ms-1 ms-md-4" id="kt_header_user_menu_toggle">
                <!--begin::Menu wrapper-->
                <div class="position-relative d-inline-block cursor-pointer symbol symbol-30px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                <img src="{{ asset('notification.webp') }}" class="rounded-3" alt="user" />
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger border border-light text-white">
                    +9
                </span>
            </div>                     
                <!--begin::User account menu-->
                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-300px"
                data-kt-menu="true">
                <!--begin::Menu item-->
                <div class="menu-item px-5">
                    <div class="d-flex py-3 border-bottom">
                        <div class="icon-box md border border-success grd-success-light rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                            <span class="text-success fw-bold">DS</span>
                        </div>
                        <div class="m-0">
                            <h6 class="mb-1 fw-semibold">Douglass Shaw</h6>
                            <p class="mb-1 text-secondary">
                                Membership has been ended.
                            </p>
                            <p class="small m-0 text-muted">Today, 07:30 PM</p>
                        </div>
                    </div>
                </div>
            
                <div class="menu-item px-5">
                    <div class="d-flex py-3 border-bottom">
                        <div class="icon-box md border border-success grd-success-light rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                            <span class="text-success fw-bold">DS</span>
                        </div>
                        <div class="m-0">
                            <h6 class="mb-1 fw-semibold">Douglass Shaw</h6>
                            <p class="mb-1 text-secondary">
                                Membership has been ended.
                            </p>
                            <p class="small m-0 text-muted">Today, 07:30 PM</p>
                        </div>
                    </div>
                </div>

                <div class="d-grid mx-3 my-1">
                    <a href="javascript:void(0)" class="btn btn-info">View all</a>
                </div>
                <!--end::Menu item-->
            </div>
            
                <!--end::Menu wrapper-->
            </div>
            <!--end::User menu-->
        </div>
         <!--end::Navbar-->
         @endif
        <!--end::Menu wrapper-->
        <!--begin::Navbar-->
        <div class="app-navbar flex-shrink-0">
            <!--begin::User menu-->
            <div class="app-navbar-item ms-1 ms-md-4" id="kt_header_user_menu_toggle">
                <!--begin::Menu wrapper-->
                <div class="cursor-pointer symbol symbol-35px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                    data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                    <img src="{{ asset('admin.avif') }}" class="rounded-3" alt="user" />
                </div>
                <!--begin::User account menu-->
                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px"
                    data-kt-menu="true">
                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                        <div class="menu-content d-flex align-items-center px-3">
                            <!--begin::Avatar-->
                            <div class="symbol symbol-50px me-5">
                                <img alt="Logo" src="{{ asset('admin.avif') }}" />
                            </div>
                            <!--end::Avatar-->
                            <!--begin::Username-->
                            <div class="d-flex flex-column">
                                <div class="fw-bold d-flex align-items-center fs-5">{{ auth()->user()->name }}
                                    {{-- <span class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2">Pro</span> --}}
                                </div>
                                <a href="#"
                                    class="fw-semibold text-muted text-hover-primary fs-7">{{ auth()->user()->email }}</a>
                            </div>
                            <!--end::Username-->
                        </div>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu separator-->
                    <div class="separator my-2"></div>
                    <!--end::Menu separator-->
                    <!--begin::Menu item-->
                    {{-- @if (auth()->user()->can('Edit Admin'))
                        <div class="menu-item px-5">
                            <a href="{{ route('admins.edit', auth()->user()->id) }}"
                                class="menu-link px-5">{{ __('lang.profile') }}</a>
                        </div>

                        <!--begin::Menu separator-->
                        <div class="separator my-2"></div>
                    @endif
                    <!--end::Menu separator-->
                    <!--begin::Menu item-->
                    @if (auth()->user()->can('Edit Setting'))
                        <div class="menu-item px-5">
                            <a href="{{ route('settings.index') }}" class="menu-link px-5">{{ __('lang.setting') }}</a>
                        </div>
                        <!--begin::Menu separator-->
                        <div class="separator my-2"></div>
                    @endif --}}
                    <!--end::Menu separator-->

                    <!--begin::Menu item-->
                    <div class="menu-item px-5" data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                        data-kt-menu-placement="left-start" data-kt-menu-offset="-15px, 0">
                        <a href="#" class="menu-link px-5">
                            <span class="menu-title position-relative">{{ __('lang.language') }}
                                {{-- <span
                                        class="fs-8 rounded bg-light px-3 py-2 position-absolute translate-middle-y top-50 end-0">{{ LaravelLocalization::getCurrentLocaleNative() }}
                                        <img class="w-15px h-15px rounded-1 ms-2"
                                            src="assets/media/flags/united-states.svg" alt="" />
                                    </span> --}}
                            </span>
                        </a>
                        <!--begin::Menu sub-->
                        <div class="menu-sub menu-sub-dropdown w-175px py-4">
                            <!--begin::Menu item-->
                            @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <div class="menu-item px-3">
                                    <a rel="alternate" hreflang="{{ $localeCode }}"
                                        href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                                        class="menu-link d-flex px-5 active">
                                        {{ $properties['native'] }}

                                    </a>

                                </div>
                            @endforeach

                            <!--end::Menu item-->
                        </div>
                        <!--end::Menu sub-->
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-5">
                        <a href="{{ route('logout') }}" class="menu-link px-5">{{ __('lang.signout') }}</a>
                    </div>
                    <!--end::Menu item-->
                </div>
                <!--end::User account menu-->
                <!--end::Menu wrapper-->
            </div>
            <!--end::User menu-->
            <!--begin::Header menu toggle-->
            <div class="app-navbar-item d-lg-none ms-2 me-n2" title="Show header menu">
                <div class="btn btn-flex btn-icon btn-active-color-primary w-30px h-30px"
                    id="kt_app_header_menu_toggle">
                    <i class="ki-duotone ki-element-4 fs-1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </div>
            </div>
            <!--end::Header menu toggle-->
            <!--begin::Aside toggle-->
            <!--end::Header menu toggle-->
        </div>
        <!--end::Navbar-->
    </div>
    <!--end::Header wrapper-->
</div>
<!--end::Header container-->
<!--end::Header-->
