@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="alert alert-primary" style="text-align: center">
            <img src="{{ asset('images/ic_sms_failed_24px.png') }}" alt="info"> CLICK ON A PROJECT TO VIEW MORE DETAILS
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">

                            <legend>My Projects</legend>
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Project Name</th>
                                    <th>Active Runs</th>
                                    <th>Achieve Sampling Target Hits</th>
                                    <th>Completed Runs</th>
                                    <th>Status</th>
                                </tr>
                                </thead>

                                <tbody>

                                </tbody>
                            </table>


                            <legend>Shared Projects</legend>
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Project Name</th>
                                    <th>Active Runs</th>
                                    <th>Achieved Target Hits</th>
                                    <th>Completed Runs</th>
                                    <th>Status</th>
                                </tr>
                                </thead>

                                <tbody>

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
