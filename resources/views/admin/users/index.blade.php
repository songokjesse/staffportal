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
                        <h2>{{ __('Users') }}</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
                            <a href="{{route('users.create')}}" class="btn btn-success btn-sm" ><i class="bi bi-person-add"></i> Add User</a>
                        </div>
{{--                            Blade component--}}
                            <livewire:user-list />

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

