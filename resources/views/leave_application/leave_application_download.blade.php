<!doctype html>
{{--<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">--}}
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        /*div.center {*/
        /*    display: flex;*/
        /*    justify-content: center;*/
        /*}*/
        body {
            margin: 70px;
            margin-top: 1em;
        }
        table, th, td {
            border: 1px solid black;
        }
    </style>
</head>
<body>

<center ><img src="https://res.cloudinary.com/homework-support-com/image/upload/v1691054617/logo_foxoai.png" width="100" height="100">
    <strong>
        <div class="center"  > KOITALEEL SAMOEI UNIVERSITY COLLEGE</div>
        <div class="center" > (A Constituent College of the University of Nairobi)</div>
    </strong>
</center>

<hr class="mt-2 mb-3"/>
<h4>Name:{{ __($leaves->applicant_name) }}</h4>
<h4>Employee's PF/NO: {{ __($profile[0]->pf) }}</h4>
<h4>Position: {{ __($profile[0]->job_title) }}</h4>
<h4>Department: {{ __($profile[0]->department_name) }}</h4>

<h3>Leave Application Details</h3>
<table class="mt-2 mt-3 table table-sm table-striped table-bordered">
    <thead>
    <tr>
        <th>Type of Leave</th>
        <th>From</th>
        <th>To</th>
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


<h3>To Be Left In Charge</h3>
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
<h3>My Contacts</h3>
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


<h3>HOD Recommendation</h3>

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


<h3>Human Resource Department Calculations</h3>
<div class="row">
    <div class="col-3">
        <table class=" table table-sm table-bordered table-striped-columns ">
            <tr>
                <th>Entitled Days </th>
                <th>Days Utilized</th>
            </tr>
            <tr>
                <td><strong>{{$current_allocation[0]->days}}</strong></td>
                <td><strong>{{ $leave_days_utilized->days_utilized ?? 0}}</strong></td>
            </tr>
        </table>
    </div>
</div>

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
                @if($approvals->not_approved === 1 and $approvals->approved === 0 )<span class="badge text-bg-danger"> Not Approved </span>@endif
                @if($approvals->not_approved === 0 and $approvals->approved === 0 )<span class="badge text-bg-warning"> Pending Approval </span>@endif
            </td>
            <td>{{$approvals->date_approved}}</td>
            <td>{{$approvals->approval_comments}}</td>
        @endif
    </tr>
    </tbody>

</table>

</body>
</html>
