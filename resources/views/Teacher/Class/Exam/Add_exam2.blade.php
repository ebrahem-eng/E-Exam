<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Add Exam</title>

    <meta name="description" content="" />

</head>

<body>

    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">


            @include('layouts.Teacher.Sidebar')

            <div class="layout-page ">

                @include('layouts.Teacher.Header')

                <div class="col-lg-9 mt-5 mx-auto">
                    <div class="card  mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Create Exam</h5>

                        </div>
                        <div class="card-body">

                            {{-- message section --}}

                            @if (session('error_message'))
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    {{ session('error_message') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            @if (session('success_message'))
                                <div class="alert alert-success alert-dismissible" role="alert">
                                    {{ session('success_message') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            {{-- end message section --}}

                            <div class="input-group input-group-merge">

                                <div class="col-lg-8">

                                    <div class="row">
                                        <div class="col-sm-7">


                                            <form action="{{ route('teacher.exam.subject.choose.question') }}"
                                                method="GET">
                                                @csrf
                                                <button class="btn btn-success">Choose From Question Bank</button>
                                                <input type="hidden" name="subject_id" value="{{ $subject_id }}" />
                                                <input type="hidden" name="exam_id" value="{{ $exam_id }}" />
                                                <input type="hidden" name="number_question"
                                                    value="{{ $number_questions }}" />
                                            </form>

                                        </div>
                                        <div class="col-sm-5">
                                            <form action="{{ route('teacher.exam.subject.new.question') }}"
                                                method="GET">
                                                @csrf
                                                <button class="btn btn-primary">Create New Question</button>
                                                <input type="hidden" name="exam_id" value="{{ $exam_id }}" />
                                                <input type="hidden" name="number_question"
                                                    value="{{ $number_questions }}" />
                                                <input type="hidden" name="subject_id" value="{{ $subject_id }}" />

                                            </form>
                                        </div>

                                    </div>

                                </div>

                            </div>
                            <br>
                            <div class="mb-3">
                                <label class="form-label" for="option">Questions :</label>
                                <div class="table-responsive text-nowrap mt-5 ">
                                <table class="table card-table">
                                    <thead>
                                        <tr class="text-nowrap">
                                            <th>#</th>
                                            <th>Name Question</th>
                                            <th>Question Level</th>
                                            <th>Answer</th>
                                            <th>True Answer</th>
                                            <th>Description</th>
                                            <th>Mark</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">

                                        @foreach ($question_details as $question_detail)
                                            <tr>
                                                <td>{{ $question_detail->id }}</td>
                                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                                    <strong>{{ $question_detail->name }}</strong>
                                                </td>

                                                 <td>
                                                    @if($question_detail->level == 0)
                                                    <strong>Easy</strong> 
                                                    @elseif($question_detail->level == 1)

                                                    <strong>Medium</strong> 

                                                    @elseif($question_detail->level == 2)

                                                    <strong>Difficult</strong>

                                                    @endif
                                                </td>
                                                
                                                <td>
                                                    @foreach (json_decode($question_detail->answer) as $key => $answer)
                                                        {{ $key }}: {{ $answer }}<br>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @foreach (json_decode($question_detail->answer) as $key => $answer)
                                                        @if ($question_detail->true_answer == $key)
                                                            {{ $answer }}
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>{{ $question_detail->description }}</td>
                                                <td>{{ $question_detail->mark }}</td>

                                                <td>
                                                    <form
                                                        action="{{ route('teacher.exam.question.delete', $question_detail->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btn-danger">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                </div>
                                <br> <br>
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <form method="get" action="{{ route('teacher.finish.exam.choose.question') }}">
                                        @csrf
                                        <input type="hidden" name="exam_id" value="{{$exam_id}}" >
                                        <button style="margin-left: 150px;" type="submit"
                                            class="btn btn-primary mt-2">Finish</button>
                                    </form>
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
@include('layouts.Teacher.link')
