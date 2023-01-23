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
                        <h2>{{ __('Leave Recommendation') }}</h2>

                        <table class="mt-2 mt-3 table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Leave</th>
                                <th>Days Applied</th>
                                <th>Left In-charge</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($recommendations as $recommendation )
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$recommendation->applicant_name}}</td>
                                    <td>{{$recommendation->leave_category}}</td>
                                    <td>{{$recommendation->days}}</td>
                                    <td>{{$recommendation->left_in_charge}}</td>
                                    <td>{{$recommendation->start_date}}</td>
                                    <td>{{$recommendation->end_date}}</td>
                                    <td>
                                        <form action="{{ route('leave_recommendation.recommended',$recommendation->id) }}" method="Post" style='display:inline'>
                                            @csrf
                                            <button class="btn btn-sm btn-success">Recommended</button>
                                        </form>

                                        <form action="{{ route('leave_recommendation.not_recommended',$recommendation->id) }}" method="Post" style='display:inline'>
                                            @csrf
                                            <button class="btn btn-sm btn-danger">Not Recommended</button>
                                        </form>
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

{{--@section('scripts')--}}
{{--    <script type="text/javascript">--}}
{{--        import swal from 'sweetalert';--}}
{{--        window.deleteConfirm = function (e) {--}}
{{--            e.preventDefault();--}}
{{--            var form = e.target.form;--}}
{{--            swal({--}}
{{--                title: "Are you sure you want to delete?",--}}
{{--                icon: "warning",--}}
{{--                buttons: true,--}}
{{--                dangerMode: true,--}}
{{--            })--}}
{{--                .then((willDelete) => {--}}
{{--                    if (willDelete) {--}}
{{--                        form.submit();--}}
{{--                    }--}}
{{--                });--}}
{{--        }--}}
{{--    </script>--}}
{{--@endsection--}}