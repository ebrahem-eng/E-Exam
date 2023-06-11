<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Student Dashboard</title>

    <meta name="description" content="" />


</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            @include('layouts.Student.Sidebar')
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                @include('layouts.Student.Header')
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    {{-- message section --}}


                    <div
                        style="display: flex; justify-content: center; align-items: flex-start; height: 100vh; margin-top:20px">

                        <div class="col-xl-7">
                            <div class="nav-align-top mb-4">
                                <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
                                    <li class="nav-item">
                                        <button type="button" class="nav-link active" role="tab"
                                            data-bs-toggle="tab" data-bs-target="#navs-pills-justified-home"
                                            aria-controls="navs-pills-justified-home" aria-selected="true">
                                            <i class="bx bxs-user"></i> Personal Info
                                        </button>
                                    </li>
                                    <li class="nav-item">
                                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                            data-bs-target="#navs-pills-justified-profile"
                                            aria-controls="navs-pills-justified-profile" aria-selected="false">
                                            <i class="bx bxs-lock"></i> Reset Password
                                        </button>
                                    </li>
                                    <li class="nav-item">
                                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                            data-bs-target="#navs-pills-justified-messages"
                                            aria-controls="navs-pills-justified-messages" aria-selected="false">
                                            <i class="bx bxs-phone"></i> Contact Info
                                        </button>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="navs-pills-justified-home"
                                        role="tabpanel">



                                        {{-- message section --}}

                                        @if (session('success_message'))
                                            <div class="alert alert-success alert-dismissible" role="alert">
                                                {{ session('success_message') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        @endif

                                        @if (session('error_message'))
                                            <div class="alert alert-danger alert-dismissible" role="alert">
                                                {{ session('error_message') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        @endif

                                        {{-- end message section --}}


                                        <form method="post"
                                            action="{{ route('student.profile.personal.update', $students->id) }}">
                                            @method('put')
                                            @csrf
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label class="form-label"
                                                        for="basic-icon-default-fullname">Name</label>
                                                    <div class="input-group input-group-merge">
                                                        <span id="basic-icon-default-fullname2"
                                                            class="input-group-text"><i class="bx bx-user"></i></span>
                                                        <input type="text" class="form-control"
                                                            id="basic-icon-default-fullname" placeholder="John Doe"
                                                            aria-label="John Doe"
                                                            aria-describedby="basic-icon-default-fullname2"
                                                            name="name" value="{{ $students->name }}" required />
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="form-label"
                                                        for="basic-icon-default-email">Birthday</label>
                                                    <div class="input-group input-group-merge">
                                                        <span class="input-group-text"><i
                                                                class="bx bx-calendar"></i></span>
                                                        <input type="date" class="form-control" placeholder=""
                                                            value="{{ $students->birthday }}" name="birthday" />
                                                    </div>
                                                </div>
                                            </div>

                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </form>




                                    </div>
                                    <div class="tab-pane fade" id="navs-pills-justified-profile" role="tabpanel">
                                        <p>
                                            {{-- text --}}
                                        <div class="tab-pane fade show active" id="navs-pills-justified-home"
                                            role="tabpanel">



                                            <form method="post"
                                                action="{{ route('student.profile.reset.password.update', $students->id) }}">
                                                @method('put')
                                                @csrf

                                                <div class="row mb-3">
                                                    <div class="col-md-9">
                                                        <label class="form-label"
                                                            for="basic-icon-default-fullname">Current Password</label>
                                                        <div class="input-group input-group-merge">
                                                            <span id="basic-icon-default-fullname2"
                                                                class="input-group-text"><i
                                                                    class="bx bx-lock"></i></span>
                                                            <input type="password" class="form-control"
                                                                id="basic-icon-default-fullname"
                                                                placeholder="Current Password"
                                                                aria-describedby="basic-icon-default-fullname2"
                                                                name="current_password" required />
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-md-9">
                                                        <label class="form-label" for="basic-icon-default-email">New
                                                            Password</label>
                                                        <div class="input-group input-group-merge">
                                                            <span class="input-group-text"><i
                                                                    class="bx bx-lock"></i></span>
                                                            <input type="password" class="form-control"
                                                                placeholder="New Password" name="new_password"
                                                                required />
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-md-9">
                                                        <label class="form-label"
                                                            for="basic-icon-default-email">Confirm New Password</label>
                                                        <div class="input-group input-group-merge">
                                                            <span class="input-group-text"><i
                                                                    class="bx bx-lock"></i></span>
                                                            <input type="password" class="form-control"
                                                                placeholder="Confirm New Password"
                                                                name="confirm_new_password" required />
                                                        </div>
                                                    </div>
                                                </div>

                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </form>

                                        </div>

                                        </p>
                                        <p class="mb-0">
                                            {{-- text --}}
                                        </p>
                                    </div>
                                    <div class="tab-pane fade" id="navs-pills-justified-messages" role="tabpanel">
                                        <p>

                                        <form method="post"
                                            action="{{ route('student.profile.contact.update', $students->id) }}">
                                            @method('put')
                                            @csrf
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label class="form-label"
                                                        for="basic-icon-default-fullname">Email</label>
                                                    <div class="input-group input-group-merge">
                                                        <span id="basic-icon-default-fullname2"
                                                            class="input-group-text"><i class="bx bx-user"></i></span>
                                                        <input type="email" class="form-control"
                                                            id="basic-icon-default-fullname"
                                                            placeholder="example@gmail.com"
                                                            aria-describedby="basic-icon-default-fullname2"
                                                            name="email" value="{{ $students->email }}" readonly
                                                            required />
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="form-label"
                                                        for="basic-icon-default-email">Phone</label>
                                                    <div class="input-group input-group-merge">
                                                        <span class="input-group-text"><i
                                                                class="bx bx-phone"></i></span>
                                                        <input type="tel" class="form-control"
                                                            placeholder="0987654321" value="{{ $students->phone }}"
                                                            name="phone" />
                                                    </div>
                                                </div>
                                            </div>

                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </form>

                                        </p>
                                        <p class="mb-0">
                                            {{-- text --}}
                                        </p>
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
@include('layouts.Student.link')
