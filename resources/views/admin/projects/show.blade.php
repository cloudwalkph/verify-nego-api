@extends('layouts.app')

@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Projects <small>View</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="/admin"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="/admin/projects"><i class="fa fa-calendar-check-o"></i> Projects</a></li>
                <li class="active">View</li>
            </ol>
        </section>

        <section class="content">
            <div class="box">
                <div class="box-header">
                    <div class="nav-tabs-custom">
                        <ul class="nav custom-tabs">
                            <li class="active"><a href="#info" data-toggle="tab">General Information</a></li>
                            <li><a href="#users" data-toggle="tab">Assigned Users</a></li>
                        </ul>
                    </div>
                </div>
                <div class="box-body tab-content">
                    <div class="panel panel-default active tab-pane" id="info">
                        <div class="panel-body">
                            <div class="col-md-12">
                                <h3 class="text-center">General Information</h3>
                                <hr>
                            </div>
                            <div class="col-md-12 profile-info">
                                <h5>Name: {{ $project->name }}</h5>
                                <h5>Status: {{ $project->status }}</h5>
                                <h5>Date Created: {{ $project->created_at->toFormattedDateString() }}</h5>
                                <h5>Last Updated: {{ $project->updated_at->toFormattedDateString() }}</h5>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default tab-pane" id="users">
                        <div class="panel-body">
                            <div class="col-md-12">
                                <h3 class="text-center">Assigned Users</h3>
                                <hr>
                            </div>
                            <div class="col-md-12 profile-info">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($project->project_user as $user)
                                        <tr>
                                            <td>{{ isset($user->user->profile) ? $user->user->profile->getFullNameAttribute() : 'N/A' }}</td>
                                            <td>{{ $user->user->created_at }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-12" style="text-align: right;">
                            <a href="/admin/projects" class="btn btn-default">
                                <i class="fa fa-arrow-left fa-lg"></i> Back
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>

@endsection