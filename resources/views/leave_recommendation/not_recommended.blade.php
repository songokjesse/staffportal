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
                        <h2>{{ __('Leave Recommendation for '.$application->user->name) }}</h2>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
                                <a href="{{route('leave_recommendation.index')}}" class="btn btn-success btn-sm" ><i class="fs-4 bi-journals"></i> Recommendations</a>
                            </div>

                            <form action="{{ route('leave_recommendation.not_recommended',$application->id) }}" method="Post" style='display:inline'>
                                @csrf
                                <div class="card">
                                        <div class="card-header">
                                            <h1>Not Recommended</h1>
                                        </div>
                                    <div class="card-body">
                                        <div>
                                            <label>Reasons/Comments </label>
                                            <textarea name="comments" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-danger">Submit</button>
                                    </div>
                                </div>
                            </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

