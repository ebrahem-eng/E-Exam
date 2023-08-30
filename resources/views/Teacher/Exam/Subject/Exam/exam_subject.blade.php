<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Exam Table</title>

    <meta name="description" content="" />

</head>

<body>

    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">


            @include('layouts.Teacher.Sidebar')

            <div class="layout-page ">

                @include('layouts.Teacher.Header')

                <div class="d-flex justify-content-center">
                    <div class="col-lg-11 col-md-12 col-12 mt-5  ">

                        <div class="card">
                              {{-- message section --}}
                              @if (session('error_message'))
                              <div class="alert alert-danger alert-dismissible" role="alert">
                                  {{ session('error_message') }}
                                  <button type="button" class="btn-close" data-bs-dismiss="alert"
                                      aria-label="Close"></button>
                              </div>
                          @endif

                          {{-- end message success --}}

                            <div class="table-responsive text-nowrap mt-5 ">
                                <table class="table card-table">
                                    <thead>
                                        <tr class="text-nowrap">
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Exam Time</th>
                                            <th>Exam Mark</th>
                                            <th>Number Of Question</th>
                                            <th>Teacher Name</th>
                                            <th>Created Date</th>
                                            <th>Status</th>
                                            <th></th>

                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        @foreach ($exams as $exam)
                                            <tr>
                                                <td>{{ $exam->exam_id }}</td>
                                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                                    <strong>{{ $exam->exam_name }}</strong>
                                                </td>
                                                <td>({{ $exam->exam_time }}) Min</td>
                                                <td>{{ $exam->exam_mark }}</td>
                                                <td>{{ $exam->number_question }}</td>
                                                <td>{{ $exam->teacher_name }}</td>
                                                <td>{{ $exam->created_at }}</td>
                                                <td><span>
                                                        @if ($exam->exam_status == 0)
                                                            <span class="badge bg-label-danger me-1">Not Active</span>
                                                        @elseif ($exam->exam_status == 1)
                                                            <span class="badge bg-label-success me-1">Active</span>
                                                        @endif
                                                    </span></td>

                                                <td>
                                                    <form action="{{route('teacher.exam.subject.exam.student')}}" method="GET">
                                                        @csrf
                                                        <button class="btn btn-primary">Show Student</button>
                                                        <input type="hidden" name="exam_id" value="{{$exam->exam_id}}" />
                                                    </form>
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
@include('layouts.Teacher.link')
