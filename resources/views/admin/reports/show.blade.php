@extends('layouts.app')

@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Reports <small>View</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="/admin"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="/admin/reports"><i class="fa fa-bar-chart-o"></i> Reports</a></li>
                <li class="active">GPS</li>
            </ol>
        </section>

        <section class="content">
            <div class="box">
                <div class="box-body">
                    <div class="content">
                        <div class="row">
                            <button type="button" class="btn btn-primary pull-right" style="margin-bottom: 20px" onclick="frames['gpsReport'].print()">
                                <i class="fa fa-print"></i> Print Report
                            </button>
                        </div>
                        <div class="image-container">
                            <img src="{{ asset('images/verify_white.png') }}" alt="logo" style="height: 100px">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <h2>{{ $user->profile->getFullNameAttribute() }}</h2>
                            </div>
                            <div class="col-md-6" style="margin-top: 15px">
                                <h5>Coverage:</h5>
                                <p class="text-primary">{{ $startDate }} - {{ $endDate }}</p>
                            </div>
                            <div class="col-md-12"><hr></div>

                            <div class="col-md-12">
                                <h2>ACTIVITY DETAIL REPORT:</h2>
                                <table class="table table-bordered">
                                    <thead>
                                    <tr style="background-color: #FF7300; color: white;">
                                        <th>Date</th>
                                        <th>User</th>
                                        <th>Date and Time</th>
                                        <th>Location</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($locations as $location)
                                        <tr>
                                            <td>{{ $location->created_at->toFormattedDateString() }}</td>
                                            <td>{{ $location->user->profile->full_name }}</td>
                                            <td>{{ $location->created_at }}</td>
                                            <td>{{ $location->lat }}, {{ $location->lng }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>
    <iframe src="/admin/reports/preview/{{ $user->id }}?start={{ $startDate }}&end={{ $endDate }}" name="gpsReport" style="width: 0; height: 0"></iframe>
@endsection