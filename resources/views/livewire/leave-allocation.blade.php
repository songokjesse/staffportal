<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}

    <div class="mt-2 mb-3">
        <div class="row g-3">
            <div class="col-sm-7">
                <div class="input-group">
                    <div class="input-group-text">Name</div>
                    <select wire:model="name"    class="form-control">
                        <option disabled></option>
                        @foreach($users as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm">
                <div class="input-group">
                    <div class="input-group-text">Year</div>
                    <select wire:model="year" class="form-control">
                        <option disabled></option>
                        <option>2022</option>
                        <option>2021</option>
                        <option>2020</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
        <tr>
        <th>#</th>
        <th>Name</th>
        <th>Leave Category</th>
        <th>Days Allocated</th>
        <th>Year</th>
        <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($leave_allocations as $leave_allocation)
        <tr>
            <td>{{$loop->iterations}}</td>
            <td>{{$leave_allocation->user_id}}</td>
            <td>{{$leave_allocation->leave_categories_is}}</td>
            <td>{{$leave_allocation->days}}</td>
            <td>{{$leave_allocation->year}}</td>
            <td></td>
        </tr>
        @endforeach
        </tbody>
    </table>
    <div class="mt-2 mb-3">
        {{$leave_allocations->links()}}
    </div>
</div>
