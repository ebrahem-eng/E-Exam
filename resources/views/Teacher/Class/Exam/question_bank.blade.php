<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Choose Question</title>

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

                            {{-- end message section --}}

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
                                                        {{ $key }}: {{ $answer }}
                                                        <br>
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

                                                <td style="text-align: right;">
                                                    <form action="{{ route('teacher.exam.choose.question') }}"
                                                        method="GET">
                                                        @csrf
                                                        <button class="btn btn-primary"
                                                            style="margin-right: 150px;">Choose</button>
                                                        <input type="hidden" name="question_id"
                                                            value="{{ $question_detail->id }}" />
                                                        <input type="hidden" name="subject_id"
                                                            value="{{ $subject_id }}" />
                                                        <input type="hidden" name="exam_question_number"
                                                            value="{{ $exam_question_number }}" />
                                                        <input type="hidden" name="exam_id"
                                                            value="{{ $exam_id }}" />
                                                        <input type="hidden" name="number_question"
                                                            value="{{ $number_questions }}" />

                                                    </form>

                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <br><br>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
@include('layouts.Teacher.link')
