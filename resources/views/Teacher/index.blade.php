<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Teacher Dashboard</title>

    <meta name="description" content="" />


</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            @include('layouts.Teacher.Sidebar')
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                @include('layouts.Teacher.Header')
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                           {{-- message section --}}

                           <div style="margin-top: 10px;" class="mx-5">

                            @if (session('store_success_message'))
                                <div class="alert alert-success alert-dismissible" role="alert">
                                    {{ session('store_success_message') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif


                            @if (session('store_error_message'))
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    {{ session('store_error_message') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                        </div>
                        {{-- end message section --}}

                  

</body>

</html>
@include('layouts.Teacher.link')
