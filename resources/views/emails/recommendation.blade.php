<p>Hello {{$assigned_name}}.</p>

<p>I have made an application for Leave and was humbly requesting for your recommendation.</p>
<p>Please log in to the Staff Portal to recommend my request.</p>
<div class="text-center">
    <a href="{{env('APP_URL')}}/leave_recommendation" class="btn btn-primary"> View Application</a>
</div>

<p>Best regards,</p>
<p>{{$applicant_name}}.</p>
