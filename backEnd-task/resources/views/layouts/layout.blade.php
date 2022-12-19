@php
    if (app()->getLocale() == 'en') {
        $dir = 'ltr';
    } else {
        $dir = 'rtl';
    }
@endphp
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ $dir }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="{{asset('assets')}}/">
    <title>Dashboard</title>
    <style>
        @media print {
            .control-btn {
                display: none;
            }
        }
    </style>

        <link rel="apple-touch-icon" href="admin/app-assets/images/ico/apple-icon-120.png">
        <link rel="shortcut icon" type="image/x-icon" href="admin/app-assets/images/ico/favicon.ico">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('admin/app-assets/images/ico/favicon.ico') }} " type="image/x-icon">
    {{-- <link rel="stylesheet" href="{{ asset('providers/css/jquery.signature.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('providers/css/all.min.css') }}">
    <link rel="stylesheet" type="text/css" href="admin/app-assets/vendors/css/extensions/toastr.min.css">
    <link rel="stylesheet" type="text/css" href="admin/app-assets/css-rtl/plugins/extensions/ext-component-toastr.css">
    <style>
        .toast{
            position: absolute !important;
            top: 0 !important;
            left: 0 !important;
        }
        .toast:before{
            right: 86% !important;
        }
        .error-help-block{
            color: red
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('providers/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('providers/css/main-merchant.css') }}">
    {{-- <link href="assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" /> --}}
    {{-- <script src="assets/plugins/custom/datatables/datatables.bundle.js"></script> --}}
    @if ($dir == 'rtl')
    <link href='https://fonts.googleapis.com/css?family=Noto Naskh Arabic' rel='stylesheet'>
        <style type="text/css">
                h1,h2,h3,h5,h6,h4,button,a,p,span,tr,td,th,label,input,div {
            font-family:'Noto Naskh Arabic'!important;
            font-weight:bold !important;
        }
            .field-icon {
                float: left;
                margin-left: 5px;
                margin-top: -65px;
                position: relative;
                z-index: 2;
            }
        </style>
        <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400&amp;display=swap" rel="stylesheet">

        <link href="{{ asset('dashboard/plugins/custom/prismjs/prismjs.bundle.rtl.css') }}" rel="stylesheet"
            type="text/css" />
        <link href="{{ asset('dashboard/plugins/global/plugins.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('dashboard/plugins/global/plugins-custom.bundle.rtl.css') }}" rel="stylesheet"
            type="text/css" />
        <link href="{{ asset('dashboard/css/style.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
    @else
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
        <!--begin::Fonts-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
        <!--end::Fonts-->

        <!--begin::Global Stylesheets Bundle(used by all pages)-->
        <link href="{{ asset('dashboard/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('dashboard/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
        <!--end::Global Stylesheets Bundle-->
        @endif
    <link href="{{ asset('dashboard/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dashboard/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    {{-- <style>
        .leftNavBarItems {
            display: flex;
            justify-content: end;
            align-items: center;
        }

        .leftNavBarItems .form-switch .form-check-input {
            width: 45px;
            height: 25px;
        }

        .leftNavBarItems label.form-check-label {
            margin-right: 34px;
            text-align: center;
            margin-top: 5px;
        }

    </style> --}}

</head>

<body data-kt-name="metronic" id="kt_app_body" data-kt-app-layout="light-sidebar" data-kt-app-header-fixed="false"
    data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true"
    data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true"
    data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">
    <script>
        if (document.documentElement) {
            const defaultThemeMode = "system";
            const name = document.body.getAttribute("data-kt-name");
            let themeMode = localStorage.getItem("kt_" + (name !== null ? name + "_" : "") + "theme_mode_value");
            if (themeMode === null) {
                if (defaultThemeMode === "system") {
                    themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
                } else {
                    themeMode = defaultThemeMode;
                }
            }
            document.documentElement.setAttribute("data-theme", themeMode);
        }
    </script>


    <!-- start dashboard header -->

    <!-- end dashboard header -->

    <!-- start dashboard info -->

    {{-- @if (auth()->user()->active) --}}
        @include('layouts.includes.header')
    {{-- @endif --}}

    <!-- end navigation -->


    <!-- start dashboard info -->

    <!-- start footer -->
    <div class="dashboard-copyright text-center bg-light">
        <p> All rights reserved to &copy; </a></p>
    </div>
    <!-- end footer -->



    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{ asset('dashboard/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('dashboard/js/scripts.bundle.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/map.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/continentsLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/usaLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZonesLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZoneAreasLow.js"></script>
    <script src="{{ asset('dashboard/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('dashboard/js/widgets.bundle.js') }}"></script>
    <script src="{{ asset('dashboard/js/custom/widgets.js') }}"></script>
    <script src="{{ asset('dashboard/js/custom/apps/chat/chat.js') }}"></script>
    <script src="{{ asset('dashboard/js/custom/utilities/modals/upgrade-plan.js') }}"></script>
    <script src="{{ asset('dashboard/js/custom/utilities/modals/create-app.js') }}"></script>
    <script src="{{ asset('dashboard/js/custom/utilities/modals/new-target.js') }}"></script>
    <script src="{{ asset('dashboard/js/custom/utilities/modals/users-search.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/toastr/toastr.min.js') }}"></script>


    <script src="admin/app-assets/vendors/js/extensions/toastr.min.js"></script>
    <script>
        function AlertMe(type = 'success',message) {
            if(message != undefined) {
                toastr[type]("",message, { timeOut: 5000,closeButton:true,positionClass: "toast-top-center",});
            }
        }
    </script>
    @if(session()->has('success'))
        <script>
           AlertMe('success',"{{ session()->get("success") }}");
        </script>
    @endif
    @if(session()->has('error'))
        <script>
           AlertMe('error',"{{ session()->get("error") }}");
        </script>
    @endif
    <script>
        $(window).on('load', function () {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session()->has('success'))
        <script type="text/javascript">
            swal({
                title: "{{ session()->get('success') }}",
                text: "{{ session()->get('success') }}",
                icon: "success",
                button: "اغلاق!",
            });
        </script>
    @endif

    @if (session()->has('error'))
        <script type="text/javascript">
            swal({
                title: "{{ session()->get('error') }}",
                text: "{{ session()->get('error') }}",
                icon: "error",
                button: "اغلاق!",
            });
        </script>
    @endif
    <script>
        function resetForm() {
            // $(".select-search > option").removeAttr("selected");
            $(".dt_adv_search .form-select").val(null).trigger('change');
            $(".dt_adv_search :input").val("");
            $(".dt_adv_search :input").trigger("reset");
            window.location.href = @json(route('movie.index'));
        }
    </script>

    @stack('scripts')

</body>

</html>
