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
                                <th>User</th>
                                <th>Leave</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($recommendations as $recommendation )
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$recommendation->user->name}}</td>
                                    <td>{{$recommendation->leave_application->leave_category->name}}</td>
                                    <td>
                                        <a href="{{route('leave_recommendation.show', $recommendation->id)}}" class="btn btn-sm btn-primary">Recommend</a>
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

