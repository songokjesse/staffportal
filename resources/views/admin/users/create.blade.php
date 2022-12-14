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
                            <a href="{{route('users.index')}}" class="btn btn-success btn-sm" ><i class="bi bi-person-add"></i> Users</a>
                        </div>

                            <form method="POST" action="">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input value="{{ old('name') }}"
                                           type="text"
                                           class="form-control"
                                           name="name"
                                           placeholder="Name" required>

                                    @if ($errors->has('name'))
                                        <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input value="{{ old('email') }}"
                                           type="email"
                                           class="form-control"
                                           name="email"
                                           placeholder="Email address" required>
                                    @if ($errors->has('email'))
                                        <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input value="{{ old('phone') }}"
                                           type="text"
                                           class="form-control"
                                           name="phone"
                                           placeholder="Phone Number" required>
                                    @if ($errors->has('phone'))
                                        <span class="text-danger text-left">{{ $errors->first('phone') }}</span>
                                    @endif
                                </div>

                                <button type="submit" class="btn btn-primary">Save user</button>
                                <a href="{{ route('users.index') }}" class="btn btn-default">Back</a>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

