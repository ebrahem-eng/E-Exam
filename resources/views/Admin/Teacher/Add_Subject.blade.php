<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Add Subject For Teacher</title>

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
                            <h5 class="mb-0">Add Subjects To Teacher</h5>
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

                            @if (session('store_error_message'))
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    {{ session('store_error_message') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            {{-- end message section --}}

                            <form method="post" action="{{route('admin.store.subject.teacher')}}">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label" for="basic-icon-default-email">Teacher Name</label>
                                    <div class="input-group input-group-merge">
                                       
                                        <input type="text" class="form-control" name="teacher_name"
                                            value="{{$teacher_name}}" readonly required />

                                        <input name="teacher_id" type="hidden" value="{{$teacher_id}}" />
                                    </div>

                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlSelect2" class="form-label">Select Subjects</label>
                                    <select multiple class="form-select" id="exampleFormControlSelect2"
                                        aria-label="Multiple select example" name="subjectId[]">
                                        @foreach ($subjects as $subject)
                                            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                        @endforeach
                                    </select>
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
