@if (auth()->user()->active)
<div class="app-sidebar-menu overflow-hidden flex-column-fluid">
    <!--begin::Menu wrapper-->
    <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5" data-kt-scroll="true"
        data-kt-scroll-activate="true" data-kt-scroll-height="auto"
        data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
        data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
        <!--begin::Menu-->
        <div class="menu menu-column menu-rounded menu-sub-indention px-3" id="#kt_app_sidebar_menu" data-kt-menu="true"
            data-kt-menu-expand="false">
            <!--begin:Menu item-->
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion menu-main-accordion">
                <div class="menu-item">
                    <a class="menu-link " href="{{ route('home') }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <h3 class="menu-title fw-bolder">@lang('landing Page')</h3>
                    </a>
                </div>
            </div>
            <!--begin:Menu link-->

            @if (auth()->user()->can('role_view') ||
                auth()->user()->can('role_create'))
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <span class="svg-icon svg-icon-2">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect x="2" y="2" width="9" height="9" rx="2"
                                        fill="currentColor" />
                                    <rect opacity="0.3" x="13" y="2" width="9" height="9"
                                        rx="2" fill="currentColor" />
                                    <rect opacity="0.3" x="13" y="13" width="9" height="9"
                                        rx="2" fill="currentColor" />
                                    <rect opacity="0.3" x="2" y="13" width="9" height="9"
                                        rx="2" fill="currentColor" />
                                </svg>
                            </span>
                        </span>
                        <span class="menu-title">Roles</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <!--end:Menu link-->
                    <!--begin:Menu sub-->
                    <div class="menu-sub menu-sub-accordion">
                        <!--begin:Menu item-->
                        @if (auth()->user()->can('role_view'))
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link" href="{{ route('role.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Roles List</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                        @endif
                        @if (auth()->user()->can('role_create'))
                            <div class="menu-item">
                                <a class="menu-link" href="{{ route('role.create') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Create Role</span>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            @if (auth()->user()->can('user_view') ||
                auth()->user()->can('user_create'))
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <span class="svg-icon svg-icon-2">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect x="2" y="2" width="9" height="9" rx="2"
                                        fill="currentColor" />
                                    <rect opacity="0.3" x="13" y="2" width="9" height="9"
                                        rx="2" fill="currentColor" />
                                    <rect opacity="0.3" x="13" y="13" width="9" height="9"
                                        rx="2" fill="currentColor" />
                                    <rect opacity="0.3" x="2" y="13" width="9"
                                        height="9" rx="2" fill="currentColor" />
                                </svg>
                            </span>
                        </span>
                        <span class="menu-title">Users</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <!--end:Menu link-->
                    <!--begin:Menu sub-->
                    <div class="menu-sub menu-sub-accordion">
                        <!--begin:Menu item-->
                        @if (auth()->user()->can('user_view'))
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link" href="{{ route('user.index', ['type' => 'Users']) }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Users List</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                        @endif
                        @if (auth()->user()->can('user_create'))
                            <div class="menu-item">
                                <a class="menu-link" href="{{ route('user.create', ['type' => 'Users']) }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Create User</span>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            @if (auth()->user()->can('user_view') ||
                auth()->user()->can('user_create'))
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <span class="svg-icon svg-icon-2">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect x="2" y="2" width="9" height="9"
                                        rx="2" fill="currentColor" />
                                    <rect opacity="0.3" x="13" y="2" width="9"
                                        height="9" rx="2" fill="currentColor" />
                                    <rect opacity="0.3" x="13" y="13" width="9"
                                        height="9" rx="2" fill="currentColor" />
                                    <rect opacity="0.3" x="2" y="13" width="9"
                                        height="9" rx="2" fill="currentColor" />
                                </svg>
                            </span>
                        </span>
                        <span class="menu-title">Providers</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <!--end:Menu link-->
                    <!--begin:Menu sub-->
                    <div class="menu-sub menu-sub-accordion">
                        <!--begin:Menu item-->
                        @if (auth()->user()->can('user_view'))
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link" href="{{ route('user.index', ['type' => 'Providers']) }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Providers List</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                        @endif
                        @if (auth()->user()->can('user_create'))
                            <div class="menu-item">
                                <a class="menu-link" href="{{ route('user.create', ['type' => 'Providers']) }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Create Provider</span>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            @if (auth()->user()->can('category_view') ||
                auth()->user()->can('category_create'))
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <span class="svg-icon svg-icon-2">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect x="2" y="2" width="9" height="9"
                                        rx="2" fill="currentColor" />
                                    <rect opacity="0.3" x="13" y="2" width="9"
                                        height="9" rx="2" fill="currentColor" />
                                    <rect opacity="0.3" x="13" y="13" width="9"
                                        height="9" rx="2" fill="currentColor" />
                                    <rect opacity="0.3" x="2" y="13" width="9"
                                        height="9" rx="2" fill="currentColor" />
                                </svg>
                            </span>
                        </span>
                        <span class="menu-title">Categories</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <!--end:Menu link-->
                    <!--begin:Menu sub-->
                    <div class="menu-sub menu-sub-accordion">
                        <!--begin:Menu item-->
                        @if (auth()->user()->can('category_view'))
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link" href="{{ route('category.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Categories List</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                        @endif
                        @if (auth()->user()->can('category_create'))
                            <div class="menu-item">
                                <a class="menu-link" href="{{ route('category.create') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Create Category</span>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            @if (auth()->user()->can('movie_view') ||
                auth()->user()->can('movie_create'))
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <span class="svg-icon svg-icon-2">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect x="2" y="2" width="9" height="9"
                                        rx="2" fill="currentColor" />
                                    <rect opacity="0.3" x="13" y="2" width="9"
                                        height="9" rx="2" fill="currentColor" />
                                    <rect opacity="0.3" x="13" y="13" width="9"
                                        height="9" rx="2" fill="currentColor" />
                                    <rect opacity="0.3" x="2" y="13" width="9"
                                        height="9" rx="2" fill="currentColor" />
                                </svg>
                            </span>
                        </span>
                        <span class="menu-title">Movies</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <!--end:Menu link-->
                    <!--begin:Menu sub-->
                    <div class="menu-sub menu-sub-accordion">
                        <!--begin:Menu item-->
                        @if (auth()->user()->can('movie_view'))
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link" href="{{ route('movie.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Movies List</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                        @endif
                        @if (auth()->user()->can('movie_create'))
                            <div class="menu-item">
                                <a class="menu-link" href="{{ route('movie.create') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Create Movie</span>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endif
