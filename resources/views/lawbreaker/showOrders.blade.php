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
                                Πατήστε ενεργός για να δεχτείτε παραγγελία
                        @else

                        @foreach($orders as $order)
                            @if(($order->lawbreaker_id==Auth::user('lawbreaker')->id) && ($order->status!=1))

                                @foreach($stores as $store)
                                    @if($store['storeId']==$order['store_id'])
                                        <div id="store-lat" style="display: none">{{$store['loc_lat']}}</div>
                                        <div id="store-lng" style="display: none">{{$store['loc_long']}}</div>
                                        @break
                                    @endif
                                @endforeach

                                <ul class="list-group">
                                    <li class="list-group-item">Διεύθυνση Καταστήματος: {{ $store['address'] }}</li>
                                    <li class="list-group-item">Διεύθυνση Παράδοσης: {{ $order['address'] }}</li>
                                    <li class="list-group-item">Παραλαβή Παραγγελίας: {{ $order['created_at'] }}</li>
                                    <li class="list-group-item">
                                        <button class="btn-sm btn-link" id="directions">Εμφάνιση οδηγιών</button>
                                    </li>
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
                                @break
                            @endif
                            @if(empty($order))
                                aaaaaaaaaaaaaaa
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

                function initMap() {
                    var directionsService = new google.maps.DirectionsService;
                    var directionsDisplay = new google.maps.DirectionsRenderer;

                    var latLng = {lat: 38.2460473, lng: 21.7348710};
                    var map = new google.maps.Map(document.getElementById('map'), {
                        center: latLng,
                        zoom: 15
                    });
                    directionsDisplay.setMap(map);
                    var onClickHandler = function () {
                        calculateAndDisplayRoute(directionsService, directionsDisplay);
                    }
                    document.getElementById('directions').addEventListener("click", onClickHandler);
                }

                function calculateAndDisplayRoute(directionsService, directionsDisplay) {
                    //var startLatLng = new google.maps.LatLng(38.2460473, 21.7348710);
                    var startLatLng = new google.maps.LatLng(document.getElementById('store-lat').innerHTML, document.getElementById('store-lng').innerHTML);

                    var endLatLng = new google.maps.LatLng(document.getElementById('lat').innerHTML, document.getElementById('lng').innerHTML);
                    directionsService.route({
                        origin: startLatLng,
                        destination: endLatLng,
                        travelMode: 'DRIVING'
                    }, function (response, status) {
                        if (status === 'OK') {
                            directionsDisplay.setDirections(response);
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
