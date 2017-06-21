@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="info-section">
            <div class="info-title">
                <a href="/home" class="nav-back"><i class="glyphicon glyphicon-chevron-left"></i></a>
                <h1 style="color: #fff">
                    {{ $project->name }}
                </h1>

            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">

                            <div class="content">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3>Event Analytics</h3>
                                        <p>Real time Data from <strong>{{ $project->name }}</strong> activities.</p>
                                        <p style="color: #FF7300;">Last updated: {{ $project->updated_at->toFormattedDateString() }}</p>
                                    </div>
                                    <div class="col-md-6 text-right" style="padding-top: 25px;">
                                        <button class="btn btn-default"><i class="fa fa-file-excel-o"></i> Export Excel</button>
                                        <button class="btn btn-default"><i class="fa fa-file-pdf-o"></i> Export Pdf</button>
                                    </div>
                                </div>

                                <ul class="nav nav-tabs" id="serviceTabs">
                                    <li class="active"><a href="#event-analytics" data-toggle="tab">Graph Analytics</a></li>
                                    <li><a href="#table-analytics" data-toggle="tab">Data Analytics</a></li>
                                </ul>

                                <div class="tab-content">
                                    <div class="tab-pane active" id="event-analytics">
                                        <div class="content-body">
                                            <div class="time-and-video">
                                                <div class="time-graph" id="time-graph"></div>
                                            </div>

                                            <div class="other-graphs">
                                                <div class="graph" id="gender-graph"></div>
                                                <div class="graph" id="age-graph" style="background-color: #da7c29;"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="table-analytics">

                                        <table class="table table-hover" style="margin-top: 20px">
                                            <tbody>
                                            <tr>
                                                <th>Negotiator</th>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Email Address</th>
                                                <th>Contact Number</th>
                                                <th>School</th>
                                                <th>Address</th>
                                                <th>Location</th>
                                            </tr>
                                            @foreach($hits as $hit)
                                                <tr>
                                                    <td>{{ $hit->user->profile->getFullNameAttribute() }}</td>
                                                    <td><img src="{{ asset('storage/'.$hit->image) }}" height="50" width="50" class="img-circle" alt=""></td>
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

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

    <script type="text/javascript">
        (function() {
            let hits = JSON.parse('{!! json_encode($hits) !!}');

            // Load the Visualization API and the corechart package.
            google.charts.load('current', {'packages':['corechart']});

            // Set a callback to run when the Google Visualization API is loaded.
            google.charts.setOnLoadCallback(drawCharts);

            function drawCharts() {
                drawLineChart();
                drawPieChart();
                drawBarChart();
            }

            function createDataForTimeline() {
                let arr = [];
                for (let hit of hits) {
                    console.log(new Date(hit.hit_timestamp));
                    arr.push([new Date(hit.hit_timestamp), 1]);
                }

                let dt = google.visualization.arrayToDataTable([
                    ['Time', 'Hits'],
                    ...arr
            ]);

                return google.visualization.data.group(dt, [0], [
                    {
                        column: 1,
                        aggregation: google.visualization.data.sum,
                        type: 'number'
                    }
                ]);
            }

            function createData($tableHeader) {
                let arr = [];
                for (let hit of hits) {
                    arr.push([hit.location, 1]);
                }

                let dt = google.visualization.arrayToDataTable([
                    $tableHeader,
                    ...arr
            ]);

                return google.visualization.data.group(dt, [0], [
                    {
                        column: 1,
                        aggregation: google.visualization.data.sum,
                        type: 'number'
                    }
                ]);
            }

            function drawBarChart() {
                let data = createData(['Locations', 'Hits']);

                let options = {
                    title: 'Demographics',
                    chartArea: {width: '50%'},
                    colors: ['#FF7300', '#383A38', '#FFC799'],
                    hAxis: {
                        title: 'Locations',
                        minValue: 0
                    },
                    vAxis: {
                        title: 'Hits'
                    },
                    orientation: 'horizontal',
                    legend: { position: 'none' }
                };

                let chart = new google.visualization.BarChart(document.getElementById('age-graph'));
                chart.draw(data, options);
            }

            function drawPieChart() {
                let data = createData(['Location', 'Hits']);

                // Set chart options
                let options = {
                    title:'Location',
                    colors: ['#FF7300', '#F47F20','#484A48', '#383A38', '#292B29']
                };

                // Instantiate and draw our chart, passing in some options.
                let chart = new google.visualization.PieChart(document.getElementById('gender-graph'));
                chart.draw(data, options);
            }

            function drawLineChart() {
                let data = createDataForTimeline();

                let options = {
                    title: 'Timestamp',
                    curveType: 'function',
                    legend: {position: 'none'},
                    colors: ['#FF7300'],
                    explorer: {
                        axis: 'horizontal',
                        actions: ['dragToZoom', 'rightClickToReset']
                    },
                    vAxis: {
                        minValue: 0
                    },
                    gridlines: { count: -1},
                    library: {hAxis: { format: "hh. mm." } }
                };

                let chart = new google.visualization.LineChart(document.getElementById('time-graph'));

                let formatter = new google.visualization.DateFormat({formatType: 'long'});

                formatter.format(data, 0);

                chart.draw(data, options);
            }

        }())
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDpj9D7dDRll2Cj-sTXzPEVwoCwx7LOjXw"
            async defer></script>
@endsection
