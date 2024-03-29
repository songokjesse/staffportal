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
                            <h2>{{ __('Departments') }}</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
                        <a href="{{route('departments.create')}}" class="btn btn-success btn-sm" ><i class="bi bi-house-add"></i> Add Department</a>
                        <a href="{{route('assign_staff_to_department')}}" class="btn btn-info btn-sm" ><i class="bi bi-person-add"></i> Assign Staff to Departments</a>
                        </div>

                        <table class="table table-responsive table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($departments as $department)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$department->name}}</td>
                            <td>
                                <a href="{{route('departments.edit', $department->id)}}" class="btn btn-sm btn-outline-primary">Edit</a>
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

