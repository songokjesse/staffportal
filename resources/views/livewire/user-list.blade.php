<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <div class="row">
        <div  class="col-md-2">Filter by Department</div>
        <div class="col-md-6 mb-3">
            <select wire:model="selectedDepartment" class="form-control">
                <option value="">All Departments</option>
                @foreach ($departments as $department)
                    <option value="{{ $department->id }}" > {{ $department->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Roles</th>
            <th scope="col"  colspan="3"></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->user->name }}</td>
                <td>{{ $user->user->email }}</td>
                <td>
                    @foreach($user->user->roles as $role)
                        <span class="badge bg-primary">{{ $role->name }}</span>
                    @endforeach
                </td>
                <td><a href="{{ route('users.show', $user->user->id) }}" class="btn btn-warning btn-sm">Show</a></td>
                <td><a href="{{ route('users.edit', $user->user->id) }}" class="btn btn-info btn-sm">Edit</a></td>
                <td>
                    {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->user->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>


    <div class="d-flex">
        {!!  $users->links() !!}
    </div>
</div>
