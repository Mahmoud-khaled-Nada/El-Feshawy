@extends('AdminPanel.app')
@section('content')

    <div class="row mt-5">
        <div class="col-md-4 col-sm-6 col-12">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex align-items-center flex-row" style="position: relative;">
                        <div class="d-flex align-items-center">
                            <div class="border border-primary grd-primary-light rounded-4 p-3">
                                <i class="bi bi-person-check text-primary fs-3 lh-1"></i>
                            </div>
                            <div class="mx-3">
                                <h3 class="m-0"> {{ \App\Models\User::count() }}</h3>
                                <p class="m-0 text-primary">Admins</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex align-items-center flex-row" style="position: relative;">
                        <div class="d-flex align-items-center">
                            <div class="border border-primary grd-primary-light rounded-4 p-3">
                                <i class="bi bi-people text-primary fs-3 lh-1"></i>
                            </div>
                            <div class="mx-3">
                                <h3 class="m-0"> {{ \App\Models\Employee::count() }}</h3>
                                <p class="m-0 text-primary">Employees</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex align-items-center flex-row" style="position: relative;">
                        <div class="d-flex align-items-center">
                            <div class="border border-primary grd-primary-light rounded-4 p-3">
                                <i class="bi bi-people-fill text-primary fs-3 lh-1"></i>
                            </div>
                            <div class="mx-3">
                                <h3 class="m-0"> {{ \App\Models\Customer::count() }}</h3>
                                <p class="m-0 text-primary">Customers</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-4 col-sm-6 col-12">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex align-items-center flex-row" style="position: relative;">
                        <div class="d-flex align-items-center">
                            <div class="border border-primary grd-primary-light rounded-4 p-3">
                                <i class="bi bi-list-task text-primary fs-3 lh-1"></i>
                            </div>
                            <div class="mx-3">
                                <h3 class="m-0"> {{ \App\Models\Task::count() }}</h3>
                                <p class="m-0 text-primary">All Tasks</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex align-items-center flex-row" style="position: relative;">
                        <div class="d-flex align-items-center">
                            <div class="border border-primary grd-primary-light rounded-4 p-3">
                                <i class="bi bi-people bi-list-task fs-3 lh-1"></i>
                            </div>
                            <div class="mx-3">
                                <h3 class="m-0">{{ \App\Models\Task::where('status', '=', 'pending')->count() }}</h3>
                                <p class="m-0 text-primary">Unfinished Tasks</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex align-items-center flex-row" style="position: relative;">
                        <div class="d-flex align-items-center">
                            <div class="border border-primary grd-primary-light rounded-4 p-3">
                                <i class="bi bi-list-task text-primary fs-3 lh-1"></i>
                            </div>
                            <div class="mx-3">
                                <h3 class="m-0">{{ \App\Models\Task::where('status', '=', 'done')->count() }}</h3>
                                <p class="m-0 text-primary">Done Tasks</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-4 col-sm-6 col-12">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex align-items-center flex-row" style="position: relative;">
                        <div class="d-flex align-items-center">
                            <div class="border border-primary grd-primary-light rounded-4 p-3">
                                <i class="bi bi-chat-square-dots text-primary fs-3 lh-1"></i>
                            </div>
                            <div class="mx-3">
                                <h3 class="m-0"> {{ \App\Models\Inquirie::count() }}</h3>
                                <p class="m-0 text-primary">All Inquiries</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex align-items-center flex-row" style="position: relative;">
                        <div class="d-flex align-items-center">
                            <div class="border border-primary grd-primary-light rounded-4 p-3">
                                <i class="bi bi-chat-square-dots fs-3 lh-1"></i>
                            </div>
                            <div class="mx-3">
                                <h3 class="m-0"> {{ \App\Models\Inquirie::where('status', '=', 'contact')->count() }}
                                </h3>
                                <p class="m-0 text-primary">Contact with me</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex align-items-center flex-row" style="position: relative;">
                        <div class="d-flex align-items-center">
                            <div class="border border-primary grd-primary-light rounded-4 p-3">
                                <i class="bi  bi-chat-square-dots text-primary fs-3 lh-1"></i>
                            </div>
                            <div class="mx-3">
                                <h3 class="m-0">{{ \App\Models\Inquirie::where('status', '=', 'appointment')->count() }}
                                </h3>
                                <p class="m-0 text-primary">Appointment request</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
