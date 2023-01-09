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
                        <h2>{{ __('Leave Category') }}</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
                            <a href="{{route('leaveCategory.create')}}" class="btn btn-success btn-sm" ><i class="bi bi-journals"></i> Add Leave Category</a>
                        </div>

                            <table class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
{{--                                    <th>Days</th>--}}
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($leave_category as $category)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$category->name}}</td>
{{--                                        <td>{{$category->days}}</td>--}}
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

