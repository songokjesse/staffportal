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
                                <th></th>

                            </tr>
                            </thead>
                            <tbody>

                            @if($recommendations == null)
                            @else
                                @foreach($recommendations as $recommendation )
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$recommendation->applicant_name}}</td>
                                        <td>{{$recommendation->leave_category}}</td>
                                        <td>{{$recommendation->days}}</td>
                                        <td>{{$recommendation->start_date}}</td>
                                        <td>{{$recommendation->end_date}}</td>
                                        <td>
                                            <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#RecommendedModal">Recommended</button>
                                            <!-- Recommended Modal -->
                                            <div class="modal fade" id="RecommendedModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <form action="{{ route('leave_recommendation.recommended',$recommendation->id) }}" method="Post" style='display:inline'>
                                                    @csrf
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Recommended</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="mt-2">
                                                                    <label>To be Approved By : </label>
                                                                    <select name="user_id" required class="form-control">
                                                                        <option selected disabled></option>
                                                                        @foreach($users as $user)
                                                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div>
                                                                    <label>Comments </label>
                                                                    <textarea name="comments" class="form-control"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-success">Submit</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#NotRecommendedModal">Not Recommended</button>
                                            <!-- Not Recommended Modal -->
                                            <div class="modal fade" id="NotRecommendedModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <form action="{{ route('leave_recommendation.not_recommended',$recommendation->id) }}" method="Post" style='display:inline'>
                                                    @csrf
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Not Recommended</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div>
                                                                    <label>Comments </label>
                                                                    <textarea name="comments" class="form-control"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-danger">Submit</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>

                                        </td>
                                    </tr>
                                @endforeach
                            @endif

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
