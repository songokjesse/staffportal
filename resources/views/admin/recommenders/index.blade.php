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
                        <h2>{{ __('Leave Recommender Configuration') }}</h2>

                        {{--TODO--}}
                        {{--show validation msgs--}}

                        <div class="card mb-3">
                            <form action="{{route('recommenders.store')}}" method="POST">
                                @csrf
                                @method('POST')
                                <div class="card-body">
                                    <div class="mb-2">
                                        <label>Staff Category</label>
                                        <select class="form-control" name="staff_category">
                                            <option selected disabled></option>
                                        @foreach($management_categories as  $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('staff_category')
                                        <span class="text-red-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-2">
                                        <label>
                                           Recommender
                                        </label>
                                        <select class="form-control" name="recommender">
                                            <option selected disabled></option>
                                            @foreach($management_categories as  $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('management_category_id')
                                        <span class="text-red-500">{{ $message }}</span>
                                        @enderror
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
                                <th>Recommender</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($recommenders as $recommender)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$recommender->staffCategory->name}}</td>
                                    <td>{{$recommender->recommenderCategory->name}}</td>
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

