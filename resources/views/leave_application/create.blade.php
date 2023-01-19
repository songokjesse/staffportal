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
                        <h2>{{ __('Leave Application') }}</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
                            <a href="{{route('leave_application.index')}}" class="btn btn-success btn-sm" ><i class="bi bi-journals"></i> My Leave</a>
                        </div>

                        <form action="{{route('leave_application.store')}}" method="POST">
                            @csrf
                        <div class="card mt-2 mb-3">
                            <div class="card-body">
                            @livewire('leave-input')
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="exampleInputEmail1" class="form-label">From Date :</label>
                                        <input type="date" class="form-control @error('start_date') is-invalid @enderror " name="start_date">
                                        @error('start_date')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="exampleInputEmail1" class="form-label">To Date :</label>
                                        <input type="date" class="form-control @error('end_date') is-invalid @enderror" name="end_date" >
                                        @error('end_date')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">My Duties Will be performed by :</label>
                                    <select name="duties_by_user_id" class="form-control @error('duties_by_user_id') is-invalid @enderror">
                                        <option selected disabled></option>
                                        @foreach($users as $user)
                                        <option value="{{$user->id}}"> {{$user->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('duties_by_user_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row mb-3">
                                    <label for="exampleInputEmail1" class="form-label">In Case Required can be reached on :</label>
                                    <div class="col">
                                        <label for="exampleInputEmail1" class="form-label">Phone</label>
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror " name="phone" >
                                        @error('phone')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="exampleInputEmail1" class="form-label">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email">
                                        @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">To be Recommended By (HOD) :</label>
                                    <select name="recommend_user_id" class="form-control @error('recommend_user_id') is-invalid @enderror ">
                                        <option selected disabled></option>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}"> {{$user->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('recommend_user_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

