@extends('layouts.app')

@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Users <small>View</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="/admin"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="/admin/users"><i class="fa fa-users"></i> Users</a></li>
                <li class="active">View</li>
            </ol>
        </section>

        <section class="content">
            <div class="box">
                <div class="box-header">
                    <div class="nav-tabs-custom">
                        <ul class="nav custom-tabs">
                            <li class="active"><a href="#profile" data-toggle="tab">Profile Information</a></li>
                            <li><a href="#projects" data-toggle="tab">Assigned Projects</a></li>
                        </ul>
                    </div>
                </div>
                <div class="box-body tab-content">
                    <div class="panel panel-default active tab-pane" id="profile">
                        <div class="panel-body">
                            <div class="col-md-12">
                                <h3 class="text-center">Profile Information</h3>
                                <hr>
                            </div>
                            <div class="col-md-12 profile-info">
                                <h5>E-mail Address: {{ $user->email }}</h5>
                                <h5>First Name: {{ $user->profile->first_name }}</h5>
                                <h5>Last Name: {{ $user->profile->last_name }}</h5>
                                <h5>Mobile Number: {{ $user->profile->mobile_number }}</h5>
                                <h5>Landline: {{ $user->profile->landline }}</h5>
                                <h5>Gender: {{ $user->profile->gender }}</h5>
                                <h5>Date Created: {{ $user->created_at->toFormattedDateString() }}</h5>
                                <h5>Last Updated: {{ $user->updated_at->toFormattedDateString() }}</h5>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default tab-pane" id="projects">
                        <div class="panel-body">
                            <div class="col-md-12">
                                <h3 class="text-center">Assigned Projects</h3>
                                <hr>
                            </div>
                            <div class="col-md-12 profile-info">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Project Name</th>
                                        <th>Hits</th>
                                        <th>Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($user->events as $event)
                                        <tr>
                                            <td>{{ $event->project->name }}</td>
                                            <td></td>
                                            <td>{{ $event->project->created_at }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-12" style="text-align: right;">
                            <a href="/admin/users" class="btn btn-default">
                                <i class="fa fa-arrow-left fa-lg"></i> Back
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>

@endsection