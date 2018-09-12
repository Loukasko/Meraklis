@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <div class="card text-center">
                    <div class="card-header">Καλώς την</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif


                        <div class="row">
                            <div class="col-sm">
                                @if(  Auth::user('lawbreaker')->status == 0 )
                                    <a href="{{ url('lawbreaker/home/change-status') }}" class="btn-sm btn-danger"
                                       aria-pressed="false" id="btn-sample">Ανενεργός</a>
                                @else
                                    <a href="{{ url('lawbreaker/home/change-status') }}" class="btn-sm btn-success"
                                       aria-pressed="false" id="btn-sample">Ενεργός</a>
                                @endif
                            </div>
                            <div class="col-sm">
                                <form action="POST" id="getLocation">
                                    <button type="button" id="btn_success" class="btn btn-success btn-sm">Επιλογή τοποθεσίας</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <input id="searchInput" class="controls" type="text" placeholder="Enter a location">
                <div id="map" style="height:500px"></div>
                <ul id="geoData">
                    <li>Full Address: <span id="location"></span></li>
                    <li>Latitude: <span id="lat"></span></li>
                    <li>Longitude: <span id="lng"></span></li>
                </ul>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">

        var geocoder;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function initMap() {
            var latLng = {lat: 38.2460473, lng: 21.7348710};
            var map = new google.maps.Map(document.getElementById('map'), {
                center: latLng,
                zoom: 15
            });
            var input = document.getElementById('searchInput');
            map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

            var options = {
                componentRestrictions: {country: 'gr'}
            };
            var autocomplete = new google.maps.places.Autocomplete(input, options);
            autocomplete.bindTo('bounds', map);

            var infowindow = new google.maps.InfoWindow();
            var marker = new google.maps.Marker({
                map: map,
                //  anchorPoint: new google.maps.Point(0, -29),
                draggable: true,
                position: latLng,
                animation: google.maps.Animation.DROP
            });

            geocoder = new google.maps.Geocoder();
            google.maps.event.addListener(marker, 'drag', function () {
                var point = marker.getPosition();
                geocoder.geocode({'latLng': marker.getPosition()}, function (results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        if (results[0]) {
                            document.getElementById('lat').innerHTML = point.lat();
                            document.getElementById('lng').innerHTML = point.lng();
                        }
                        document.getElementById('btn_success').style.display = "block";

                        $('#getLocation').click(function(event){
                            var address = 'marker';
                            var lat = point.lat();
                            var lng = point.lng();
                            $.post('home/get-location',{'address':address,'lat': lat,'lng':lng,'_token':$('input[name=_token]').val()},function(data){
                                console.log(data);
                                window.location.assign('home/show-orders');

                            });
                        })
                    }
                });
                // document.getElementById('btn_success').style.display = "block";
            });

            autocomplete.addListener('place_changed', function() {
                infowindow.close();
                marker.setVisible(false);
                var place = autocomplete.getPlace();
                if (!place.geometry) {
                    window.alert("Choose a location from the drop-down menu or use the marker");
                    return;
                }

                // If the place has a geometry, then present it on a map.
                if (place.geometry.viewport) {
                    map.fitBounds(place.geometry.viewport);
                } else {
                    map.setCenter(place.geometry.location);
                    map.setZoom(17);
                }
                marker.setIcon(({
                    url: place.icon,
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(35, 35)
                }));
                marker.setPosition(place.geometry.location);
                marker.setVisible(true);

                var address = '';
                if (place.address_components) {
                    address = [
                        (place.address_components[0] && place.address_components[0].short_name || ''),
                        (place.address_components[1] && place.address_components[1].short_name || ''),
                        (place.address_components[2] && place.address_components[2].short_name || '')
                    ].join(' ');
                }

                infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
                infowindow.open(map, marker);

                var address = place.formatted_address;
                document.getElementById('location').innerHTML = place.formatted_address;
                document.getElementById('lat').innerHTML = place.geometry.location.lat();
                document.getElementById('lng').innerHTML = place.geometry.location.lng();
                document.getElementById('btn_success').style.display = "block";

                $('#getLocation').click(function(event){
                    var lat = place.geometry.location.lat();
                    var lng = place.geometry.location.lng();
                    $.post('home/get-location',{'address':address,'lat': lat,'lng':lng,'_token':$('input[name=_token]').val()},function(data){
                        console.log(data);
                        window.location.assign('home/show-orders');
                    });

                });

            });

        }


    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBNvM3cspDODEWniOMkvT4qMxSK4SvZ4-A&libraries=places&callback=initMap" async defer></script>


@endsection
