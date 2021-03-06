@extends('layouts.app')

@section('styles')
    <link href="{{ asset('css/daterangepicker.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Tracking
                <small>Google maps for tracking negotiators</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li class="active">Tracking</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-6">
                    <input type="text" name="daterange" class="form-control" />
                </div>
                <div class="col-md-4">
                    <select name="user_id" id="user">
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->profile->getFullNameAttribute() }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <button class="btn btn-primary btn-block" type="button" id="filter" disabled>Submit</button>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <button class="btn-info btn-block" type="button" id="lastKnownLocation"><i class="fa fa-crosshairs"></i> Get User's Last Known Location</button>
                </div>
            </div>
            <br>
            <div id="map"></div>
        </section>
    </div>
@endsection

@section('scripts')
    <script>
        let activations, map, stepAnimation;
        let startDate = '', endDate = '';

        $('#user').selectize({
            sortField: 'text'
        });

        $('input[name="daterange"]').daterangepicker({
            timePicker: true,
            timePickerIncrement: 30,
        }, function(start, end, label) {
            console.log("A new date range was chosen: " + start.format('YYYY-MM-DD HH:mm') + ' to ' + end.format('YYYY-MM-DD HH:mm'));
            startDate = start.format('YYYY-MM-DD HH:mm');
            endDate = end.format('YYYY-MM-DD HH:mm');
        });

        function initMap() {
            // Create the map with no initial style specified.
            // It therefore has default styling.
            map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 14.6334979, lng: 121.0561233},
                zoom: 19,
                mapTypeControl: false
            });

            let contentString = '<div id="iw-container">' +
                '<div class="iw-title">Test Project</div>' +
                '<div class="iw-content">' +
                '<div class="iw-subTitle">Rina Martes</div>' +
                '</div>' +
                '<div class="iw-bottom-gradient"></div>' +
                '</div>';

            let infowindow = new google.maps.InfoWindow({
                content: contentString
            });

            let baPath = new google.maps.Polyline({
                geodesic: true,
                strokeColor: '#ff9e4a',
                strokeOpacity: 0.9,
                strokeWeight: 3
            });

            google.maps.event.addListenerOnce(map, 'idle', function() {
                $('#filter').prop('disabled', false);
                let image = '/images/marker.png';
                activations = new google.maps.Marker({
                    map: map,
                    icon: image,
                    animation: google.maps.Animation.DROP,
                    title: 'Test Project'
                });

                activations.addListener('click', function() {
                    infowindow.open(map, activations);
                    toggleBounce();
                });
            });

            google.maps.event.addListener(map, "click", function (e) {

                //lat and lng is available in e object
                let latLng = e.latLng;
                console.log(latLng.toString());
            });

            // *
            // START INFOWINDOW CUSTOMIZE.
            // The google.maps.event.addListener() event expects
            // the creation of the infowindow HTML structure 'domready'
            // and before the opening of the infowindow, defined styles are applied.
            // *
            google.maps.event.addListener(infowindow, 'domready', function() {

                // Reference to the DIV that wraps the bottom of infowindow
                let iwOuter = $('.gm-style-iw');

                /* Since this div is in a position prior to .gm-div style-iw.
                 * We use jQuery and create a iwBackground variable,
                 * and took advantage of the existing reference .gm-style-iw for the previous div with .prev().
                 */
                let iwBackground = iwOuter.prev();

                // Removes background shadow DIV
                iwBackground.children(':nth-child(2)').css({'display' : 'none'});

                // Removes white background DIV
                iwBackground.children(':nth-child(4)').css({'display' : 'none'});

                // Moves the infowindow 115px to the right.
                iwOuter.parent().parent().css({left: '115px'});

                // Moves the shadow of the arrow 76px to the left margin.
                iwBackground.children(':nth-child(1)').attr('style', function(i,s){ return s + 'left: 76px !important;'});

                // Moves the arrow 76px to the left margin.
                iwBackground.children(':nth-child(3)').attr('style', function(i,s){ return s + 'left: 76px !important;'});

                // Changes the desired tail shadow color.
                iwBackground.children(':nth-child(3)').find('div').children().css({'box-shadow': 'rgba(72, 181, 233, 0.6) 0px 1px 6px', 'z-index' : '1'});

                // Reference to the div that groups the close button elements.
                let iwCloseBtn = iwOuter.next();

                // Apply the desired effect to the close button
                iwCloseBtn.css({opacity: '1', right: '38px', top: '3px', border: '7px solid #48b5e9', 'border-radius': '13px', 'box-shadow': '0 0 5px #3990B9'});

                // If the content of infowindow not exceed the set maximum height, then the gradient is removed.
                if($('.iw-content').height() < 140){
                    $('.iw-bottom-gradient').css({display: 'none'});
                }

                // The API automatically applies 0.7 opacity to the button after the mouseout event. This function reverses this event to the desired value.
                iwCloseBtn.mouseout(function(){
                    $(this).css({opacity: '1'});
                });
            });

            $('#filter').on('click', function() {
                let userId = $('#user').val();

                $(this).prop('disabled', true);

                clearInterval(stepAnimation);

                let url = `/admin/tracking/${userId}?start=${startDate}&end=${endDate}`;
                if (! startDate) {
                    url = `/admin/tracking/${userId}`;
                }

                $.get(url, function(response) {
                    $('#filter').prop('disabled', false);

                    trackSteps(map, response.coordinates, baPath);
                });
            })

            $('#lastKnownLocation').on('click', function() {
                let userId = $('#user').val();
                $(this).prop('disabled', true);

                let url = `/admin/tracking/${userId}/last`;

                $.get(url, function(response) {
                    $('#lastKnownLocation').prop('disabled', false);

                    contentString = '<div id="iw-container">' +
                        '<div class="iw-title">Negotiator</div>' +
                        '<div class="iw-content">' +
                        `<div class="iw-subTitle">${response.user}</div>` +
                        '</div>' +
                        '<div class="iw-bottom-gradient"></div>' +
                        '</div>';

                    infowindow.setContent(contentString);

                    activations.setPosition(response.coordinates);
                    map.setCenter(response.coordinates);
                });
            })
        }

        function trackSteps(map, coordinates, baPath) {
            let step = 0;
            let numSteps = coordinates.length - 1;
            let timePerStep = 1000;
            let baCoordinates = [];

            stepAnimation = setInterval(function() {
                step += 1;

                if (step >= numSteps) {
                    clearInterval(stepAnimation);
                } else {
                    let coord = {
                        lat: coordinates[step][0],
                        lng: coordinates[step][1]
                    };

                    baCoordinates.push(coord);

                    map.setCenter(coord);
                    activations.setPosition(coord);
                    baPath.setPath(baCoordinates);
                }
            }, timePerStep);

            baPath.setMap(map);
        }

        function toggleBounce() {
            if (activations.getAnimation() !== null) {
                activations.setAnimation(null);
            } else {
                activations.setAnimation(google.maps.Animation.BOUNCE);
            }
        }
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDpj9D7dDRll2Cj-sTXzPEVwoCwx7LOjXw&callback=initMap"
            async defer></script>
@endsection