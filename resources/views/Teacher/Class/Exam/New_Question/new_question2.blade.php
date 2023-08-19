<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Add Subject</title>

    <meta name="description" content="" />

</head>

<body>

    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">


            @include('layouts.Teacher.Sidebar')

            <div class="layout-page ">

                @include('layouts.Teacher.Header')

                <div class="col-lg-6 mt-5 mx-auto">
                    <div class="card  mb-4">

                        {{-- message section --}}
                        @if (session('store_error_message'))
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                {{ session('store_error_message') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        {{-- end message section --}}
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Choose The Correct Answer</h5>

                        </div>
                        <div class="card-body">

                            @if (session('store_success_message'))
                                <div class="alert alert-success alert-dismissible" role="alert">
                                    {{ session('store_success_message') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <form method="POST" action="{{ route('teacher.exam.subject.new.question3') }}">
                                @csrf
                                
                                @for ($i = 1; $i <= $numberOfOptions; $i++)
                                <div>
                                    <strong><label class="form-check-label">{{ $answers[$i - 1] }}</label></strong>
                                    <input type="radio" id="answer{{ $i }}" name="answer"
                                        class="form-check-input" value="{{ $i }}"
                                        @if (old('answer') == $i) checked @endif required>
                                    <input type="hidden" name="all_answer[]" value="{{ $i }}:{{ $answers[$i - 1] }}">
                                    {{-- The above line will store the ID and value of the answer --}}
                                    @if ($i === 1 && session()->has('answerOption'))
                                        <span>{{ session('answerOption') }}</span>
                                    @endif
                                </div>
                            @endfor
        
                                <input name="name" type="hidden" value="{{ $name }}" />
                                <input name="description" type="hidden" value="{{ $description }}" />
                                <input name="mark" type="hidden" value="{{ $mark }}" />
                                <input name="subject_id" type="hidden" value="{{ $subject_id }}" />
                                <input type="hidden" name="exam_id" value="{{$exam_id}}" />
                                <input type="hidden" name="number_question" value="{{$number_questions}}"/>
                                <input type="hidden" name="level_question" value="{{$level_question}}"/>
                                
                                <br>

                                <button type="submit" class="btn btn-primary mt-2">Next</button>
                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
@include('layouts.Teacher.link')
