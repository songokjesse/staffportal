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
                        <h2>{{ __('Public Holidays') }}</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
                            <a href="{{route('holidays.create')}}" class="btn btn-success btn-sm" ><i class="bi bi-calendar"></i> Add Holiday</a>
                        </div>

                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th scope="col" >#</th>
                                <th scope="col" >Name</th>
                                <th scope="col">Date</th>
                                <th scope="col"  colspan="3"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($holidays as $holiday)
                                <tr>
                                    <th scope="row">{{ $holiday->id }}</th>
                                    <td>{{ $holiday->name }}</td>
                                    <td>{{ $holiday->date }}</td>
                                    <td><a href="{{ route('holidays.show', $holiday->id) }}" class="btn btn-warning btn-sm">Show</a></td>
                                    <td><a href="{{ route('holidays.edit', $holiday->id) }}" class="btn btn-info btn-sm">Edit</a></td>
                                    <td>
                                        {!! Form::open(['method' => 'DELETE','route' => ['holidays.destroy', $holiday->id],'style'=>'display:inline']) !!}
                                        {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <div class="d-flex">
                            {!! $holidays->links() !!}
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


