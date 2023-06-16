<p>Hello {{$approvers_name}}.</p>

<p>I have made an application for Leave and was humbly requesting for your Approval.</p>
<p>Please log in to the KSUC Staff Portal to approve my request.</p>
<div class="text-center">
    <a href="{{env('APP_URL')}}/leave_approvals" class="btn btn-primary"> View Application</a>
</div>

<p>Best regards,</p>
<p>{{$applicant_name}}.</p>
<p>Please do not reply to this email</p>
