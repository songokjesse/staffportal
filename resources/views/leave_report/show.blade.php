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
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
                            @if($leaves->status == "ACTIVE")
                                <a href="/download/{{$leaves->id}}" class="btn btn-warning btn-sm">Download Application <i class="bi bi-file-earmark-pdf-fill"></i></a>
                            @endif
                            <a href="{{route('individual_report')}}" class="btn btn-success btn-sm" ><i class="bi bi-journals"></i> Individual Reports</a>
                        </div>
                        <hr class="mt-2 mb-3"/>
                        <h2>{{ __($leaves->applicant_name) }}</h2>

                        <div class="row">
                            <div class="col-3">
                                <table class=" table table-sm table-bordered table-striped-columns ">
                                    <tr>
                                        <th>Entitled Days </th>
                                        <td><strong>{{$current_allocation[0]->days}}</strong></td>
                                    </tr>
                                    <tr>
                                        <th>Days Utilized</th>
                                        <td><strong>{{ $leave_days_utilized->days_utilized ?? 0}}</strong></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <h2>Leave Application Details</h2>
                        <table class="mt-2 mt-3 table table-sm table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Leave Category</th>
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
                        <table class="table table-sm table-bordered table-striped">
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
                        <table class="table table-sm table-bordered table-striped">
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

                        <table class="table table-sm table-bordered table-striped">
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

                        <table class="table table-sm table-bordered table-striped">
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
                                        @if($approvals->not_approved === 1 and $approvals->approved === 0)<span class="badge text-bg-danger"> Not Approved </span>@endif
                                        @if($approvals->not_approved === 0 and $approvals->approved === 0 )<span class="badge text-bg-warning"> Pending Approval </span>@endif
                                    </td>
                                    <td>{{$approvals->date_approved}}</td>
                                    <td>{{$approvals->approval_comments}}</td>
                                @endif
                            </tr>
                            </tbody>

                        </table>
                        @if($attachments->count() == 0)
                        @else
                            <h2>Leave Documents</h2>
                            <hr class="mt-2 mb-3">
                            <ul class="list-group">
                                @foreach($attachments as $attachment)
                                    <a href="#" class="list-group-item">{{$attachment->file_name}}</a>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

