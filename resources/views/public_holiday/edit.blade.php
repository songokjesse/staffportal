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
                        <h2>{{ __('Public Holidays') }}</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
                            <a href="{{route('holidays.index')}}" class="btn btn-success btn-sm" ><i class="bi bi-calendar"></i> Public Holidays</a>
                        </div>

                        <form method="POST" action="{{route('holidays.update', $holiday->id)}}">
                            @csrf
                            @method('PUT')
{{--                            {{dd($holiday)}}--}}
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input value="{{ $holiday->name  }}"
                                       type="text"
                                       class="form-control"
                                       name="name"
{{--                                       value="{{ $holiday->name ||  old('name') }}"--}}
                                       placeholder="Name" required>

                                @if ($errors->has('name'))
                                    <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Date</label>
                                <input value="{{ $holiday->date}}"
                                       type="date"
                                       class="form-control"
                                       name="date"
                                       placeholder="Date" required>

                                @if ($errors->has('date'))
                                    <span class="text-danger text-left">{{ $errors->first('date') }}</span>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary">Save Holiday</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



