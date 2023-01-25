@extends('layouts.auth_dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <h2>{{ __('Leave') }}</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
                            <a href="{{route('leave_application.create')}}" class="btn btn-success btn-sm" ><i class="bi bi-journals"></i> Apply for Leave</a>
                        </div>

                        <table class="mt-2 mt-3 table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Leave</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Days</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($leaves as $leave )
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$leave->leave_category->name}}</td>
                                <td>{{$leave->start_date}}</td>
                                <td>{{$leave->end_date}}</td>
                                <td>{{$leave->days}}</td>
                                <td>
                                    @if($leave->state === "Application")
                                        <span class="badge text-bg-warning"><i class="bi bi-arrow-repeat"></i> Application </span>
                                    @endif
                                    @if($leave->state === "Recommended")
                                        <span class="badge text-bg-success"><i class="bi bi-arrow-repeat"></i> Recommended</span>
                                    @endif
                                    @if($leave->state === "Not Recommended")
                                        <span class="badge text-bg-danger"><i class="bi bi-sign-stop"></i> Not Recommended</span>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-dark" href="{{route('leave_application.show', $leave->id)}}">Show</a>
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
@endsection

