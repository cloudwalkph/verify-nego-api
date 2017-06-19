@extends('layouts.app')

@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Users <small>View</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="/admin"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="/admin/users"><i class="fa fa-user-secret"></i> Users</a></li>
                <li class="active">View</li>
            </ol>
        </section>

        <section class="content">
            <div class="box">
                <div class="box-header">
                </div>
                <div class="box-body">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="col-md-12">
                                <h3 class="text-center">Profile Information</h3>
                                <hr>
                            </div>
                            <div class="col-md-12 profile-info">
                                <h5>E-mail Address: {{ $user->email }}</h5>
                                <h5>First Name: {{ $user->profile->first_name }}</h5>
                                <h5>Last Name: {{ $user->profile->last_name }}</h5>
                                <h5>Birthdate: {{ $user->profile->birthdate }}</h5>
                                <h5>Gender: {{ $user->profile->gender }}</h5>
                                <h5>Date Created: {{ $user->created_at->toFormattedDateString() }}</h5>
                                <h5>Last Updated: {{ $user->updated_at->toFormattedDateString() }}</h5>
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