<div>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Type of Leave :</label>
        <select name='leave_categories_id' class="form-control @error('leave_categories_id') is-invalid @enderror " id="exampleInputEmail1" aria-describedby="emailHelp" wire:click="change_value($event.target.value)" required>
            <option selected disabled></option>
            @foreach($leave_allocation as $allocation)
                <option value="{{$allocation->leaveType->id}}.{{$allocation->days}}">{{$allocation->leaveType->name}} ----  &nbsp; Days Available: {{$allocation->days}}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Leave Period :</label>
        <input id="num_days" type="number" min="1" max="{{$leave_days}}" name="days" class="form-control @error('days') is-invalid @enderror" value="{{ old('days') }}" required>
    </div>
</div>
