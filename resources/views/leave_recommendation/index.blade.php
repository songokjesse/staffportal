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

                        <table class="mt-2 mt-3 table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Leave</th>
                                <th>Days Applied</th>
                                <th>Left In-charge</th>
                                <th>From</th>
                                <th>To</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($recommendations as $recommendation )
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$recommendation->applicant_name}}</td>
                                    <td>{{$recommendation->leave_category}}</td>
                                    <td>{{$recommendation->days}}</td>
                                    <td>{{$recommendation->left_in_charge}}</td>
                                    <td>{{$recommendation->start_date}}</td>
                                    <td>{{$recommendation->end_date}}</td>
                                    <td>
                                        <a href="{{route('leave_recommendation.recommended', $recommendation->id)}}" class="btn btn-sm btn-primary">Recommend</a>
                                        <a href="{{route('leave_recommendation.not_recommended', $recommendation->id)}}" class="btn btn-sm btn-danger">Not Recommended</a>
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

