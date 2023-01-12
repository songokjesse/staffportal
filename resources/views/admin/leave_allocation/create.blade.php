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
                        <h2>{{ __('Leave Allocation') }}</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
                            <a href="{{route('leave_allocation.index')}}" class="btn btn-success btn-sm" ><i class="bi bi-journals"></i> Leave Allocations</a>
                        </div>
                        <form action="{{route('leave_allocation.store')}}" method="POST">
                            @csrf
                            @method('POST')
                            <div class="card mt-2">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Name</label>
                                        <select class="form-control" name="user_id">
                                            <option disabled selected></option>
                                            @foreach($users as $user)
                                                <option value="{{$user->id}}">{{$user->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Leave Category</label>
                                        <select class="form-control" name="leave_categories_id">
                                            <option disabled selected></option>
                                            @foreach($leave_categories as $leave_category)
                                                <option value="{{$leave_category->id}}">{{$leave_category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Days Allocated</label>
                                        <input type="number" class="form-control" name="days" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Year</label>
                                        <select class="form-control" name="year">
                                            <option disabled selected></option>
                                            <option>2023</option>
                                            <option>2022</option>
                                            <option>2021</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="card-footer">
                                   <button class="btn btn-primary btn-sm">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

