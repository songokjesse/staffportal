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
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        <h2>{{ __('Assign Staff to Departments') }}</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
                            <a href="{{route('departments.index')}}" class="btn btn-success btn-sm" ><i class="bi bi-house-add"></i> Departments</a>
                        </div>

                        <hr/>
                            <form action="{{route('save_assigned_staff_to_department')}}" method="POST">
                                @csrf
                                @method('POST')
                                <div class="form-group">
                                <label> Users</label>
                                    <select name="user_id" class="form-control" required @error('user_id') is-invalid @enderror>
                                        <option selected disabled>--- Select User ---- </option>
                                    @foreach($users as $user)
                                       <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                <label>Departments</label>
                                    <select name="department_id" class="form-control" required @error('department_id') is-invalid @enderror>
                                        <option selected disabled>--- Choose Department --- </option>
                                        @foreach($departments as $department)
                                            <option value="{{$department->id}}">{{$department->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('department_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary btn-sm">Assign</button>
                                </div>
                            </form>

{{--                            <hr/>--}}

                        <table class="table table-responsive table-striped table-bordered mt-3">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Staff Name</th>
                                <th>Department</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($profiles as $profile)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$profile->user_name}}</td>
                                    <td>{{$profile->department_name}}</td>
                                    <td></td>
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

