@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Projects
                <small>List of projects</small>
            </h1>
            <a href="/admin/projects/create" class="btn btn-info" style="position: absolute; top: 10px; left: 16%">
                <i class="fa fa-plus" ></i> ADD NEW PROJECT
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
                            <th>Status</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($projects as $project)
                            <tr>
                                <td>{{ $project->name }}</td>
                                <td>{{ ucwords($project->status) }}</td>
                                <td>{{ $project->created_at->toFormattedDateString() }}</td>
                                <td>
                                    <a class="btn btn-default" href="/admin/projects/{{$project->id}}">
                                        <i class="fa fa-search"></i> View
                                    </a>
                                    <a class="btn btn-success" href="/admin/projects/update/{{$project->id}}">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                    <button type="submit" id="delete" data-item="{{$project->id}}"
                                            class="btn btn-danger deleteItem" data-toggle="modal" data-target="#deleteModal">
                                        <i class="fa fa-trash"></i> Delete
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </section>
    </div>
    @include('admin.projects.deleteModal')
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

            $('.deleteBtn').on('click', function(e){
                console.log(deleteId);
                if (deleteId) {
                    var data = {
                        '_method': 'DELETE',
                        '_token': '{{ csrf_token() }}'
                    };

                    $.post('/admin/projects/'+ deleteId, data, function(res){
                        console.log(res);
                        var rowSelected = $that.parent().parent();
                        table.row(rowSelected).remove().draw();
                    });
                }
            });
        });

    </script>
@endsection