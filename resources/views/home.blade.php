@extends('layouts.auth_dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
                <a href="{{route('leave_application.create')}}" class="btn btn-success btn-sm" ><i class="bi bi-journals"></i> Apply for Leave</a>
            </div>

            <h4>Leave Days</h4>
            <hr>
            <!-- Content Row -->
            <div class="row mt-3">

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                       Leave Days Available</div>
{{--                                    <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>--}}
                                    <ul class="list-group">
                                        @if($leave_days == null)
                                             <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                                        @endif
                                    @foreach($leave_days as $key => $days)
                                            <li class="list-group-item">
                                                <span>{{$key}} : {{$days}}  </span>
                                            </li>
                                    @endforeach
                                    </ul>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <h4>History</h4>
            <hr>
            <!-- Content Row -->
            <div class="row mt-3">

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Leave Applications</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$history['application_count']}}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Rejected Leaves
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        @if($history['leave_rejections'] == null)
                                            0
                                        @else
                                            {{$history['leave_rejections']}}
                                        @endif
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pending Requests Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Approved Leaves
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        @if($history['approved_leaves']== null)
                                            0
                                        @else
                                            {{$history['approved_leaves']}}
                                        @endif

                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-comments fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Row -->
{{--            <div class="card">--}}
{{--                <div class="card-header">{{ __('Dashboard') }}</div>--}}

{{--                <div class="card-body">--}}
{{--                    @if (session('status'))--}}
{{--                        <div class="alert alert-success" role="alert">--}}
{{--                            {{ session('status') }}--}}
{{--                        </div>--}}
{{--                    @endif--}}


{{--                </div>--}}
{{--            </div>--}}
        </div>
    </div>
</div>
@endsection
