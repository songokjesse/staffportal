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
                        <h2>{{ __('Roles') }}</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
                            <a href="{{route('users.index')}}" class="btn btn-success btn-sm" ><i class="bi bi-house-add"></i> Users</a>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info btn-sm">Edit</a>
                        </div>

                            <div class="container mt-4">
                                <div>
                                    Name: {{ $user->name }}
                                </div>
                                <div>
                                    Email: {{ $user->email }}
                                </div>
                                <div>
                                    Phone Number: {{ $user->phone}}
                                </div>

                            </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

