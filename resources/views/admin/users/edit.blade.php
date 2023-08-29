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

                            <form method="post" action="{{ route('users.update', $user->id) }}">
                                @method('patch')
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Job Title</label>
                                    <select name="job_title_id" class="form-control" required>
                                        <option selected disabled> Select Job Title</option>
                                        @foreach($job_titles as $title)
                                            <option value="{{$title->id}}">{{$title->name}}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('job_title_id'))
                                        <span class="text-danger text-left">{{ $errors->first('job_title_id') }}</span>
                                    @endif
                                </div>
                                <div >
                                    <label for="name" class="form-label">Name</label>
                                    <input value="{{ $user->name }}"
                                           type="text"
                                           class="form-control"
                                           name="name"
                                           placeholder="Name" required>

                                    @if ($errors->has('name'))
                                        <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div >
                                    <label for="email" class="form-label">Email</label>
                                    <input value="{{ $user->email }}"
                                           type="email"
                                           class="form-control"
                                           name="email"
                                           placeholder="Email address" required>
                                    @if ($errors->has('email'))
                                        <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                                <div >
                                    <label for="username" class="form-label">Phone Number</label>
                                    <input value="{{ $user->phone }}"
                                           type="text"
                                           class="form-control"
                                           name="phone"
                                           placeholder="Phone Number" required>
                                    @if ($errors->has('phone'))
                                        <span class="text-danger text-left">{{ $errors->first('phone') }}</span>
                                    @endif
                                </div>
                                <div >
                                    <label for="username" class="form-label">PF Number</label>
                                    <input value="{{ $user->pf }}"
                                           type="text"
                                           class="form-control"
                                           name="pf"
                                           placeholder="PF Number" required>
                                    @if ($errors->has('pf'))
                                        <span class="text-danger text-left">{{ $errors->first('pf') }}</span>
                                    @endif
                                </div>
                                <div >
                                    <label for="role" class="form-label">Role</label>
                                    <select class="form-control"
                                            name="role" required>
                                        <option value="">Select role</option>
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}"
                                                    {{ in_array($role->name, $userRole)
                                                        ? 'selected'
                                                        : '' }}>{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('role'))
                                        <span class="text-danger text-left">{{ $errors->first('role') }}</span>
                                    @endif
                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary">Update user</button>
                                    <a href="{{ route('users.index') }}" class="btn btn-default">Cancel</a>

                                </div>

                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

