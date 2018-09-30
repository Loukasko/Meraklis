@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <div class="card text-center">

                    <div class="card-header">Καλώς τον {{Auth::user('manager')->id}}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="row justify-content-around">
                            <div class="col-auto">
                                <div class="card" style="width: 18rem;">
                                    <img class="card-img-top" src="{{asset('imgs/orders.jpg')}}"
                                         alt="Card image cap" style="height: 18rem;">
                                    <div class="card-body">
                                        <h5 class="card-title">Παραγγελίες</h5>
                                        <p class="card-text">Εμφάνιση Παραγγελιών που εκρεμμούν προς παράδοση.</p>
                                        <a href="{{ url('manager/manager_orders') }}" class="btn btn-success"
                                           aria-pressed="false">Εμφάνιση Παραγγελιών</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="card" style="width: 18rem;">
                                    <img class="card-img-top" src="{{asset('imgs/stock.jpg')}}"
                                         alt="Card image cap" style="height: 18rem;">
                                    <div class="card-body" >
                                        <h5 class="card-title">Αποθέματα</h5>
                                        <p class="card-text">Ενημερώστε το απόθεμα των προϊόντων του καταστήματος.</p>
                                        <a href="{{ url('manager/resupply') }}" class="btn btn-success"
                                           aria-pressed="false">Ενημέρωση Αποθέματος</a>
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

@endsection
