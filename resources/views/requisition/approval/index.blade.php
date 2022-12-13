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
                        <h2>{{ __('Requisitions Approval') }}</h2>

                            @if (count($requisitions) > 0)
                                <table class="table table-responsive table-striped table-bordered mt-3">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Description</th>
                                        <th>Department</th>
                                        <th>Total</th>
                                        <th>Initiated By</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($requisitions as $requisition)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$requisition->description}}</td>
                                            <td>{{$requisition->department->name}}</td>
                                            <td>Ksh {{$requisition->total}}</td>
                                            <td>{{$requisition->user->name}}</td>
                                            <td><span class="badge text-bg-warning"><i class="bi bi-arrow-repeat"></i> {{$requisition->status}}</span></td>
                                            <td>
                                                <a href="{{route('requisitions.show', $requisition->id)}}" class="btn btn-primary btn-sm"><i class="bi bi-list-check"></i> Approvals </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>

                                </table>
                            @else
                                <hr class="mb-3">
                                <div class="mt-3">
                                <h2>
                                    <span class="alert alert-warning">No Requisitions Posted for Approval </span>
                                </h2>
                                </div>
                            @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

