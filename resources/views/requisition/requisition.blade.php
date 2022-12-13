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