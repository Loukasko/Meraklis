@extends('layouts.master')

@section('title')
    Laravel Shopping Cart
@endsection

@section('styles')

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    {{--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBNvM3cspDODEWniOMkvT4qMxSK4SvZ4-A&libraries=places&callback=initialize" async defer></script>--}}

    <style>

        body,html{
            min-height: 100%;
        }
        body:before {
            content: '';
            position: fixed;
            width: 100vw;
            height: 100vh;
            background-image:url(http://wallpapersdsc.net/wp-content/uploads/2016/09/Coffee-Beans-Photos.jpeg);
            background-position: center center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            -webkit-filter: blur(3px);
            -moz-filter: blur(3px);
            -o-filter: blur(3px);
            -ms-filter: blur(3px);
            filter: blur(3px);
            z-index: -9;
        }

        #map {
            width: 100%;
            height: 650px;
            margin-top: 25px;
        }

        .controls {
            margin-top: 10px;
            border: 1px solid transparent;
            border-radius: 2px 0 0 2px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            height: 32px;
            outline: none;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        }

        #searchInput {
            background-color: #fff;
            font-family: Roboto;
            font-size: 15px;
            font-weight: 300;
            margin-left: 12px;
            padding: 0 11px 0 13px;
            text-overflow: ellipsis;
            width: 50%;
        }

        #searchInput:focus {
            border-color: #4d90fe;
        }

        #btn_success {
            width: 80px;
            margin-bottom: 25px;
            display: none;
            padding: 0;
            line-height: 30px;
            text-align: center;
            margin: auto
        }

        h3 {
            text-align: center;
            color : #F6E0C4;
        }
        a{
            text-align: center;
            color : #F6E0C4;
        }

        a:hover {
            color : #F6E0C4;
        }

        #empty {
            background-color: #43240E;
            border-color: #43240E;
            opacity: 0.8;
            color: #F6E0C4;
            filter:(opacity=50);
            height: 35px;
            width: 110px;
            padding: 0;
            line-height: 30px;
            text-align: center;
            margin: auto
        }

        #empty:hover{
            background-color: #43240E;
            opacity: 1;
        }

        #empty:active {
            background-color: #43240E;
            box-shadow: 0 5px #666;
            transform: translateY(4px);
        }
        .list-group-item {
            background-color: #43240E;
            border-color: #43240E;
            opacity: 0.8;
            filter:(opacity=50);
        }

        .list-group-item span.badge {
            background-color: #F6E0C4;
            color: black;
        }

        strong {
            color: #F6E0C4;
        }

        #center {
            width: 100%;
            text-align: center;
        }

        .hide{
            display:none;
        }

    </style>
@endsection

@section('content')

    @if(Session::has('cart'))
        <div class="row">
            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                <ul class="list-group">
                    @foreach($products as $product)
                        <li class="list-group-item">
                            <span class="badge">{{ $product['qty'] }}</span>
                            <strong>{{ $product['item']['title'] }}</strong>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                <strong>Total: {{ $totalPrice }}</strong>
            </div>
        </div>
        <div id="center" class="container">
            <a href="{{ route('shop.emptyCart')}}" id="empty" class="btn btn-primary" role="button">Empty Cart</a>
        </div>
        <hr>
        <div class="row">
            <div id="btn_center" class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                {{--<button type="button" id="btn_success" class="btn btn-success">Checkout</button>--}}
                {{--<a href="{{route('shop.checkout', ['location' =>])}}" id="btn_success" class ="btn btn-success" roles="button">Send Order</a>--}}
                <form action="POST" id="checkout">
                    <button type="button" id="btn_success" class="btn btn-success">Send Order</button>
                    {{--<a href="{{route('shop.index')}}" id="btn_success" class ="btn btn-success" roles="button" value="checkout">Send Order</a>--}}
                </form>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                @if(Auth::check())
                    <h3>No Items in Cart!<br><br>
                        <a href="{{route('shop.index')}}">Buy Something First</a>
                    </h3>
                @else
                    <h3>Please Login First</h3>
                @endif
            </div>
        </div>
    @endif


    <input id="searchInput" class="controls" type="text" placeholder="Enter a location">
    <div id="map"></div>
    <ul id="geoData">
        <li>Full Address: <span id="location"></span></li>
        <li>Latitude: <span id="lat"></span></li>
        <li>Longitude: <span id="lng"></span></li>

    </ul>
    <div id="directions-panel"></div>

    aaa
    <div id="dist"></div>


@endsection

