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
                            <form action="{{ route('leave_recommendation.recommended',$application->id) }}" method="Post" >
                            @csrf
                            <div class="card">
                                <div></div>
                                <div class="card-body">
                                <div class="mt-2">
                                  <label>To be Approved By : </label>
                                   <select name="user_id" required class="form-control">
                                    <option selected disabled></option>
                                     @foreach($users as $user)
                                       <option value="{{$user->id}}">{{$user->name}}</option>
                                       @endforeach
                                   </select>
                                </div>
                                <div>
                                    <label>Comments </label>
                                    <textarea name="comments" class="form-control"></textarea>
                                </div>
                                </div>
                                <div class="card-footer">
                                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Reset</button>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

