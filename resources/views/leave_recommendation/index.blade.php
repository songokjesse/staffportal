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
                        <h2>{{ __('Leave Recommendation') }}</h2>

                        <table class="mt-2 mt-3 table table-striped table-bordered table-responsive">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Leave</th>
                                <th>Days Applied</th>
                                <th>Left In-charge</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Recommendation Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @if($recommendations == null)
                            @else
                                @foreach($recommendations as $recommendation )
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$recommendation->applicant_name}}</td>
                                        <td>{{$recommendation->leave_category}}</td>
                                        <td>{{$recommendation->days}}</td>
                                        <td>{{$recommendation->user_assigned_duties}}</td>
                                        <td>{{$recommendation->start_date}}</td>
                                        <td>{{$recommendation->end_date}}</td>
                                        <td>
                                            <div class="d-flex">
                                                <div>
                                                    <a href="{{route('leave_recommendation.recommend_view', $recommendation->leave_application_id)}}" class="btn btn-sm btn-success"><i class="bi bi-hand-thumbs-up"></i> Recommended</a>
                                                </div>
                                                <div class="ms-auto">
                                                    <a href="{{route('leave_recommendation.not_recommended_view', $recommendation->leave_application_id)}}" class="btn btn-sm btn-danger"><i class="bi bi-sign-stop"></i> Not Recommended</a>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                @endforeach
                            @endif

                            </tbody>
                        </table>



                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
