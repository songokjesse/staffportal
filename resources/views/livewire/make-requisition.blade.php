<div>
  {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <form action="{{route('requisitions.store')}}" method="POST" class="form">
        @csrf
        @method('POST')
        <div class="row justify-content-between">
            <div class="col-4">
                <label class="col-form-label">From:  </label>
                <select class="form-select" name="from_department_id" @error('department_id') is-invalid @enderror required autocomplete="department_id" autofocus required>
                    @foreach($departments as $department)
                        <option value="{{$department->id}}">{{$department->name}}</option>
                    @endforeach
                </select>
                @error('department_id')
                <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                @enderror
            </div>
            <div class="col-4">
                <label class="col-form-label">To:  </label>
                <select class="form-select" name="to_department_id" @error('department_id') is-invalid @enderror required autocomplete="department_id" autofocus required>
                    @foreach($departments as $department)
                        <option value="{{$department->id}}">{{$department->name}}</option>
                    @endforeach
                </select>
                @error('department_id')
                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                @enderror
            </div>
        </div>


        <div class="mt-3">
            <label>RE:  </label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}" required/>
            <span style="color:red"> {{ $errors->has('title') ?  $errors->first('title') : '' }} </span>

        </div>

        <div class="form-group mt-3">
            <label>Description:</label>
            <textarea class="form-control" value="{{ old('description') }}" @error('description') is-invalid @enderror name="description" autocomplete="description" autofocus required></textarea>
            <span style="color:red"> {{ $errors->has('description') ?  $errors->first('description') : '' }} </span>
        </div>

        <table class="table table-bordered table-striped mt-3 table-responsive-sm" id="dynamicAddRemove">
            <thead>
            <tr>
                <th>Item</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Amount</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>
                    <input type="text" wire:model="item_name.0" class="form-control" required/>
                    @error('item_name.0') <span class="text-danger error">{{ $message }}</span>@enderror
                </td>
                <td>
                    <input type="text"  wire:model="item_quantity.0" class="form-control" required/>
                    @error('item_quantity.0') <span class="text-danger error">{{ $message }}</span>@enderror
                </td>
                <td>
                    <input type="text"  wire:model="unit_cost.0" class="form-control" required/>
                    @error('unit_cost.0') <span class="text-danger error">{{ $message }}</span>@enderror
                </td>
                <td>
                    <input type="text"  wire:model="total_cost.0" class="form-control" required/>
                    @error('total_cost.0') <span class="text-danger error">{{ $message }}</span>@enderror
                </td>
                <td>
                    <button type="button"  id="dynamic-ar" class="btn btn-sm btn-outline-secondary"  wire:click.prevent="add({{$i}})">Add More items</button>
                </td>
            </tr>
            </tbody>
            @foreach($inputs as $key => $value)
            <tr>
                <td>
                    <input type="text"  wire:model="item_name.{{ $value }}" class="form-control" required/>
                    @error('item_name.'.$value) <span class="text-danger error">{{ $message }}</span>@enderror
                </td>
                <td>
                    <input type="text"  wire:model="item_quantity.{{ $value }}" class="form-control" required/>
                    @error('item_quantity.'.$value) <span class="text-danger error">{{ $message }}</span>@enderror
                </td>
                <td>
                    <input type="text"  wire:model="unit_cost.{{ $value }}" class="form-control" required/>
                    @error('unit_cost.'.$value) <span class="text-danger error">{{ $message }}</span>@enderror
                </td>
                <td>
                    <input type="text"  wire:model="total_cost.{{ $value }}" class="form-control"  required/>
                    @error('total_cost.'.$value) <span class="text-danger error">{{ $message }}</span>@enderror
                </td>
                <td>
                    <button type="button" class="btn btn-outline-danger btn-sm remove-input-field" wire:click.prevent="remove({{$key}})">Remove item</button>
                </td>
            </tr>
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td><b>Totals:</b></td>
                <td>
                    <input type="text" name="total_amount" id="total_amount" class="form-control" wire:model="total_amount" disabled required/>
{{--                    <span style="color:red"> {{ $errors->has('total_amount') ?  $errors->first('total_amount') : '' }} </span>--}}

                </td>
            </tr>
            <tbody>

            </tbody>
        </table>

        <div class="mt-3">
            <button type="submit" class="btn btn-sm btn-primary" wire:click.prevent="store()">Submit</button>
        </div>
    </form>

</div>

