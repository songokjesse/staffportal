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
                            <a href="{{route('leaveCategory.index')}}" class="btn btn-success btn-sm" ><i class="bi bi-journals"></i> Leave Category</a>
                        </div>

                            <hr class="mb-3"/>

                            <form action="{{route('leaveCategory.store')}}" method="POST">
                            @csrf
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Leave Category Name</label>
                                            <input type="text" name="name" class="form-control" placeholder="Category Name"  @error('name') is-invalid @enderror  value="{{ old('name') }}" required autocomplete="name">
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
{{--                                        <div class="form-group">--}}
{{--                                            <label>Days</label>--}}
{{--                                            <input type="number" name="days" class="form-control" placeholder="Leave Days"  @error('days') is-invalid @enderror  value="{{ old('days') }}" required autocomplete="days">--}}
{{--                                            @error('days')--}}
{{--                                            <span class="invalid-feedback" role="alert">--}}
{{--                                                <strong>{{ $message }}</strong>--}}
{{--                                            </span>--}}
{{--                                            @enderror--}}
{{--                                        </div>--}}
                                      <input type="hidden" name="days" class="form-control" placeholder="Leave Days" value="1">

                                    </div>

                                <div class="card-footer">
                                    <button class="btn btn-sm btn-primary" type="submit">Save</button>
                                </div>
                                </div>
                            </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

