<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Admin Dashboard</title>

    <meta name="description" content="" />


</head>

<body>

    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">


            @include('layouts.Admin.Sidebar')

            <div class="layout-page">

                @include('layouts.Admin.Header')

                <div class="content-wrapper">


                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row">
                            <h3 class="card-title mb-2">Admin Dashboard</h3>
                            <div class="col-lg-5 col-md-4 order-1">
                                <div class="row">
                                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div
                                                    class="card-title d-flex align-items-start justify-content-between">
                                                    <div class="avatar flex-shrink-0">
                                                        <img src="{{ asset('assets/assets/img/icons/unicons/chart-success.png') }}"
                                                            alt="chart success" class="rounded" />
                                                    </div>

                                                </div>
                                                <span class="fw-semibold d-block mb-1">Student</span>
                                                <h3 class="card-title mb-2">$12,628</h3>
                                                <small class="text-success fw-semibold"><i
                                                        class="bx bx-up-arrow-alt"></i> +72.80%</small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div
                                                    class="card-title d-flex align-items-start justify-content-between">
                                                    <div class="avatar flex-shrink-0">
                                                        <img src="{{ asset('assets/assets/img/icons/unicons/wallet-info.png') }}"
                                                            alt="Credit Card" class="rounded" />
                                                    </div>

                                                </div>
                                                <span>Teachers</span>
                                                <h3 class="card-title text-nowrap mb-1">$4,679</h3>
                                                <small class="text-success fw-semibold"><i
                                                        class="bx bx-up-arrow-alt"></i> +28.42%</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-8 col-lg-6 order-3 order-md-2">
                                <div class="row">
                                    <div class="col-5 mb-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div
                                                    class="card-title d-flex align-items-start justify-content-between">
                                                    <div class="avatar flex-shrink-0">
                                                        <img src="{{ asset('assets/assets/img/icons/unicons/paypal.png') }}"
                                                            alt="Credit Card" class="rounded" />
                                                    </div>

                                                </div>
                                                <span class="d-block mb-1">Classes</span>
                                                <h3 class="card-title text-nowrap mb-2">$2,456</h3>
                                                <small class="text-danger fw-semibold"><i
                                                        class="bx bx-down-arrow-alt"></i> -14.82%</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-5 mb-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div
                                                    class="card-title d-flex align-items-start justify-content-between">
                                                    <div class="avatar flex-shrink-0">
                                                        <img src="{{ asset('assets/assets/img/icons/unicons/cc-primary.png') }}"
                                                            alt="Credit Card" class="rounded" />
                                                    </div>

                                                </div>
                                                <span class="fw-semibold d-block mb-1">Subjects</span>
                                                <h3 class="card-title mb-2">$14,857</h3>
                                                <small class="text-success fw-semibold"><i
                                                        class="bx bx-up-arrow-alt"></i> +28.14%</small>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>

                    </div>


                </div>

            </div>

        </div>

    </div>

</body>

</html>
@include('layouts.Admin.link')
