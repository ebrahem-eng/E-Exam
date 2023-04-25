<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Add Teacher</title>

    <meta name="description" content="" />

</head>

<body>

    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">


            @include('layouts.Admin.Sidebar')

            <div class="layout-page ">

                @include('layouts.Admin.Header')

                <div class="col-lg-6 mt-5 mx-auto">
                    <div class="card  mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Add Teacher</h5>

                        </div>
                        <div class="card-body">

                            {{-- message section --}}

                            @if (session('store_success_message'))
                                <div class="alert alert-success alert-dismissible" role="alert">
                                    {{ session('store_success_message') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            {{-- end message section --}}

                            <form method="post" action="{{ route('admin.teacher.store') }}">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label" for="basic-icon-default-fullname">Name</label>
                                        <div class="input-group input-group-merge">
                                            <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                                    class="bx bx-user"></i></span>
                                            <input type="text" class="form-control" id="basic-icon-default-fullname"
                                                placeholder="John Doe" aria-label="John Doe"
                                                aria-describedby="basic-icon-default-fullname2" name="name" required />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="basic-icon-default-company">Email</label>
                                        <div class="input-group input-group-merge">
                                            <span id="basic-icon-default-company2" class="input-group-text"><i
                                                    class="bx bx-buildings"></i></span>
                                            <input type="email" id="basic-icon-default-company" class="form-control"
                                                placeholder="example@gmail.com" aria-label="ACME Inc."
                                                aria-describedby="basic-icon-default-company2"  name="email" required/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-8">
                                        <label class="form-label" for="basic-icon-default-email">Password</label>
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text"><i class="bx bx-buildings"></i></span>
                                            <input type="password" class="form-control" placeholder="Class A"
                                                name="password" required />

                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                   
                                        <div class="form-check form-check-inline mt-4">
                                            <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="1" />
                                            <label class="form-check-label" for="inlineRadio1">Male</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="0" />
                                            <label class="form-check-label" for="inlineRadio2">Female</label>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-7">
                                        <label class="form-label" for="basic-icon-default-email">Phone</label>
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text"><i class="bx bx-phone"></i></span>
                                            <input type="tel" class="form-control" placeholder=" 098765421"
                                                name="phone" required />

                                        </div>

                                    </div>

                                    <div class="col-md-5">
                                        <label class="form-label" for="basic-icon-default-email">Birthday</label>
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text"><i class="bx bx-phone"></i></span>
                                            <input type="date" class="form-control" placeholder="Class A"
                                                name="birthday" />

                                        </div>

                                    </div>


                                </div>
                                <div class="row mb-3">
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label">Photo</label>
                                        <input class="form-control" type="file" id="formFile" name="photo" />
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">OK</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
@include('layouts.Admin.link')
