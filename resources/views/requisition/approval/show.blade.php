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

                            <div x-data="{ open: false }">
                                <a href="{{route('approvals.index')}}"class="btn btn-warning btn-sm"><i class="bi bi-backspace"></i> Back</a>
                                <button x-on:click="open = ! open" class="btn btn-primary btn-sm"><i class="bi bi-eye"></i> Show Requisition</button>
                                <a href="{{route('requisitions.pdf', $requisitions[0]->id)}}" class="btn btn-success btn-sm"><i class="bi bi-printer"></i> Print</a>
                                <hr class="mt-3"/>

                                <div x-show="open">

                                    <table class="table table-borderless">
                                        <tr>
                                            <td> <strong>From: </strong>
                                                {{$requisitions[0]->user->name}}
                                            </td>
                                            <td> <strong>Department: </strong>
                                                {{$requisitions[0]->department->name}}
                                            </td>
                                            <td class="align-content-end">
                                                <strong>Date:</strong>
                                                {{Carbon\Carbon::parse($requisitions[0]->created_at)->format('d-m-Y')}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>RE:</strong> <u>
                                                    {{$requisitions[0]->title}}
                                                </u></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                {{$requisitions[0]->description}}
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
                                        @foreach($requisitions[0]->requisition_items as $item)
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
                                                {{$requisitions[0]->total}}
                                            </td>
                                        </tr>

                                        </tbody>

                                    </table>
                                </div>
                            </div>
                            <p>Comments</p>


                        <table class="table table-borderless table-striped mt-1 ">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Comments</th>
                                <th>By</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($comments as $comment)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$comment->comment}}</td>
                                    <td>{{$comment->user->name}}</td>
                                    <td>{{$comment->created_at}}</td>
                                    <td></td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                            <form action="{{route('approvals.store')}}" method="POST">
                                @csrf
                                @method('POST')
                                <div class="mb-2">
                                    <input type="hidden" name="requisition_id" value="{{$requisitions[0]->id}}">
                                    <textarea class="form-control" name="comment"></textarea>
                                </div>
                                <div>
                                    <button class="btn btn-success btn-sm" name="status" type="submit" value="Approved">Approve</button>
                                    <button class="btn btn-danger btn-sm" name="status" type="submit" value="Rejected">Reject</button>
                                </div>
                            </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

