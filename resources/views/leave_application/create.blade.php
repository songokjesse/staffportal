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

                        <form>
                            @csrf
                        <div class="card mt-2 mb-3">
                            <div class="card-body">
                            @livewire('leave-input')
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="exampleInputEmail1" class="form-label">From Date :</label>
                                        <input type="date" class="form-control" name="start_date" required>
                                    </div>
                                    <div class="col">
                                        <label for="exampleInputEmail1" class="form-label">To Date :</label>
                                        <input type="date" class="form-control" name="end_date" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">My Duties Will be performed by :</label>
                                    <select name="duties_by_user_id" class="form-control">
                                        <option selected disabled></option>
                                        @foreach($users as $user)
                                        <option value="{{$user->id}}"> {{$user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="row mb-3">
                                    <label for="exampleInputEmail1" class="form-label">In Case Required can be reached on :</label>
                                    <div class="col">
                                        <label for="exampleInputEmail1" class="form-label">Phone</label>
                                        <input type="text" class="form-control" name="phone" >
                                    </div>
                                    <div class="col">
                                        <label for="exampleInputEmail1" class="form-label">Email</label>
                                        <input type="email" class="form-control" name="email">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">To be Recommended By (HOD) :</label>
                                    <select name="recommend_user_id" class="form-control">
                                        <option selected disabled></option>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}"> {{$user->name}}</option>
                                        @endforeach
                                    </select>
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

