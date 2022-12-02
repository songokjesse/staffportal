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
                            <table class="table table-borderless">
                                <tr>
                                    <td> <strong>From: </strong>{{$requisition[0]->from_department}}</td>
                                    <td class="align-content-end">
                                        <strong>Date:</strong>
                                        {{Carbon\Carbon::parse($requisition[0]->created_at)->format('d-m-Y')}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong>To:</strong>
                                        {{$to_department[0]->to_department_name}}
                                    </td>
                                </tr>
                                <tr>
                                   <td><strong>RE:</strong> <u>{{$requisition[0]->title}}</u></td>
                                </tr>
                                <tr>
                                    <td>
                                        {{$requisition[0]->description}}
                                    </td>
                                </tr>
                            </table>


                        <table class="table table-responsive table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Item</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th>Amount</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($requisition_items as $item)
                                <tr>
                                    <td>{{$item->item_name}}</td>
                                    <td>{{$item->item_quantity}}</td>
                                    <td>{{$item->unit_cost}}</td>
                                    <td>{{$item->total_cost}}</td>
                                </tr>
                            @endforeach
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td><strong>Totals:</strong></td>
                                    <td>
                                        {{$requisition[0]->total}}
                                    </td>
                                </tr>

                            </tbody>

                        </table>

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

