@extends('layouts.auth_dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h2>{{ __('My Requisition') }}</h2>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
                    <a href="{{route('requisitions.index')}}" class="btn btn-success btn-sm" ><i class="fs-4 bi-journals"></i> Requisitions</a>
                </div>

                <hr/>
                <div>
                    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
                    <livewire:make-requisition :departments="$departments" />
                </div>
            </div>
        </div>
    </div>
@endsection

