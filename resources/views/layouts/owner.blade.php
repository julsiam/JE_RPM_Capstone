<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> --}}


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />

    <!-- Scripts -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="{{ mix('js/app.js') }}"></script>


</head>
<style>
    .logo {
        width: 75px;
    }

    .svg-cont {
        color: #FFA500;
    }

    .alert_list {
        font-size: 11px;
        color: grey
    }

    li.alert_li {
        color: grey;
        padding: 10px 0px 2px 0px;
        border-bottom: thin solid #c0c0c0;
        list-style: none
    }

    li.alert_li:hover {
        background-color: #eee
    }

    .turn_off_alert {
        float: right;
        margin-bottom: 1px
    }

    a.alert_message {
        color: rgb(8, 8, 8);
        text-decoration: none;
        font-size: 13px;

    }

    a.alert_message.date {
        font-size: 7px;
    }

    a.alert_message:hover {
        color: grey
    }
    body{
        background-color: #EFEFEF;
    }
    .fc-event {
  background-color: #3498db;
  color: #fff;
}





</style>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">
                    @if (env('APP_ENV') === 'local')
                        <img class="logo" src="{{ asset('image/logo.png') }}" alt="logo">
                    @else
                        <img class="logo" src="{{ secure_asset('image/logo.png') }}" alt="logo">
                    @endif
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('owner_dashboard') ? 'active' : null }}"
                                aria-current="page" href="{{ url('/owner_dashboard') }}">
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('announcements') ? 'active' : null }}"
                                href="{{ url('/announcements') }}">
                                Announcement
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('properties') ? 'active' : null }}"
                                href="{{ url('/properties') }}">
                                Properties
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('tenants') ? 'active' : null }}" aria-current="page"
                                href="{{ url('/tenants') }}">
                                Tenants
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('maintenance') ? 'active' : null }}"
                                href="{{ url('/maintenance') }}">
                                Maintenance Requests
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('paid_reports') }}">
                                Payment Records
                            </a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">

                        {{-- <li class="nav-item">
                            <a data-count="0" class="nav-link" type="button" id="bell">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16">
                                    <path
                                        d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z" />
                                </svg>
                            </a>

                            <div id="notifications-panel" class="position-absolute d-none bg-light border p-2">
                                <ul class="list-group list-group-flush" id="notification_list">
                                </ul>
                            </div>

                        </li> --}}

                        <li class="nav-item">
                            <a href="#" id="bell" class="btn btn-primary" type="button"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16">
                                    <path
                                        d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z" />
                                </svg>
                                <span id="notification-count"
                                    class="badge badge-danger">{{ $newNotification }}</span>
                            </a>
                            <div style="display:none" class="alert_list">
                                <ul class="unstyled">
                                    @foreach ($notifications as $notification)
                                        <li class="alert_li">
                                            <a class="alert_message"
                                                href="#">{{ $notification->user->first_name }}
                                                {{ $notification->user->last_name }} {{ $notification->message }}</a>
                                            <br>
                                            <br>
                                            <span>{{ $notification->created_at->format('F d, Y') }}</span>
                                            <br>
                                            <div class="clearfix"></div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </li>


                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                        @else
                            <li class="nav-item dropdown">

                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    | {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" href="{{ url('profile') }}">
                                        {{ __('Profile') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main class="col-md-12 ml-sm-auto">
            <div class="py-12">
                @yield('content')
            </div>
        </main>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- <script src="{{ asset('js/animateCounter.js') }}"></script> -->

    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"
        integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0=" crossorigin="anonymous"></script>

    {{--
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"
        integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>

    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js'></script>

    @if (env('APP_ENV') === 'local')
        <script src="{{ asset('js/tenants_counts.js') }}"></script>
        <script src="{{ asset('js/tenants_counts.js') }}"></script>
        <script src="{{ asset('js/property_counts.js') }}"></script>
        <script src="{{ asset('js/income_count.js') }}"></script>


        <script src="{{ asset('js/tenant_form.js') }}"></script>
        <script src="{{ asset('js/rental_status.js') }}"></script>
        <script src="{{ asset('js/bday.js') }}" defer></script>
        <script src="{{ asset('js/bday_input.js') }}"></script>
        <script src="{{ asset('js/room_unit.js') }}"></script>
        <script src="{{ asset('js/rental_details.js') }}"></script>
        <script src="{{ asset('js/edit_tenant.js') }}"></script>
        <script src="{{ asset('js/success_add_Modal.js') }}"></script>
        <script src="{{ asset('js/bill_status_calculate.js') }}"></script>
        <script src="{{ asset('js/rent_date.js') }}"></script>
        <script src="{{ asset('js/maintenance.js') }}"></script>
        <script src="{{ asset('js/search_sort.js') }}"></script>
        <script src="{{ asset('js/announcement.js') }}"></script>
        <script src="{{ asset('js/delete_confirm.js') }}"></script>
        <script src="{{ asset('js/data_tables.js') }}"></script>
        <script src="{{ asset('js/paid_records.js') }}"></script>
        <script src="{{ asset('js/unpaid_records.js') }}"></script>
        <script src="{{ asset('js/notfullypaid_records.js') }}"></script>
        <script src="{{ asset('js/paid_report.js') }}"></script>
        <script src="{{ asset('js/unpaid_report.js') }}"></script>
        <script src="{{ asset('js/calendar.js') }}"></script>
        <script src="{{ asset('js/tenants_details.js') }}"></script>
        <script src="{{ asset('js/profile.js') }}"></script>
        <script src="{{ asset('js/property.js') }}"></script>
        <script src="{{ asset('js/notification.js') }}"></script>
    @else
        <script src="{{ secure_asset('js/tenants_counts.js') }}"></script>
        <script src="{{ secure_asset('js/property_counts.js') }}"></script>
        <script src="{{ secure_asset('js/income_count.js') }}"></script>
        <script src="{{ secure_asset('js/tenant_form.js') }}"></script>
        <script src="{{ secure_asset('js/rental_status.js') }}"></script>
        <script src="{{ secure_asset('js/bday.js') }}" defer></script>
        <script src="{{ secure_asset('js/bday_input.js') }}"></script>
        <script src="{{ secure_asset('js/room_unit.js') }}"></script>
        <script src="{{ secure_asset('js/rental_details.js') }}"></script>
        <script src="{{ secure_asset('js/edit_tenant.js') }}"></script>
        <script src="{{ secure_asset('js/success_add_Modal.js') }}"></script>
        <script src="{{ secure_asset('js/bill_status_calculate.js') }}"></script>
        <script src="{{ secure_asset('js/rent_date.js') }}"></script>
        <script src="{{ secure_asset('js/maintenance.js') }}"></script>
        <script src="{{ secure_asset('js/search_sort.js') }}"></script>
        <script src="{{ secure_asset('js/announcement.js') }}"></script>
        <script src="{{ secure_asset('js/delete_confirm.js') }}"></script>
        <script src="{{ secure_asset('js/data_tables.js') }}"></script>
        <script src="{{ secure_asset('js/paid_records.js') }}"></script>
        <script src="{{ secure_asset('js/unpaid_records.js') }}"></script>
        <script src="{{ secure_asset('js/notfullypaid_records.js') }}"></script>
        <script src="{{ secure_asset('js/paid_report.js') }}"></script>
        <script src="{{ secure_asset('js/unpaid_report.js') }}"></script>
        <script src="{{ secure_asset('js/calendar.js') }}"></script>
        <script src="{{ secure_asset('js/tenants_details.js') }}"></script>
        <script src="{{ secure_asset('js/profile.js') }}"></script>
        <script src="{{ secure_asset('js/property.js') }}"></script>
        <script src="{{ secure_asset('js/notification.js') }}"></script>
    @endif

</body>

</html>
