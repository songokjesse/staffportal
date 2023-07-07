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
                        <h2>{{ __('Management Staff Category') }}</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
                            <a href="{{route('management_categories.index')}}" class="btn btn-success btn-sm"><i class="bi bi-arrow-left-circle"></i> Management Category List</a>
                        </div>
                        <hr/>

                        <form action="{{route('management_categories.update', $management_category->id)}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name" class="col-form-label text-md-end">
                                    Management Category Name
                                </label>
                                <input type="text" class="form-control"  @error('name') is-invalid @enderror placeholder="Management Category Name" name="name" value="{{ $management_category->name ?? old('name')  }}" required autocomplete="name">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3 mt-2">
                                <button type="submit" class="btn btn-primary btn-sm">save</button>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

