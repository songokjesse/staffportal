@extends('layouts.auth_dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mb-2">
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <h2>{{ __('Job Titles') }}</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
                            <a href="{{route('job_titles.create')}}" class="btn btn-success btn-sm" ><i class="bi bi-person-lines-fill"></i> Add Job Title</a>
                        </div>

                        <table class="table table-responsive table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($job_titles as $title)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$title->name}}</td>
                                    <td>
                                        <form action="{{ route('job_titles.destroy',$title->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{route('job_titles.edit', $title->id)}}" class="btn btn-outline-primary btn-sm">Edit</a>
                                            <button type="submit" class="btn btn-outline-danger btn-sm" id="delete-button">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
                {{ $job_titles->links() }}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.getElementById('delete-button').addEventListener('click', function (event) {
            if (!confirm('Are you sure you want to delete?')) {
                event.preventDefault();
            }
        });
    </script>
@endsection


