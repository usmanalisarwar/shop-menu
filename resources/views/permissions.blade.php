@extends('admin.layouts.app')

    @section('content')
        <div class="row">
            <div class="col-12">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">{{ ucwords(end($breadCrumbs)['name']) }}</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form class="form-horizontal" action="{{ route('roles.permissions.assign',['roleId'=>$role->id]) }}"
                          method="post">
                        @csrf
                        <div class="card-body">
                            @foreach($modules as $module)
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h3>{{ $module->name }}</h3>
                                    </div>
                                </div>
                                <div class="row m-3">
                                    @foreach($module->permissions as $permission)
                                        <div class="col-sm-4 mb-2">
                                            <div class="form-check">
                                                <input class="form-check-input"
                                                       @if(in_array($permission->id,$rolePermission)) checked
                                                       @endif type="checkbox" name="permissions[]"
                                                       id="{{ $permission->id }}" value="{{ $permission->id }}"/>
                                                <label for="{{ $permission->id }}"
                                                       class="form-check-label">{{ $permission->name }}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info">Update</button>
                            <a href="{{ route('roles.index') }}" class="btn btn-default float-right">Cancel</a>
                        </div>
                        <!-- /.card-footer -->
                    </form>
                </div>
            </div>
        </div>
    @endsection
    @section('customJs')
        <script>
            $(function () {
                @if(session('success'))
                $(document).Toasts('create', {
                    class: 'bg-success',
                    title: 'Success',
                    subtitle: "Updated",
                    body: "{{ session('success') }}",
                    autohide: true, // Enable autohide
                    delay: 5000, // Set the delay to 5000 milliseconds (5 seconds)
                })
                @endif
            });
        </script>
    @endsection
