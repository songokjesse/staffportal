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

                        <form action="{{route('leave_application.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                        <div class="card mt-2 mb-3">
                            <div class="card-body">
                            @livewire('leave-input')
                                <div class="row mb-3">
                                    <div class="col">
                                        <label class="form-label" for="specificSizeInputGroupUsername">Start Date</label>
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="bi bi-calendar"></i></div>
                                            <input type="text" class="form-control datepicker @error('start_date') is-invalid @enderror" name="start_date" value="{{ old('start_date') }}" required >
                                        </div>
                                        @error('start_date')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        @error('days')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label class="form-label" for="specificSizeInputGroupUsername">End Date</label>
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="bi bi-calendar"></i></div>
                                            <input type="text" class="form-control datepicker @error('end_date') is-invalid @enderror" name="end_date" value="{{ old('end_date') }}" required >
                                        </div>
                                        @error('end_date')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        @error('days')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">My Duties Will be performed by :</label>
                                    <select name="duties_by_user_id" class="form-control @error('duties_by_user_id') is-invalid @enderror js-example-basic-single">
                                        <option selected disabled></option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" {{ old('recommend_user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
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
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror " name="phone"  value="{{ old('phone') }}">
                                        @error('phone')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="exampleInputEmail1" class="form-label">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
                                        @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">To be Recommended By (HOD) :</label>
                                    @if($recommenders == null)
                                        <select name="recommend_user_id" class="form-control @error('recommend_user_id') is-invalid @enderror hod">
                                            <option selected disabled></option>
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}" {{ old('recommend_user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    @else
                                        <select name="recommend_user_id" class="form-control @error('recommend_user_id') is-invalid @enderror ">
                                            <option selected disabled></option>
                                            @foreach($recommenders as $user)
                                                <option value="{{ $user->id }}" {{ old('recommend_user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    @endif

                                    @error('recommend_user_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <hr class="mt-2  ">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Upload Documents or Evidence to Support your Leave Application:</label>
                                    <input  name="leave_document"  type="file" class="form-control @error('leave_document') is-invalid @enderror ">

                                    @error('leave_document')
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

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />    <script>
        $(document).ready(function () {
            $('.datepicker').datepicker({
                format: 'yyyy/mm/dd',
                todayHighlight: true,
                startDate: new Date(),
                autoclose: true,
                daysOfWeekDisabled: '06',
                clearBtn: true,
                // multidate: true,
            });
            $('.js-example-basic-single').select2({
                theme: "bootstrap-5"
            });
            $('.hod').select2({
                theme: "bootstrap-5"
            });
        });

    </script>

@endsection

