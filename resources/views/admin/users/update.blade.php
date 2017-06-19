@extends('layouts.app')

@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Users
                <small>Update user</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="/admin"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="/admin/users"><i class="fa fa-user-secret"></i> Users</a></li>
                <li class="active">Edit</li>
            </ol>
        </section>

        <section class="content">
            <div class="box">
                <div class="box-header">
                </div>
                <div class="box-body">
                    <form action="/admin/users/update/{{$user->id}}" method="POST">
                        {{ csrf_field() }}
                        @include('admin.users.form')
                    </form>
                </div>
            </div>
        </section>
    </div>

@endsection