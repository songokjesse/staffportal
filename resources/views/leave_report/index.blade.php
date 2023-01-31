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
                        <h2>{{ __('Leave Report') }}</h2>

                        <a href="{{route('leave_calendar')}}" class="btn btn-primary btn-sm"> <i class="bi bi-calendar"></i> Calendar View</a>

                        

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

