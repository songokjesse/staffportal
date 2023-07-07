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
                        <h2>{{ __('Management Staff Category') }}</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
                            <a href="{{route('management_categories.create')}}" class="btn btn-success btn-sm" ><i class="bi bi-house-add"></i> Add Management Categories</a>
                            <a href="{{route('management_staff.index')}}" class="btn btn-info btn-sm" ><i class="bi bi-person-add"></i> Assign Staff to Management</a>
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
                            @foreach($management_categories as $man_category)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$man_category->name}}</td>
                                    <td>
                                        <a href="{{route('management_categories.edit', $man_category->id)}}" class="btn btn-sm btn-outline-primary">Edit</a>
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

