<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <style>
        td {
            font-size: 10px !important;
        }
        th {
            font-size: 12px !important;
        }
    </style>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'AIMS') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/toastr.css') }}">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

    <script type="text/javascript" src="//www.gstatic.com/charts/loader.js"></script>
</head>
<body>


    <div class="col-md-12 col-xs-12 col-sm-12">
        <div class="content">
            <div class="image-container" style="margin-top: 50px">
                <img src="{{ asset('images/verify_white.png') }}" alt="logo" style="height: 100px">
            </div>
            <div class="row">
                <div class="col-md-4 col-xs-12">
                    <h2>{{ $project->name }}</h2>
                </div>
                <div class="col-md-2 col-xs-6" style="margin-top: 15px">
                    <h5>Status: {{ ucwords($project->status) }}</h5>
                </div>
                <div class="col-md-2 col-xs-6" style="margin-top: 15px">
                    <h5>Last Updated: {{ count($project->hits) > 0 ? $project->hits[count($project->hits) - 1]->created_at->toFormattedDateString() : 'N/A' }}</h5>
                </div>

                <div class="col-md-12 col-xs-12"><hr></div>

                <div class="col-md-12 col-xs-12">
                    <h2>Event Analytics</h2>
                    <p>Real time Data from <strong>{{ $project->name }}</strong> activities.</p>
                </div>
            </div>

            <div class="row">
                <table class="table table-hover" style="margin-top: 20px">
                    <tbody>
                    <tr>
                        <th>NEGOTIATOR</th>
                        <th>IMAGE</th>
                        <th>NAME</th>
                        <th>EMAIL</th>
                        <th>CONTACT NUMBER</th>
                        <th>SCHOOL</th>
                        <th>ADDRESS</th>
                        <th>LOCATION</th>
                    </tr>
                    @foreach($hits as $hit)
                        <tr>
                            <td>{{ $hit->user->profile->getFullNameAttribute() }}</td>
                            <td><img src="{{ asset('storage/'.$hit->image) }}" height="40" width="40" class="img-circle" alt=""></td>
                            <td>{{ $hit->name }}</td>
                            <td>{{ $hit->email }}</td>
                            <td>{{ $hit->contact_number }}</td>
                            <td>{{ $hit->school_name }}</td>
                            <td>{{ $hit->address }}</td>
                            <td>{{ $hit->location }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
