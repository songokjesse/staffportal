<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <div>
        <input type="text" wire:model="name" placeholder="Search users..." class="form-control"/>

{{--        {{$leave_applications->leave_applications}}--}}
        @if ($leave_applications)
        <table class="table mt-3 mb-3 table-bordered">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Leave Category</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>

                @foreach($leave_applications as $application)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$application->user->name}}</td>
                    <td>{{$application->leave_category->name}}</td>
                    <td>{{$application->start_date}}</td>
                    <td>{{$application->end_date}}</td>
                    <td>{{$application->status}}</td>
                </tr>
            @endforeach

            </tbody>

        </table>
        @else
            <hr class="mt-3">
            <p>No leave applications found for user.</p>
        @endif
    </div>


</div>
