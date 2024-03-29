<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Subject Table</title>

    <meta name="description" content="" />

</head>

<body>

    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">


            @include('layouts.Student.Sidebar')

            <div class="layout-page ">

                @include('layouts.Student.Header')

                @if (count($subjects) > 0)
                    <div class="d-flex justify-content-center">
                        <div class="col-lg-11 col-md-12 col-12 mt-5  ">

                            <div class="card">


                                <div class="table-responsive text-nowrap mt-5 ">


                                    <table class="table card-table">
                                        <thead>
                                            <tr class="text-nowrap">
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Code</th>
                                                <th>Status</th>

                                                <th></th>

                                            </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                            @foreach ($subjects as $subject)
                                                <tr>
                                                    <td>{{ $subject->id }}</td>
                                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                                        <strong>{{ $subject->name }}</strong>
                                                    </td>
                                                    <td>{{ $subject->code }}</td>
                                                    <td><span>
                                                            @if ($subject->status == 0)
                                                                <span class="badge bg-label-danger me-1">Not
                                                                    Active</span>
                                                            @elseif ($subject->status == 1)
                                                                <span class="badge bg-label-success me-1">Active</span>
                                                            @endif
                                                        </span></td>

                                                    <td style="text-align: right;">
                                                        <form action="{{ route('student.class.subject.new.exam') }}"
                                                            method="GET">
                                                            @csrf
                                                            <button class="btn btn-primary"
                                                                style="margin-right: 180px;">Show New Exam</button>
                                                            <input type="hidden" name="subject_id"
                                                                value="{{ $subject->id }}" />
                                                        </form>
                                                        <form action="{{ route('student.subject.my.exam') }}"
                                                            method="GET">
                                                            @csrf
                                                            <button class="btn btn-success"
                                                                style="margin-top:-64px;">Show My Exam</button>
                                                            <input type="hidden" name="subject_id"
                                                                value="{{ $subject->id }}" />
                                                        </form>

                                                    </td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <div class="d-flex justify-content-center flex-wrap mt-5">
                                        <div class="col-md-5 col-lg-4 mb-3 mx-3">
                                            <div class="card h-60">
                                                <p class="card-text">
                                                    <span class="badge bg-label-danger me-1"
                                                        style=" display: flex;
                                    justify-content: center;
                                    align-items: center;">No
                                                        Data</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                @endif
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
