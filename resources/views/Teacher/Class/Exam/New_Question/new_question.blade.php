<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Add Question</title>

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
                            <h5 class="mb-0">Question Details</h5>

                        </div>
                        <div class="card-body">

                            @if (session('store_success_message'))
                                <div class="alert alert-success alert-dismissible" role="alert">
                                    {{ session('store_success_message') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <form method="get" action="{{ route('teacher.exam.subject.new.question2') }}">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label" for="option">Name Question</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"></span>
                                        <input type="text" class="form-control phone-mask" name="name"
                                             required />
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="option">Mark Question</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"></span>
                                        <input type="number" class="form-control phone-mask" name="mark"
                                             required />
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="exampleFormControlSelect1" class="form-label">Level Question</label>
                                    <select class="form-select" name="level_question" 
                                        aria-label="Default select example">
                                        <option selected>Open this select menu</option>
                                        <option value="0">Easy</option>
                                        <option value="1">Medium</option>
                                        <option value="2">Difficult</option>
                                    </select>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label" for="option">Description Question</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"></span>
                                        <input type="text" class="form-control phone-mask" name="description"
                                             required />
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="exampleFormControlSelect1" class="form-label">Number Answer</label>
                                    <select class="form-select" name="number_of_options" id="number-of-options"
                                        aria-label="Default select example">
                                        <option selected>Open this select menu</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                        <option value="4">Four</option>
                                        <option value="5">Five</option>
                                    </select>
                                </div>

                                <div id="options-container">
                                    <div class="mb-3">
                                        <label class="form-label" for="option">Answer</label>
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text"></span>
                                            <input type="text" class="form-control phone-mask" name="answer_1"
                                                id="answer_1" required />
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" name="subject_id" value="{{$subject_id}}" />
                                <input type="hidden" name="exam_id" value="{{$exam_id}}" />
                                <input type="hidden" name="number_question" value="{{$number_questions}}"/>

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

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const select = document.getElementById("number-of-options");
        const optionsContainer = document.getElementById("options-container");

        select.addEventListener("change", function() {
            optionsContainer.innerHTML = "";

            for (let i = 0; i < select.value; i++) {
                const label = document.createElement("label");
                const labelText = document.createTextNode(`Answer ${i + 1}: `);
                label.appendChild(labelText);

                const input = document.createElement("input");
                input.setAttribute("type", "text");
                input.setAttribute("name", `answer_${i + 1}`);
                input.setAttribute("id", `answer_${i + 1}`);
                input.setAttribute("required", "");
                input.setAttribute("class", "form-control phone-mask");

                label.appendChild(input);
                optionsContainer.appendChild(label);
                optionsContainer.appendChild(document.createElement("br"));
            }
        });
    });
</script>
