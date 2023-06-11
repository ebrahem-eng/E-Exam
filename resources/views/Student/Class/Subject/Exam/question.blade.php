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


            @include('layouts.Student.Sidebar')

            <div class="layout-page ">

                @include('layouts.Student.Header')

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

                            @if (session('error_message'))
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                {{ session('error_message') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                            {{-- end message success --}}



                            <div class="d-flex justify-content-end">
                                <div class="col-md-2">
                                    <label class="form-label" for="basic-icon-default-company">Exam Time</label>
                                    <div class="input-group input-group-merge">
                                        <input type="text" id="basic-icon-default-company" class="form-control" aria-label="ACME Inc."
                                            aria-describedby="basic-icon-default-company2" name="exam_time" value="{{ $exam_time }}" readonly />
                                    </div>
                                </div>
                            </div>
                            
                            <script>
                                // Function to start the countdown
                                function startCountdown() {
                                    var examTime = parseInt('{{ $exam_time }}'); // Get the exam time in minutes
                                    var timerDisplay = document.getElementById('basic-icon-default-company');
                            
                                    var timer = setInterval(function () {
                                        if (examTime <= 0) {
                                            clearInterval(timer);
                                            timerDisplay.value = 'Time\'s Up!';
                                            calculateTimeAndSubmitForm(); // Call the function to calculate time and submit the form
                                        } else {
                                            var minutes = Math.floor(examTime);
                                            var seconds = (examTime % 1) * 60;
                                            timerDisplay.value = minutes + 'm ' + Math.round(seconds) + 's';
                                            examTime -= 1/60;
                                        }
                                    }, 1000);
                                }
                            
                                // Function to calculate time and submit the form
                                function calculateTimeAndSubmitForm() {
                                    var endTime = new Date();
                                    var startTime = new Date('{{ now() }}');
                                    var timeDifference = endTime - startTime;
                            
                                    // Convert time difference to minutes
                                    var timeInMinutes = Math.floor(timeDifference / 1000 / 60);
                            
                                    // Set the calculated time value in the hidden input field
                                    document.getElementById('time_taken').value = timeInMinutes;
                            
                                    // Submit the form
                                    document.getElementById('examForm').submit();
                                }
                            
                                // Call the startCountdown function when the page is loaded
                                window.addEventListener('load', startCountdown);
                            </script>

                            <form id="examForm" method="POST"
                                action="{{ route('student.subject.exam.answer.store') }}">
                                @csrf
                                @foreach ($questions as $question)
                                    <div class="mb-3">
                                        <h5>Name: {{ $question->name }}</h5>
                                        <label class="form-label" for="basic-icon-default-email">Description:
                                            {{ $question->description }}</label>

                                        <div class="d-flex justify-content-end">
                                            <label class="form-label" for="basic-icon-default-email">Mark:
                                                {{ $question->mark }}</label>
                                        </div>


                                        @foreach (json_decode($question->answer) as $key => $value)
                                            <div class="form-check mt-3">
                                                <input name="student_answer[{{ $question->id }}]"
                                                    class="form-check-input" type="radio" value="{{ $key }}"
                                                    id="defaultRadio{{ $loop->parent->index }}-{{ $loop->index }}" />
                                                <label class="form-check-label"
                                                    for="defaultRadio{{ $loop->parent->index }}-{{ $loop->index }}">
                                                    {{ $value }}
                                                </label>
                                            </div>
                                        @endforeach
                                        <h5>------------------------------------------------------------------------
                                        </h5>
                                    </div>
                                @endforeach
                                <input type="hidden" name="exam_id" value="{{ $exam_id }}" />
                                <!-- Hidden input field to store the time taken -->
                            

                                <button type="submit" class="btn btn-primary" onclick="calculateTime()">OK</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
@include('layouts.Student.link')
