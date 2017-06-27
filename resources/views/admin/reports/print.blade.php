<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <style>
        th, td {
            vertical-align: middle !important;
            font-size: 11px !important;
        }
        @media print {
            tr.tableheader {
                background-color: #FF7300 !important;
                -webkit-print-color-adjust: exact;
            }}

        @media print {
            .tableheader th {
                color: white !important;
            }}
    </style>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'AIMS') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/print/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/print/css/bootstrap-theme.min.css') }}" rel="stylesheet">

    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>


    <div class="col-md-12 col-xs-12 col-sm-12">
        <div class="content">
            <div class="image-container">
                <img src="{{ asset('images/verify_white.png') }}" alt="logo" style="height: 100px">
            </div>
            <div class="row">
                <div class="col-md-6 col-xs-12">
                    <h2>{{ $user->profile->getFullNameAttribute() }}</h2>
                </div>
                <div class="col-md-6 col-xs-12" style="margin-top: 15px">
                    <h5>Coverage:</h5>
                    <p class="text-primary"></p>
                </div>

                <div class="col-md-12 col-xs-12"><hr></div>

                <div class="col-md-12">
                    <h3>ACTIVITY DETAIL REPORT:</h3>
                    <table class="table table-bordered">
                        <thead>
                            <tr class="tableheader" style="background-color: #FF7300; color: white;">
                                <th class="hide">Tracker ID</th>
                                <th>Date</th>
                                <th>Brand Ambassador</th>
                                <th>Time</th>
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
                                <td>05/30/17 07:24:20 AM</td>
                                <td>Cafediem</td>
                                <td class="hide">05:08:03</td>
                                <td class="hide">05/09/17 05:25:03 PM</td>
                            </tr>
                            <tr>
                                <td class="hide">Verify 001</td>
                                <td>05/30/17</td>
                                <td>Rina Martez</td>
                                <td>05/30/17 07:32:08 AM</td>
                                <td>Kamuning Road</td>
                                <td class="hide">05:08:03</td>
                                <td class="hide">05/09/17 05:25:03 PM</td>
                            </tr>
                            <tr>
                                <td class="hide">Verify 001</td>
                                <td>05/30/17</td>
                                <td>Rina Martez</td>
                                <td>05/30/17 07:41:29 AM</td>
                                <td>Epifanio de los Santos Ave</td>
                                <td class="hide">05:08:03</td>
                                <td class="hide">05/09/17 05:25:03 PM</td>
                            </tr>
                            <tr>
                                <td class="hide">Verify 001</td>
                                <td>05/30/17</td>
                                <td>Rina Martez</td>
                                <td>05/30/17 07:49:39 AM</td>
                                <td>Kamias Road</td>
                                <td class="hide">05:08:03</td>
                                <td class="hide">05/09/17 05:25:03 PM</td>
                            </tr>
                            <tr>
                                <td class="hide">Verify 001</td>
                                <td>05/30/17</td>
                                <td>Rina Martez</td>
                                <td>05/30/17 07:57:02 AM</td>
                                <td>Buger King Kamias</td>
                                <td class="hide">05:08:03</td>
                                <td class="hide">05/09/17 05:25:03 PM</td>
                            </tr>
                            <tr>
                                <td class="hide">Verify 001</td>
                                <td>05/30/17</td>
                                <td>Rina Martez</td>
                                <td>05/30/17 08:04:47 AM</td>
                                <td>Shell Kasing-kasing</td>
                                <td class="hide">05:08:03</td>
                                <td class="hide">05/09/17 05:25:03 PM</td>
                            </tr>
                            <tr>
                                <td class="hide">Verify 001</td>
                                <td>05/30/17</td>
                                <td>Rina Martez</td>
                                <td>05/30/17 08:06:32 AM</td>
                                <td>Shell Kasing-kasing</td>
                                <td class="hide">05:08:03</td>
                                <td class="hide">05/09/17 05:25:03 PM</td>
                            </tr>
                            <tr>
                                <td class="hide">Verify 001</td>
                                <td>05/30/17</td>
                                <td>Rina Martez</td>
                                <td>05/30/17 08:09:17 AM</td>
                                <td>Shell Kasing-kasing</td>
                                <td class="hide">05:08:03</td>
                                <td class="hide">05/09/17 05:25:03 PM</td>
                            </tr>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>

    </div>

</body>
</html>
