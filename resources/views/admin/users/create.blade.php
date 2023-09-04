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
                        <h2>{{ __('Users') }}</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
                            <a href="{{route('users.index')}}" class="btn btn-success btn-sm" ><i class="bi bi-person-add"></i> Users</a>
                        </div>

                            <form method="POST" action="{{route('users.store')}}">
                                @csrf
                                @method('POST')
                                <div class="mb-3">
                                    <label for="name" class="form-label">Job Title</label>
                                   <select name="job_title_id" class="form-control job_title" required>
                                       <option selected disabled> Select Job Title</option>
                                       @foreach($job_titles as $title)
                                           <option value="{{$title->id}}">{{$title->name}}</option>
                                       @endforeach
                                   </select>

                                    @if ($errors->has('job_title_id'))
                                        <span class="text-danger text-left">{{ $errors->first('job_title_id') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input value="{{ old('name') }}"
                                           type="text"
                                           class="form-control"
                                           name="name"
                                           placeholder="Name" required>

                                    @if ($errors->has('name'))
                                        <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input value="{{ old('email') }}"
                                           type="email"
                                           class="form-control"
                                           name="email"
                                           placeholder="Email address" required>
                                    @if ($errors->has('email'))
                                        <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input value="{{ old('phone') }}"
                                           type="text"
                                           class="form-control"
                                           name="phone"
                                           placeholder="Phone Number" required>
                                    @if ($errors->has('phone'))
                                        <span class="text-danger text-left">{{ $errors->first('phone') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">PF Number</label>
                                    <input value="{{ old('pf') }}"
                                           type="text"
                                           class="form-control"
                                           name="pf"
                                           placeholder="PF Number" required>
                                    @if ($errors->has('pf'))
                                        <span class="text-danger text-left">{{ $errors->first('pf') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Department</label>
                                    <select
                                           class="form-control"
                                           name="department_id"
                                          required
                                    >
                                        <option selected disabled> Select Department</option>
                                        @foreach($departments as $department)
                                            <option value="{{$department->id}}"> {{$department->name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('department_id'))
                                        <span class="text-danger text-left">{{ $errors->first('department_id') }}</span>
                                    @endif
                                </div>

                                <button type="submit" class="btn btn-primary">Save user</button>
                                <a href="{{ route('users.index') }}" class="btn btn-default">Back</a>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />    <script>
        $(document).ready(function () {

            $('.job_title').select2({
                theme: "bootstrap-5"
            });
        });

    </script>
