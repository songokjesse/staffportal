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
                        <h2>{{ __('Leave Application Assigned Duties') }}</h2>
                        <table class="mt-2 mt-3 table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Leave</th>
                                <th>Days Applied</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($assigned_duties as $duty )
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$duty->leave_application->user->name}}</td>
                                    <td>{{$duty->leave_application->leave_category->name}}</td>
                                    <td>{{$duty->leave_application->days}}</td>
                                    <td>{{$duty->leave_application->start_date}}</td>
                                    <td>{{$duty->leave_application->end_date}}</td>
                                    <td>
                                        <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#ApprovedModal">Agree</button>

                                        <form action="{{ route('assigned_duties.agree',$duty->id) }}" method="Post" style='display:inline'>
                                            @csrf
                                            <!-- Modal -->
                                            <div class="modal fade" id="ApprovedModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel"> I Agree ! </h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>I Agree to Perform Duties for {{$duty->leave_application->user->name}} while on Leave </p>

                                                            <label class="col-form-label">
                                                                Comments
                                                            </label>
                                                            <textarea class="form-control" name="comments">

                                                                </textarea>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-success">Agree</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </form>

                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#NotApprovedModal">Dont Agree</button>
                                        <form action="{{ route('assigned_duties.dont_agree',$duty->id) }}" method="Post" style='display:inline'>
                                            @csrf
                                            <!-- Modal -->
                                            <div class="modal fade" id="NotApprovedModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">I Don't Agree to Perform Duties for {{$duty->leave_application->user->name}} while on Leave</h1>
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
                                                            <button type="submit" class="btn btn-danger">Dont Agree</button>
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
