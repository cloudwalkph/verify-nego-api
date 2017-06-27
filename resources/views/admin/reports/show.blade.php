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
                                <p class="text-primary"></p>
                            </div>
                            <div class="col-md-12"><hr></div>

                            <div class="col-md-12">
                                <h2>ACTIVITY DETAIL REPORT:</h2>
                                <table class="table table-bordered">
                                    <thead>
                                    <tr style="background-color: #FF7300; color: white;">
                                        <th class="hide">Tracker ID</th>
                                        <th>Date</th>
                                        <th>Brand Ambassador</th>
                                        <th>Date and Time</th>
                                        <th>Location</th>
                                        <th class="hide">Time Duration</th>
                                        <th class="hide">Logout Time</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="hide">Verify 001</td>
                                        <td>05/30/17</td>
                                        <td>Rina Martez</td>
                                        <td>05/30/17 01:05:20 PM</td>
                                        <td>Cafediem</td>
                                        <td class="hide">05:08:03</td>
                                        <td class="hide">05/09/17 05:25:03 PM</td>
                                    </tr>
                                    <tr>
                                        <td class="hide">Verify 001</td>
                                        <td>05/30/17</td>
                                        <td>Rina Martez</td>
                                        <td>05/30/17 01:08:08 PM</td>
                                        <td>Kamuning Road</td>
                                        <td class="hide">05:08:03</td>
                                        <td class="hide">05/09/17 05:25:03 PM</td>
                                    </tr>
                                    <tr>
                                        <td class="hide">Verify 001</td>
                                        <td>05/30/17</td>
                                        <td>Rina Martez</td>
                                        <td>05/30/17 01:10:29 PM</td>
                                        <td>Epifanio de los Santos Ave</td>
                                        <td class="hide">05:08:03</td>
                                        <td class="hide">05/09/17 05:25:03 PM</td>
                                    </tr>
                                    <tr>
                                        <td class="hide">Verify 001</td>
                                        <td>05/30/17</td>
                                        <td>Rina Martez</td>
                                        <td>05/30/17 01:13:39 PM</td>
                                        <td>Kamias Road</td>
                                        <td class="hide">05:08:03</td>
                                        <td class="hide">05/09/17 05:25:03 PM</td>
                                    </tr>
                                    <tr>
                                        <td class="hide">Verify 001</td>
                                        <td>05/30/17</td>
                                        <td>Rina Martez</td>
                                        <td>05/30/17 01:17:02 PM</td>
                                        <td>Buger King Kamias</td>
                                        <td class="hide">05:08:03</td>
                                        <td class="hide">05/09/17 05:25:03 PM</td>
                                    </tr>
                                    <tr>
                                        <td class="hide">Verify 001</td>
                                        <td>05/30/17</td>
                                        <td>Rina Martez</td>
                                        <td>05/30/17 01:20:47 PM</td>
                                        <td>Shell Kasing-kasing</td>
                                        <td class="hide">05:08:03</td>
                                        <td class="hide">05/09/17 05:25:03 PM</td>
                                    </tr>
                                    <tr>
                                        <td class="hide">Verify 001</td>
                                        <td>05/30/17</td>
                                        <td>Rina Martez</td>
                                        <td>05/30/17 01:22:32 PM</td>
                                        <td>Shell Kasing-kasing Street, Quezon City</td>
                                        <td class="hide">05:08:03</td>
                                        <td class="hide">05/09/17 05:25:03 PM</td>
                                    </tr>
                                    <tr>
                                        <td class="hide">Verify 001</td>
                                        <td>05/30/17</td>
                                        <td>Rina Martez</td>
                                        <td>05/30/17 01:26:17 PM</td>
                                        <td>Shell Kasing-kasing Street, Quezon City</td>
                                        <td class="hide">05:08:03</td>
                                        <td class="hide">05/09/17 05:25:03 PM</td>
                                    </tr>

                                    <tr>
                                        <td class="hide">Verify 001</td>
                                        <td>05/30/17</td>
                                        <td>Rina Martez</td>
                                        <td>05/30/17 01:32:17 PM</td>
                                        <td>Kasing-kasing Street, Quezon City</td>
                                        <td class="hide">05:08:03</td>
                                        <td class="hide">05/09/17 05:25:03 PM</td>
                                    </tr>

                                    <tr>
                                        <td class="hide">Verify 001</td>
                                        <td>05/30/17</td>
                                        <td>Rina Martez</td>
                                        <td>05/30/17 01:37:17 PM</td>
                                        <td>Kasing-kasing Street, Quezon City</td>
                                        <td class="hide">05:08:03</td>
                                        <td class="hide">05/09/17 05:25:03 PM</td>
                                    </tr>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>
    <iframe src="/admin/reports/{{ $user->id }}/preview" name="gpsReport" style="width: 0; height: 0"></iframe>
@endsection