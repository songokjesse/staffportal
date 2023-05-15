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
                        <h2>{{ __('Leave') }}</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
                            <a href="{{route('leave_application.index')}}" class="btn btn-success btn-sm" ><i class="bi bi-journals"></i> My Leaves</a>
                        </div>
                            <hr class="mt-2 mb-3"/>

                            <h2>Leave Application Details</h2>
                        <table class="mt-2 mt-3 table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Leave</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Days</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$leaves->leave_category}}</td>
                                    <td>{{$leaves->start_date}}</td>
                                    <td>{{$leaves->end_date}}</td>
                                    <td>{{$leaves->days}}</td>
                                </tr>
                            </tbody>
                        </table>


                            <h2>Left In Charge</h2>
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th>Name</th>
                                </tr>
                                <tr>
                                    @if($assigned_duty == null)
                                        <td>
                                            <span class="badge bg-danger">   Yet to be assigned </span>
                                        </td>
                                    @else
                                        <td>{{$assigned_duty->left_in_charge}}</td>
                                    @endif
                                </tr>
                            </table>
                            <h2>Contacts</h2>
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th>Phone Number</th>
                                    <td>Email</td>
                                </tr>
                                <tr>
                                    <th>{{$leaves->phone}}</th>
                                    <td>{{$leaves->email}}</td>
                                </tr>
                            </table>


                            <h2>HOD Recommendation</h2>

                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Recommended By</th>
                                <th>Recommendation</th>
                                <th>Date</th>
                                <th>Remarks</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                @if(empty($recommendations))
                                    <td colspan="5" >
                                        <span class="badge bg-danger">  Yet to be Recommended </span>
                                    </td>
                                @else
{{--                                    {{dd($recommendations)}}--}}
                                    <td>{{$recommendations->hod}}</td>
                                    <td>
                                        @if($recommendations->recommendation === 1 and $recommendations->not_recommended === 0 )<span class="badge text-bg-success"> Recommended </span>@endif
                                        @if($recommendations->not_recommended === 1 and $recommendations->recommendation === 0)<span class="badge text-bg-danger"> Not Recommended </span>@endif
                                        @if($recommendations->not_recommended === 0 and $recommendations->recommendation === 0 )<span class="badge text-bg-warning"> Pending Recommendation </span>@endif
                                    </td>
                                    <td>{{$recommendations->date_recommended}}</td>
                                    <td>{{$recommendations->recommendation_comments}}</td>
                                @endif

                            </tr>
                            </tbody>

                        </table>
                         <h2>Approvals</h2> (<i>Principal/Registrar,Administration/Deputy Registrar, HR</i>)

                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Approved By</th>
                                <th>Approved/Not Approved</th>
                                <th>Date</th>
                                <th>Remarks</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>

                                @if($approvals == null)
                                    <td colspan="5" >
                                        <span class="badge bg-danger"> Yet to be Approved </span>
                                    </td>
                                @else
                                    <td>{{$approvals->approved_by}}</td>
                                    <td>
                                        @if($approvals->approved === 1 and $approvals->not_approved === 0 )<span class="badge text-bg-success"> Approved </span>@endif
                                        @if($approvals->not_approved === 1 and $approvals->approved === 0 )<span class="badge text-bg-danger"> Not Approved </span>@endif
                                        @if($approvals->not_approved === 0 and $approvals->approved === 0 )<span class="badge text-bg-warning"> Pending Approval </span>@endif
                                    </td>
                                    <td>{{$approvals->date_approved}}</td>
                                    <td>{{$approvals->approval_comments}}</td>
                                @endif
                            </tr>
                            </tbody>

                        </table>

                            <h2>Leave Documents</h2>
                            <hr class="mt-2 mb-3">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

