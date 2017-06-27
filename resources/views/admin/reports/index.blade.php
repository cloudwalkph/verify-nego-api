@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Reports
                <small>Report details</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li class="active">Reports</li>
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
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{ isset($user->profile) ? $user->profile->getFullNameAttribute() : 'N/A' }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ ucwords($user->group->name) }}</td>
                                <td>
                                    <button type="submit" id="delete" data-item="{{$user->id}}"
                                            class="btn btn-default" data-toggle="modal" data-target="#selectDate">
                                        <i class="fa fa-file-pdf-o"></i> Print Gps Report
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </section>
    </div>
    @include('admin.reports.selectDate')
@endsection

@section('scripts')
    <script type="text/javascript">

        $(function() {
            $('#userTable').DataTable();
        });

    </script>
@endsection