@section('scripts')

    <script type="text/javascript">

        var geocoder;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        });

        function initMap() {
            var directionsService = new google.maps.DirectionsService;
            var directionsDisplay = new google.maps.DirectionsRenderer;

            var latLng = {lat: 38.2460473, lng: 21.7348710};
            var latLngB = {lat: 37.2460473, lng: 22.7348710};
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

                        var tmp;
                        var cid = 15;
                        var closest_store = 100000;

                        $.get("{{URL::to('store/return_stores')}}", function () {
                            console.log("inout");
                        }).done(function (data) {
                            console.log(data);
                            $.each(data, function (index, subObj) {
                                console.log(subObj.id);
                                let dist = 0;
                                var LatLng = new google.maps.LatLng(subObj.loc_lat, subObj.loc_long);
                                var pelatis_LatLng = {lat: point.lat(), lng: point.lng()};
                                // var pelatis_LatLng =  new google.maps.LatLng(place.geometry.location.lat(),place.geometry.location.lng());
                                //console.log(pelatis_LatLng);
                                tmp = directionsService.route({
                                        origin: pelatis_LatLng,
                                        destination: LatLng,
                                        travelMode: 'DRIVING'
                                    }, function (response, status) {
                                        if (status === 'OK') {
                                            directionsDisplay.setDirections(response);
                                            var route = response.routes[0];
                                            var summaryPanel = document.getElementById('directions-panel');
                                            summaryPanel.innerHTML = '';
                                            dist = route.legs[0].distance.text.replace(/\D/g, '');
                                            dist = dist / 10;
                                            //alert(dist);
                                            // For each route, display summary information.
                                            if (dist < closest_store) {
                                                closest_store = dist;
                                                cid = subObj.id;
                                                $.get("closest-store/", {
                                                    'cid': cid,
                                                    '_token': $('input[name=_token]').val()
                                                }, function () {
                                                    //alert("Data: " + data + "\nStatus: " + status);
                                                    console.log(cid);
                                                });
                                                //summaryPanel.innerHTML=cid;
                                            }
                                        }
                                        else {
                                            window.alert('Directions request failed due to ' + status);
                                        }
                                    }
                                );
                            });
                        });

                        $('#checkout').click(function (event) {
                            var address = 'marker';
                            var lat = point.lat();
                            var lng = point.lng();
                            $.post('checkout', {
                                'address': address,
                                'lat': lat,
                                'lng': lng,
                                '_token': $('input[name=_token]').val()
                            }, function (data) {
                                console.log(data);
                                window.location.assign('order');
                            });
                        })
                    }
                });
                // document.getElementById('btn_success').style.display = "block";
            });

            autocomplete.addListener('place_changed', function () {
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

                var directionsService = new google.maps.DirectionsService;
                var directionsDisplay = new google.maps.DirectionsRenderer;
                //calculateAndDisplayRoute(directionsService, directionsDisplay);
                //directionsDisplay.setMap(map);

                var tmp;
                var cid = 15;
                var closest_store = 100000;
                $.get("{{URL::to('store/return_stores')}}", function () {
                    console.log("inout");
                }).done(function (data) {
                    console.log(data);
                    $.each(data, function (index, subObj) {
                        console.log(subObj.id);
                        let dist = 0;
                        var LatLng = new google.maps.LatLng(subObj.loc_lat, subObj.loc_long);
                        var pelatis_LatLng = {lat: place.geometry.location.lat(), lng: place.geometry.location.lng()};
                        // var pelatis_LatLng =  new google.maps.LatLng(place.geometry.location.lat(),place.geometry.location.lng());
                        //console.log(pelatis_LatLng);
                        tmp = directionsService.route({
                                origin: pelatis_LatLng,
                                destination: LatLng,
                                travelMode: 'DRIVING'
                            }, function (response, status) {
                                if (status === 'OK') {
                                    directionsDisplay.setDirections(response);
                                    var route = response.routes[0];
                                    var summaryPanel = document.getElementById('directions-panel');
                                    summaryPanel.innerHTML = '';
                                    dist = route.legs[0].distance.text.replace(/\D/g, '');
                                    dist = dist / 10;
                                    //alert(dist);
                                    // For each route, display summary information.
                                    if (dist < closest_store) {
                                        closest_store = dist;
                                        cid = subObj.id;
                                        $.get("closest-store/", {
                                            'cid': cid,
                                            '_token': $('input[name=_token]').val()
                                        }, function () {
                                            //alert("Data: " + data + "\nStatus: " + status);
                                            console.log('response');
                                        });
                                        //summaryPanel.innerHTML=cid;
                                    }
                                }
                                else {
                                    window.alert('Directions request failed due to ' + status);
                                }
                            }
                        );
                    });
                });

                $('#checkout').click(function (event) {
                    var lat = place.geometry.location.lat();
                    var lng = place.geometry.location.lng();
                    $.post('checkout', {
                        'address': address,
                        'lat': lat,
                        'lng': lng,
                        '_token': $('input[name=_token]').val()
                    }, function (data) {
                        console.log(data);
                    }).done(function (data) {
                        window.location.assign('order');
                    });


                });
            });
        }


    </script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBNvM3cspDODEWniOMkvT4qMxSK4SvZ4-A&libraries=places&callback=initMap"
        async defer></script>


@endsection
