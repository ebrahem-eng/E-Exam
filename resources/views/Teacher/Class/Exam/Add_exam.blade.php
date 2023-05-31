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

                <div class="col-lg-6 mt-5 mx-auto">
                    <div class="card  mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Create Exam</h5>

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

                            {{-- end message section --}}


                            <form method="get" action="{{ route('teacher.exam2.subject') }}">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label" for="option">Title Exam</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"></span>
                                        <input type="text" class="form-control phone-mask" name="title_exam"
                                            required />
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="option">Mark Exam</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"></span>
                                        <input type="number" class="form-control phone-mask" name="mark_exam"
                                            required />
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="option">Time Of Exam (Minutes)</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"></span>
                                        <input type="number" class="form-control phone-mask" name="time_exam"
                                            required />
                                    </div>

                                </div>

                                <div class="mb-3">
                                    <label for="exampleFormControlSelect1" class="form-label">Status Exam</label>
                                    <select class="form-select" name="status_exam" id="number-of-options"
                                        aria-label="Default select example">
                                        <option selected>Open this select menu</option>
                                        <option value="1">Active</option>
                                        <option value="0">Not Active</option>
                                    </select>
                                </div>

                                <div id="options-container">
                                    <div class="mb-3">
                                        <label class="form-label" for="option">Number Of Question in Exam </label>
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text"></span>
                                            <input type="number" class="form-control phone-mask" name="number_question"
                                                id="answer_1" required />
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" name="subject_id" value="{{ $subject_id }}" />

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
