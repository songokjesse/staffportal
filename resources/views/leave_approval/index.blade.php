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
                        <h2>{{ __('Leave Application Approvals') }}</h2>

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
                            @foreach($approvals as $approval )
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$approval->applicant_name}}</td>
                                    <td>{{$approval->leave_category}}</td>
                                    <td>{{$approval->days}}</td>
                                    <td>{{$approval->left_in_charge}}</td>
                                    <td>{{$approval->start_date}}</td>
                                    <td>{{$approval->end_date}}</td>
                                    <td>
                                        <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#ApprovedModal">Approved</button>

                                        <form action="{{ route('leave_approvals.approved',$approval->id) }}" method="Post" style='display:inline'>
                                            @csrf
                                            <!-- Modal -->
                                            <div class="modal fade" id="ApprovedModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Leave Approved</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">

                                                            <label class="col-form-label">
                                                                Comments
                                                            </label>
                                                            <textarea class="form-control" name="comments">

                                                                </textarea>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-success">Approved</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </form>

                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#NotApprovedModal">Not Approved</button>
                                        <form action="{{ route('leave_approvals.not_approved',$approval->id) }}" method="Post" style='display:inline'>
                                            @csrf
                                            <!-- Modal -->
                                            <div class="modal fade" id="NotApprovedModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Leave Not Approved</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <label class="col-form-label">
                                                                Comments
                                                            </label>
                                                          <textarea class="form-control" name="comments">

                                                          </textarea>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-danger">Not Approved</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

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
