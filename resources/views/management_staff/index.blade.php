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
                        <h2>{{ __('Management Staff') }}</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
                            <a href="{{route('management_categories.index')}}" class="btn btn-success btn-sm" ><i class="bi bi-house-add"></i> Management Categories</a>
                        </div>
                        {{--TODO--}}
                        {{--show validation msgs--}}

                               <div class="card mb-3">
                                <form action="{{route('management_staff.store')}}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <div class="card-body">
                                    <div class="mb-2">
                                        <label>User</label>
                                        <select class="form-control" name="user_id">
                                            <option selected disabled></option>
                                            @foreach($users as $id => $name)
                                                <option value="{{ $id }}">{{ $name }}</option>
                                            @endforeach
                                        </select>
                                        @error('user_id')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="mb-2">
                                        <label>
                                        Management Category
                                        </label>
                                        <select class="form-control" name="management_category_id">
                                            <option selected disabled></option>
                                        @foreach($management_categories as $id => $name)
                                                <option value="{{ $id }}">{{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-2">
                                        <label>
                                            Department
                                        </label>
                                        <select class="form-control" name="department_id">
                                            <option selected disabled></option>
                                                    @foreach($departments as $id => $name)
                                                        <option value="{{ $id }}">{{ $name }}</option>
                                                    @endforeach
                                            </select>
                                    </div>
                                  </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                                    </div>
                                </form>

                            </div>

                        <table class="table table-responsive table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Staff Name</th>
                                <th>Management Category</th>
                                <th>Department</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($management_staff as $man_staff)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$man_staff->user->name}}</td>
                                    <td>{{$man_staff->management_category->name}}</td>
                                    <td>{{$man_staff->department->name}}</td>
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

