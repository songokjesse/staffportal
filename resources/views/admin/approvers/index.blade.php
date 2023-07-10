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
                        <h2>{{ __('Leave Approver Configuration') }}</h2>
                        {{--TODO--}}
                        {{--show validation msgs--}}

                        <div class="card mb-3">
                            <form action="{{route('approvers.store')}}" method="POST">
                                @csrf
                                @method('POST')
                                <div class="card-body">
                                    <div class="mb-2">
                                        <label>Staff Category</label>
                                        <select class="form-control" name="staff_category">
                                            <option selected disabled></option>
                                            @foreach($management_categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-2">
                                        <label>
                                            Approver
                                        </label>
                                        <select class="form-control" name="approver">
                                            <option selected disabled></option>
                                            @foreach($management_categories as $approver)
                                                <option value="{{ $approver->id }}">{{ $approver->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                                </div>
                            </form>

                        </div>

                        <table class="table table-responsive table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Staff Category</th>
                                <th>Approver</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($approvers as $approver)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$approver->staffCategory->name}}</td>
                                    <td>{{$approver->approverCategory->name}}</td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

