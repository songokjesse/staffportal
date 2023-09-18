<div>
    <input type="text" wire:model.debounce.300ms="search" placeholder="Search users" class="form-control">

    <table class="table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Leave Category</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>
                            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)
            @foreach ($user->leave_applications as $leaveApplication)
                <tr>
                    <td>
                        {{ $leaveApplication->user->name }}
                    </td> <td>
                        {{ $leaveApplication->leave_category->name }}
                    </td>
                    <td>{{$leaveApplication->start_date}}</td>
                    <td>{{$leaveApplication->end_date}}</td>
                    <td>{{$leaveApplication->status}}</td>
                    <td><a href="{{route('individual_report_show', $leaveApplication->id)}}">Show</a></td>

                </tr>
            @endforeach
        @endforeach
        </tbody>
    </table>
</div>

