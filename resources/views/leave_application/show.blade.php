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
                        <h2>{{ __('Leave') }}</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
                            <a href="{{route('leave_application.index')}}" class="btn btn-success btn-sm" ><i class="bi bi-journals"></i> My Leaves</a>
                        </div>

                            <h1>Leave Application Details</h1>
                        <table class="mt-2 mt-3 table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Leave</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Days</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    {{dd($leaves)}}
{{--                                    <td>{{$leaves->leave_category}}</td>--}}
{{--                                    <td>{{$leaves[0]->start_date}}</td>--}}
{{--                                    <td>{{$leaves[0]->end_date}}</td>--}}
{{--                                    <td>{{$leaves[0]->days}}</td>--}}
                                </tr>
                            </tbody>
                        </table>

                            <h1>HOD Recommendation</h1>

                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Recommended By</th>
                                <th>Recommendation</th>
                                <th>Date</th>
                                <th>Remarks</th>
                            </tr>
                            </thead>
                            <tbody>
{{--                            <tr>--}}
{{--                                <td>{{$leaves[0]->hod}}</td>--}}
{{--                                <td>--}}
{{--                                    @if($leaves[0]->recommendation === True)<span class="badge text-bg-success"> Recommended </span>@endif--}}
{{--                                    @if($leaves[0]->not_recommended === True)<span class="badge text-bg-warning"> Not Recommended </span>@endif--}}
{{--                                </td>--}}
{{--                                <td>{{$leaves[0]->date_recommended}}</td>--}}
{{--                                <td>{{$leaves[0]->recommendation_comments}}</td>--}}
{{--                            </tr>--}}
                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

