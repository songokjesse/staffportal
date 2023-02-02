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
                        <h2>{{ __('Leave Application Approvals') }}</h2>

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
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($approvals as $approval )
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$approval->applicant_name}}</td>
                                    <td>{{$approval->leave_category}}</td>
                                    <td>{{$approval->days}}</td>
                                    <td>{{$approval->left_in_charge}}</td>
                                    <td>{{$approval->start_date}}</td>
                                    <td>{{$approval->end_date}}</td>
                                    <td>
                                        <form action="{{ route('leave_recommendation.recommended',$approval->id) }}" method="Post" style='display:inline'>
                                            @csrf
                                            <button class="btn btn-sm btn-success">Approved</button>
                                        </form>

                                        <form action="{{ route('leave_recommendation.not_recommended',$approval->id) }}" method="Post" style='display:inline'>
                                            @csrf
                                            <button class="btn btn-sm btn-danger">Not Approved</button>
                                        </form>
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
