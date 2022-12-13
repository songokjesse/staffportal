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
                        <h2>{{ __('My Requisitions') }}</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
                            <a href="{{route('requisitions.create')}}" class="btn btn-success btn-sm" ><i class="fs-4 bi-journals"></i> New Requisition</a>
                        </div>

                        <table class="table table-responsive table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Description</th>
                                <th>Department</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($requisitions as $requisition)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$requisition->description}}</td>
                                    <td>{{$requisition->name}}</td>
                                    <td>Ksh {{$requisition->total}}</td>
                                    {{-- TODO--}}
                                    {{-- Include an if statement to check status and change badge color --}}
                                    <td><span class="badge text-bg-warning"><i class="bi bi-arrow-repeat"></i> {{$requisition->status}}</span></td>
                                    <td>
                                        <a href="{{route('requisitions.show', $requisition->id)}}" class="btn btn-info btn-sm"><i class="bi bi-eye"></i> Show</a>
                                        <a href="{{route('requisitions.pdf', $requisition->id)}}" class="btn btn-success btn-sm"><i class="bi bi-printer"></i> Print</a>
                                        <a href="{{route('requisitions.show', $requisition->id)}}" class="btn btn-primary btn-sm"><i class="bi bi-list-check"></i> Approvals </a>
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

