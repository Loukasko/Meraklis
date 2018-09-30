@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <div class="card text-center">
                    <div class="card-header">Καλωσήρθατε κ.{{Auth::user('lawbreaker')->name}}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="row justify-content-around">
                            <div class="col-sm-auto">
                                @if(  Auth::user('lawbreaker')->status == 0 )
                                    <a href="{{ url('lawbreaker/home/change-status') }}" class="btn-sm btn-danger"
                                       aria-pressed="false" id="btn-sample">Ανενεργός</a>
                                @else
                                    <a href="{{ url('lawbreaker/home/change-status') }}" class="btn-sm btn-success"
                                       aria-pressed="false" id="btn-sample">Ενεργός</a>
                                    <div id="law-lat" style="display: none">{{Auth::user('lawbreaker')->loc_lat}}</div>
                                    <div id="law-lng" style="display: none">{{Auth::user('lawbreaker')->loc_long}}</div>
                                @endif
                            </div>
                            <div class="col-sm-auto">
                                <a href="{{ url('lawbreaker/home/fetch-order') }}" class="btn-sm btn-success"
                                   aria-pressed="false" id="btn-sample">Αναζήτηση νέας παραγγελίας</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card text-center">
                    <div class="card-header">Τρέχουσα παραγγελία</div>
                    <div class="card-body">

                        @if(session()->has('msg'))
                            <div class="alert alert-danger">
                                {{ session()->get('msg') }}
                            </div>
                        @endif

                        @if(Auth::user('lawbreaker')->status==0)
                                <div class="alert alert-danger">
                                    Πατήστε ενεργός για να δεχτείτε παραγγελία
                                </div>
                        @else
                            @foreach($orders as $order)
                                @if(($order->lawbreaker_id==Auth::user('lawbreaker')->id) && ($order->status!=1))

                                    @foreach($stores as $store)
                                        @if($store['id']==$order['store_id'])

                                            <div id="store-lat" style="display: none">{{$store['loc_lat']}}</div>
                                            <div id="store-lng" style="display: none">{{$store['loc_long']}}</div>
                                            @break
                                        @endif
                                    @endforeach

                                    <ul class="list-group">
                                        <li class="list-group-item">Διεύθυνση Καταστήματος: {{ $store['address'] }}</li>
                                        <li class="list-group-item">Διεύθυνση Παράδοσης: {{ $order['address'] }}</li>
                                        <li class="list-group-item">Παραλαβή
                                            Παραγγελίας: {{ $order['created_at'] }}</li>

                                        <li class="list-group-item">
                                            {{--<a href="{{ url('lawbreaker/home/delivered}',['order_id'=]) }}"--}}
                                            <a href="{{ route('lawbreaker.delivered',['order_id'=>$order['id']]) }}"
                                               class="btn-sm btn-success"
                                               aria-pressed="false"
                                               id="btn-sample">Παραδόθηκε
                                            </a>
                                        </li>
                                    </ul>

                                    <div id="lat" style="display: none">{{$order['lat']}}</div>
                                    <div id="lng" style="display: none">{{$order['lng']}}</div>
                                    <div id="map" style="height:500px"></div>
                                    <div id="directions-panel"></div>

                                    <div id="dist" style="display: none"></div>
                                        @break
                                @endif

                            @endforeach
                        @endif

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function initMap() {
            var directionsService = new google.maps.DirectionsService;
            var directionsDisplay = new google.maps.DirectionsRenderer;

            var latLng = {lat: 38.2460473, lng: 21.7348710};
            var map = new google.maps.Map(document.getElementById('map'), {
                center: latLng,
                zoom: 15
            });
            directionsDisplay.setMap(map);
            calculateAndDisplayRoute(directionsService, directionsDisplay);
        }

        function calculateAndDisplayRoute(directionsService, directionsDisplay) {
            var startLatLng = new google.maps.LatLng(document.getElementById('law-lat').innerHTML, document.getElementById('law-lng').innerHTML);
            var mid = new google.maps.LatLng(document.getElementById('store-lat').innerHTML, document.getElementById('store-lng').innerHTML);

            var endLatLng = new google.maps.LatLng(document.getElementById('lat').innerHTML, document.getElementById('lng').innerHTML);
            var waypts = [];

            waypts.push({
                location: mid,
                stopover: true
            });
            directionsService.route({
                origin: startLatLng,
                destination: endLatLng,
                waypoints:waypts,
                optimizeWaypoints:true,
                travelMode: 'DRIVING'
            }, function (response, status) {
                if (status === 'OK') {
                    directionsDisplay.setDirections(response);
                    var route = response.routes[0];
                    var summaryPanel = document.getElementById('directions-panel');
                    summaryPanel.innerHTML = '';
                    let dist=0;
                    // For each route, display summary information.
                    for (var i = 0; i < route.legs.length; i++) {
                        var routeSegment = i + 1;
                        summaryPanel.innerHTML += '<b>Υποδιαδρομή : ' + routeSegment +
                            '</b><br>';
                        summaryPanel.innerHTML += route.legs[i].start_address + ' to ';
                        summaryPanel.innerHTML += route.legs[i].end_address + '<br>';
                        summaryPanel.innerHTML += route.legs[i].distance.text + '<br><br>';
                        route.legs[i].distance.text=route.legs[i].distance.text.replace(/\D/g,'');
                        dist = dist + Number(route.legs[i].distance.text);
                    }
                    document.getElementById('dist').innerHTML=dist/10;
                    //$.post('home/get-location',{'address':address,'lat': lat,'lng':lng,'_token':$('input[name=_token]').val()},function(data){
                    $.get("get-distance/",{'dist':dist,'_token':$('input[name=_token]').val()},function(){
                        //alert("Data: " + data + "\nStatus: " + status);
                        console.log('response');
                    });
                    //window.location='get-distance/'+dist;
                } else {
                    window.alert('Directions request failed due to ' + status);
                }
            });
        }

    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBNvM3cspDODEWniOMkvT4qMxSK4SvZ4-A&libraries&callback=initMap">
    </script>


@endsection
