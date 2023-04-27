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

                            <form method="POST" action="{{route('holidays.store')}}">
                            @csrf
                            @method('POST')

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
                                    <label for="name" class="form-label">Date</label>
                                    <input value="{{ old('date') }}"
                                           type="date"
                                           class="form-control"
                                           name="date"
                                           placeholder="Date" required>

                                    @if ($errors->has('date'))
                                        <span class="text-danger text-left">{{ $errors->first('date') }}</span>
                                    @endif
                                </div>

{{--                                <div class="mb-3">--}}
{{--                                        <label for="date">Date</label>--}}
{{--                                        <input type="text" name="date" id="date" class="form-control datepicker" required>--}}
{{--                                </div>--}}
                            <button type="submit" class="btn btn-primary">Save Holiday</button>
                            </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{--@push('script')--}}
{{--    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>--}}
{{--    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">--}}

{{--    <script>--}}
{{--        const date = new Date();--}}
{{--        let day = date.getDate();--}}
{{--        let month = date.getMonth() + 1;--}}
{{--        let year = date.getFullYear();--}}
{{--        let currentDate = `${day}-${month}-${year}`;--}}

{{--        $(document).ready(function () {--}}
{{--            $('.datepicker').datepicker({--}}
{{--                format: 'dd-mm-yyyy',--}}
{{--                todayHighlight: true,--}}
{{--                autoclose: true,--}}
{{--                clearBtn: true,--}}
{{--                daysOfWeekDisabled: '06',--}}
{{--                startDate: currentDate--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
{{--@endpush--}}


