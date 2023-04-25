<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Teacher Subjects Table</title>

    <meta name="description" content="" />

</head>

<body>

    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">


            @include('layouts.Admin.Sidebar')

            <div class="layout-page ">

                @include('layouts.Admin.Header')

                <div class="d-flex justify-content-center">
                    <div class="col-lg-11 col-md-12 col-12 mt-5  ">

                        <div class="card">

                            <div class="card-header">

                                <h5>Subjects This Teacher</h5>
                                <div class="text-end">
                                    <form method="get" action="{{route('admin.create.subject.teacher')}}">
                                        @csrf
                                        <button class="btn btn-primary "> Add Subject For This Teacher </a>
                                            <input name="id" type="hidden" value="{{ $id }}" />
                                    </form>

                                </div>
                            </div>
                            <div class="table-responsive text-nowrap">

                                <table class="table card-table">
                                    <thead>
                                        <tr class="text-nowrap">
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Code</th>
                                            <th>Status</th>
                                            <th>Actions</th>
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
                                                            <span class="badge bg-label-danger me-1">Not Active</span>
                                                        @elseif ($subject->status == 1)
                                                            <span class="badge bg-label-success me-1">Active</span>
                                                        @endif
                                                    </span></td>


                                                <td>
                                                    <div class="dropdown">
                                                        <button type="button"
                                                            class="btn p-0 dropdown-toggle hide-arrow"
                                                            data-bs-toggle="dropdown">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                                    class="bx bx-edit-alt me-1"></i> Edit</a>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                                    class="bx bx-trash me-1"></i> Delete</a>

                                                        </div>
                                                    </div>
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
@include('layouts.Admin.link')
