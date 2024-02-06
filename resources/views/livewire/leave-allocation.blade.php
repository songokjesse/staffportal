<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}

    <div class="mt-2 mb-3">
        <div class="row g-3">
            <div class="col-sm-7">
                <div class="input-group">
                    <div class="input-group-text">Name</div>
                    <select wire:model="name"    class="form-control users" >
                        <option selected disabled> Select Users</option>
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
                        <option>2026</option>
                        <option>2025</option>
                        <option>2024</option>
                        <option>2023</option>
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
            <td>{{$loop->iteration}}</td>
            <td>{{$leave_allocation->user->name}}</td>
            <td>{{$leave_allocation->leaveType->name}}</td>
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

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />    <script>
        $(document).ready(function () {
            $('.users').select2({
                theme: "bootstrap-5"
            });
        });

    </script>

@endsection
