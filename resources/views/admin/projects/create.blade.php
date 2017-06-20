@extends('layouts.app')

@section('content')

    <!-- Page Heading -->
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Projects
                <small>Create project</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="/admin"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="/admin/projects"><i class="fa fa-calendar-check-o"></i> Projects</a></li>
                <li class="active">Create</li>
            </ol>
        </section>

        <section class="content">
            <div class="box">
                <div class="box-header">
                </div>
                <div class="box-body">
                    <form action="/admin/projects/create" method="POST">
                        {{ csrf_field() }}
                        @include('admin.projects.form')
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection