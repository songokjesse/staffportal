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
                            <a href="{{route('roles.index')}}" class="btn btn-success btn-sm" ><i class="bi bi-house-add"></i> Roles</a>
                            <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-info btn-sm">Edit</a>
                        </div>

                            <div class="bg-light p-4 rounded">
                                <h1>{{ ucfirst($role->name) }} Role</h1>
                                <div class="lead">

                                </div>

                                <div class="container mt-4">

                                    <h3>Assigned permissions</h3>

                                    <table class="table table-striped">
                                        <thead>
                                        <th scope="col" width="20%">Name</th>
                                        <th scope="col" width="1%">Guard</th>
                                        </thead>

                                        @foreach($rolePermissions as $permission)
                                            <tr>
                                                <td>{{ $permission->name }}</td>
                                                <td>{{ $permission->guard_name }}</td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>

                            </div>
                            <div class="mt-4">
                                <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-info">Edit</a>
                                <a href="{{ route('roles.index') }}" class="btn btn-default">Back</a>
                            </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

