@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Users
                <small>List of user</small>
            </h1>
            <a href="/admin/users/create" class="btn btn-info" style="position: absolute; top: 10px; left: 16%">
                <i class="fa fa-plus" ></i> ADD NEW USER
            </a>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li class="active">Users</li>
            </ol>
        </section>

        <section class="content">
            <div class="box">
                <div class="box-header">
                </div>
                <div class="box-body">
                    <table id="userTable" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>User Group</th>
                            <th>Mobile Number</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{ isset($user->profile) ? $user->profile->getFullNameAttribute() : 'N/A' }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ ucwords($user->group->name) }}</td>
                                <td>{{ $user->profile->mobile_number }}</td>
                                <td>{{ $user->created_at->toFormattedDateString() }}</td>
                                <td>
                                    <a class="btn btn-default" href="/admin/users/{{$user->id}}">
                                        <i class="fa fa-search"></i> View
                                    </a>
                                    <a class="btn btn-success" href="/admin/users/update/{{$user->id}}">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                    <button type="button" id="delete" data-item="{{$user->id}}"
                                            class="btn btn-danger deleteItem" data-toggle="modal" data-target="#deleteModal">
                                        <i class="fa fa-trash"></i> Delete
                                    </button>
                                    <button type="button" id="import" data-item="{{$user->id}}"
                                            class="btn btn-primary importItem" data-toggle="modal" data-target="#importModal">
                                        <i class="fa fa-map-marker"></i> Import Gps Data
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile Number</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </section>
    </div>
    @include('admin.users.deleteModal')
    @include('admin.users.importModal')
@endsection

@section('scripts')
    <script type="text/javascript">

        $(function() {

            var deleteId;

            var table = $('#userTable').DataTable();

            var $that;

            $(document).on('click', '.deleteItem', function(e){
                deleteId = $(this).attr('data-item');
                $that = $(this);
            });

            $(document).on('click', '.importItem', function() {
                let userId = $(this).data('item');
                $('#userId').val(userId);
            });

            $(document).on('click', '.deleteBtn', function() {
                console.log(deleteId);
                if (deleteId) {
                    var data = {
                        '_method': 'DELETE',
                        '_token': '{{ csrf_token() }}'
                    };

                    $.post('/admin/users/'+ deleteId, data, function(res){
                        console.log(res);
                        var rowSelected = $that.parent().parent();
                        table.row(rowSelected).remove().draw();
                    });
                }
            });

        });

    </script>
@endsection