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
                                    <td>{{$leaves[0]->leave_category}}</td>
                                    <td>{{$leaves[0]->start_date}}</td>
                                    <td>{{$leaves[0]->end_date}}</td>
                                    <td>{{$leaves[0]->days}}</td>
                                </tr>
                            </tbody>
                        </table>


                            <h2>Left In Charge</h2>
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th>Name</th>
                                </tr>
                                <tr>
                                    <td>{{$leaves[0]->left_in_charge}}</td>
                                </tr>
                            </table>
                            <h2>Contacts</h2>
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th>Phone Number</th>
                                    <td>Email</td>
                                </tr>
                                <tr>
                                    <th>{{$leaves[0]->phone}}</th>
                                    <td>{{$leaves[0]->email}}</td>
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
                                <td>{{$recommendations[0]->hod}}</td>
                                <td>
                                    @if($recommendations[0]->recommendation === True and $recommendations[0]->not_recommended === False )<span class="badge text-bg-success"> Recommended </span>@endif
                                    @if($recommendations[0]->not_recommended === True and $recommendations[0]->recommendation === False )<span class="badge text-bg-danger"> Not Recommended </span>@endif
                                    @if($recommendations[0]->not_recommended === False and $recommendations[0]->recommendation === False )<span class="badge text-bg-warning"> Pending Recommendation </span>@endif
                                </td>
                                <td>{{$recommendations[0]->date_recommended}}</td>
                                <td>{{$recommendations[0]->recommendation_comments}}</td>
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
                                <td>{{$approvals[0]->approved_by}}</td>
                                <td>
                                    @if($approvals[0]->approved === True and $approvals[0]->not_approved === False )<span class="badge text-bg-success"> Approved </span>@endif
                                    @if($approvals[0]->not_approved === True and $approvals[0]->approved === False )<span class="badge text-bg-danger"> Not Approved </span>@endif
                                    @if($approvals[0]->not_approved === False and $approvals[0]->approved === False )<span class="badge text-bg-warning"> Pending Approval </span>@endif
                                </td>
                                <td>{{$approvals[0]->date_approved}}</td>
                                <td>{{$approvals[0]->approval_comments}}</td>
                            </tr>
                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

