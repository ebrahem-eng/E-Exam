<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Teacher Class Table</title>

    <meta name="description" content="" />

</head>

<body>

    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">


            @include('layouts.Teacher.Sidebar')

            <div class="layout-page ">

                @include('layouts.Teacher.Header')



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
                <div class="d-flex justify-content-center flex-wrap mt-5">
                    @foreach ($classes as $class)
                        <div class="col-md-4 col-lg-4 mb-3 mx-4">
                            <div class="card h-90">
                                <img class="card-img-top" src="{{ asset('assets/assets/img/elements/book.jpg') }}"
                                    alt="Card image cap" />
                                <div class="card-body">
                                    <h5 class="card-title">Class Id</h5>
                                    <p class="card-text">{{ $class->id }}</p>
                                    <h5 class="card-title">Class Name</h5>
                                    <p class="card-text">{{ $class->name }}</p>
                                    <h5 class="card-title">Class Code</h5>
                                    <p class="card-text">{{ $class->code }}</p>
                                    <h5 class="card-title">Class Status</h5>
                                    <p class="card-text">
                                        @if ($class->status == 0)
                                            <span class="badge bg-label-danger me-1">Not Active</span>
                                        @elseif ($class->status == 1)
                                            <span class="badge bg-label-success me-1">Active</span>
                                        @endif
                                    </p>
                                    <form action="{{ route('teacher.class.subject') }}" method="GET">
                                        @csrf
                                        <button class="btn btn-outline-primary">Show Subjects</button>
                                        <input type="hidden" name="class_id" value="{{ $class->id }}" />
                                    </form>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>


            </div>
        </div>
    </div>
</body>

</html>
@include('layouts.Teacher.link')
