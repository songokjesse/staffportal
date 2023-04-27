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
                        <h2>{{ __('Public Holiday') }}</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
                            <a href="{{route('holidays.index')}}" class="btn btn-success btn-sm" ><i class="bi bi-calendar"></i> Holidays</a>
                        </div>

                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th scope="col" >#</th>
                                <th scope="col" >Name</th>
                                <th scope="col">Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{$holiday->id}}</td>
                                <td>{{$holiday->name}}</td>
                                <td>{{$holiday->date}}</td>
                            </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


