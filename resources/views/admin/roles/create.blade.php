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
                        <h2>{{ __('Roles') }}</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
                            <a href="{{route('roles.index')}}" class="btn btn-success btn-sm"><i class="bi bi-arrow-left-circle"></i> Roles</a>
                        </div>
                        <hr/>

                        <form  action="{{ route('roles.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name" class="col-form-label text-md-end">
                                    Role Name
                                </label>
                                <input type="text" class="form-control"  @error('name') is-invalid @enderror placeholder="Role Name" name="name" value="{{ old('name') }}" required autocomplete="name">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mt-3">
                            <label for="permissions" class="form-label">Assign Permissions</label>
                            <table class="table table-striped table-bordered">
                                <thead>
                                <th scope="col"><input type="checkbox" name="all_permission"></th>
                                <th scope="col" >Name</th>
                                <th scope="col" >Guard</th>
                                </thead>

                                @foreach($permissions as $permission)
                                    <tr>
                                        <td>
                                            <input type="checkbox"
                                                   name="permission[{{ $permission->name }}]"
                                                   value="{{ $permission->name }}"
                                                   class='permission'>
                                        </td>
                                        <td>{{ $permission->name }}</td>
                                        <td>{{ $permission->guard_name }}</td>
                                    </tr>
                                @endforeach
                            </table>
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

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('[name="all_permission"]').on('click', function() {

                if($(this).is(':checked')) {
                    $.each($('.permission'), function() {
                        $(this).prop('checked',true);
                    });
                } else {
                    $.each($('.permission'), function() {
                        $(this).prop('checked',false);
                    });
                }

            });
        });
    </script>
@endsection
