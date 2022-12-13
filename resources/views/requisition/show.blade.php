@extends('layouts.auth_dashboard')

@section('content')
    <div class="container" xmlns="http://www.w3.org/1999/html">
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
                            <a href="{{route('requisitions.index')}}" class="btn btn-success btn-sm" ><i class="fs-4 bi-journals"></i> Requisitions</a>
                        </div>

                            <hr class="mt-3 mb-3"/>
                            @include('requisition.requisition')

                            @include('requisition.requisition_items')

                            <div class="mt-4">
                                <u>{{Auth::user()->name}}</u>
                                <br/>
                                <strong>{{$requisition[0]->from_department}} </strong>
                            </div>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
                            <a href="{{route('requisitions.pdf', $requisition[0]->id)}}" class="btn btn-primary btn-sm"><i class="bi bi-printer"></i> Print Requisition</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

