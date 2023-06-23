<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Questions Exam</title>

    <meta name="description" content="" />

</head>

<body>

    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">


            @include('layouts.Teacher.Sidebar')

            <div class="layout-page ">

                @include('layouts.Teacher.Header')

                <div class="col-lg-10 mt-5 mx-auto">
                    <div class="card  mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Questions Exam:</h5>

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

                            {{-- end message success --}}   
                           
                            <div class="d-flex justify-content-end">
                                <div class="col-md-2">
                                    <label class="form-label" for="basic-icon-default-company">Your Mark From <strong>({{$exam_mark}})</strong></label>
                                    <div class="input-group input-group-merge">
                                        @php
                                            $studentMark = 0;
                                        @endphp
                                        @foreach ($questions as $question)
                                            @php
                                                $trueAnswer = $question->true_answer;
                                                $studentAnswer = isset($exam_student[0]->question_answer_student) ? json_decode($exam_student[0]->question_answer_student) : null;
                                                $selectedAnswer = $studentAnswer && isset($studentAnswer->{$question->id}) ? $studentAnswer->{$question->id} : null;
                            
                                                if ($selectedAnswer == $trueAnswer) {
                                                    $studentMark += $question->mark;
                                                }
                                            @endphp
                                        @endforeach
                                        <input type="text" id="basic-icon-default-company" class="form-control" aria-label="ACME Inc."
                                            aria-describedby="basic-icon-default-company2" name="student_mark" value="{{ $studentMark }}" readonly />
                                    </div>
                                </div>
                            </div>
                            @foreach ($questions as $question)
                                <div class="mb-3">
                                    <h5>Name: {{ $question->name }}</h5>
                                    <label class="form-label" for="basic-icon-default-email">Description: {{ $question->description }}</label>
                            
                                    <div class="d-flex justify-content-end">
                                        <label class="form-label" for="basic-icon-default-email">Mark: {{ $question->mark }}</label>
                                    </div>
                            
                                    @php
                                        $trueAnswer = $question->true_answer;
                                        $studentAnswer = isset($exam_student[0]->question_answer_student) ? json_decode($exam_student[0]->question_answer_student) : null;
                                        $selectedAnswer = $studentAnswer && isset($studentAnswer->{$question->id}) ? $studentAnswer->{$question->id} : null;
                                    @endphp
                            
                                    @foreach (json_decode($question->answer) as $key => $value)
                                        <div class="form-check mt-3">
                                            <input name="student_answer[{{ $question->id }}]" class="form-check-input" type="radio" value="{{ $key }}" id="defaultRadio{{ $loop->parent->index }}-{{ $loop->index }}" {{ $selectedAnswer == $key ? 'checked' : '' }} disabled />
                                            <label class="form-check-label {{ $key == $trueAnswer ? 'text-success' : 'text-danger' }}" for="defaultRadio{{ $loop->parent->index }}-{{ $loop->index }}">
                                                {{ $value }}
                                            </label>
                                        </div>
                                    @endforeach
                                    <h5>------------------------------------------------------------------------</h5>
                                </div>
                            @endforeach
                            
                        


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
@include('layouts.Teacher.link')
