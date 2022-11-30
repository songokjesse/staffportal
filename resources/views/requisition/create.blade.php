@extends('layouts.auth_dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        <h2>{{ __('My Requisitions') }}</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
                            <a href="{{route('requisitions.index')}}" class="btn btn-success btn-sm" ><i class="fs-4 bi-journals"></i> Requisitions</a>
                        </div>

                            <hr/>


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
                                                    <input type="text" name="item_name[]" class="form-control" value="{{ old('total_amount') }} " required/>
                                                </td>
                                                <td>
                                                    <input type="text" name="item_quantity[]" class="form-control" required/>
                                                </td>
                                                <td>
                                                    <input type="text" name="unit_cost[]" class="form-control" required/>
                                                </td>
                                                <td>
                                                    <input type="text" name="total_cost[]" class="form-control" required/>
                                                </td>
                                                <td>
                                                    <button type="button"  id="dynamic-ar" class="btn btn-sm btn-outline-secondary">Add More items</button>
                                                </td>
                                            </tr>
                                            </tbody>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td><b>Totals:</b></td>
                                                <td>
                                                    <input type="text" name="total_amount" id="total_amount" class="form-control" value="{{ old('total_amount') }}" required/>
                                                    <span style="color:red"> {{ $errors->has('total_amount') ?  $errors->first('total_amount') : '' }} </span>

                                                </td>
                                            </tr>
                                            <tbody>

                                            </tbody>
                                        </table>

                                        <div class="mt-3">
                                            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                                        </div>
                                    </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        var i = 0;
        $("#dynamic-ar").click(function () {
            console.log('clicked')
        ++i;
        $("#dynamicAddRemove").append('<tr><td> <input type="text" name="item_name[]" class="form-control" required/> ' +
            '</td>' +
            '<td> <input type="text" name="item_quantity[]" class="form-control"/></td>'+
            '<td><input type="text" name="unit_cost[]" class="form-control"/></td>' +
            '<td><input type="text" id="amount" name="total_cost[]" class="form-control" /></td>' +
            '<td><button type="button" class="btn btn-outline-danger btn-sm remove-input-field">Delete</button></td></tr>'
        );
        });
        $(document).on('click', '.remove-input-field', function () {
        $(this).parents('tr').remove();
        });

    </script>
@endsection