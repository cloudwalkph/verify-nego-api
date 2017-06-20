@extends('layouts.app')

@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Projects
                <small>Update project</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="/admin"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="/admin/projects"><i class="fa fa-calendar-check-o"></i> Projects</a></li>
                <li class="active">Edit</li>
            </ol>
        </section>

        <section class="content">
            <div class="box">
                <div class="box-header">
                </div>
                <div class="box-body">
                    <form action="/admin/projects/update/{{$project->id}}" method="POST">
                        {{ csrf_field() }}
                        @include('admin.projects.form')
                    </form>
                </div>
            </div>
        </section>
    </div>

@endsection