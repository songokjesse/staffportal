<p>Hello {{$assigned_name}}.</p>

<p>I have made an application for Leave and was requesting you to perform my duties while I am away.</p>
<p>Please log in to the Staff Portal and approve or reject my request.</p>
<div class="text-center">
    <a href="{{env('APP_URL')}}/assigned_duties" class="btn btn-primary"> View Application</a>
</div>

<p>Best regards,</p>
<p>{{$applicant_name}}.</p>
