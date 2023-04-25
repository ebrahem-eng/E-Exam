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


            @include('layouts.Teacher.Sidebar')

            <div class="layout-page ">

                @include('layouts.Teacher.Header')

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
                                        <strong>{{ $subject->name }}</strong></td>
                                    <td>{{ $subject->code }}</td>
                                    <td><span>
                                            @if ($subject->status == 0)
                                                <span class="badge bg-label-danger me-1">Not Active</span>
                                            @elseif ($subject->status == 1)
                                                <span class="badge bg-label-success me-1">Active</span>
                                            @endif
                                        </span></td>
                                  
                                    <td style="text-align: right;">
                                        <form action="{{route('teacher.question.subject')}}" method="GET">
                                            @csrf
                                            <button class="btn btn-primary" style="margin-right: 150px;">Add Question</button>
                                            <input type="hidden" name="subject_id" value="{{$subject->id}}" />
                                        </form>
                                       <form action="" method="GET">
                                        @csrf
                                        <button class="btn btn-success" style="margin-top:-64px;">Add Exam</button>
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
