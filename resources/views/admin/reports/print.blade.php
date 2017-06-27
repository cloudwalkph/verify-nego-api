<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <style>
        th, td {
            vertical-align: middle !important;
            font-size: 11px !important;
        }
        .text-primary {
            color: #FF7300 !important;
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
                <div class="col-md-6" style="margin-top: 15px">
                    <h5>Coverage:</h5>
                    <p class="text-primary" >{{ $startDate }} - {{ $endDate }}</p>
                </div>
                <div class="col-md-12"><hr></div>

                <div class="col-md-12">
                    <h2>ACTIVITY DETAIL REPORT:</h2>
                    <table class="table table-bordered">
                        <thead>
                        <tr class="tableheader" style="background-color: #FF7300; color: white;">
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
                                <td>{{ $location->formatted_address }}</td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>

    </div>

</body>
</html>
