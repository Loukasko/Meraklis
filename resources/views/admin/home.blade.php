@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <div class="card text-center">
                    <div class="card-header">Καλώς τον {{Auth::user('admin')->username}} μας</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="row justify-content-around">
                            <div class="col-auto">
                                <div class="card" style="width: 18rem; height:22rem;">
                                    <img class="card-img-top" src="{{asset('imgs/fragka.jpg')}}"
                                         alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title">Payroll</h5>
                                        <p class="card-text">Παραγωγή xml αρχείου για αποστολή στη τράπεζα.</p>
                                        <a href="{{ url('admin/home/payroll') }}" class="btn btn-success"
                                           aria-pressed="false">Payroll</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="card" style="width: 18rem;height:22rem;">
                                    <img class="card-img-top" src="{{asset('imgs/cafe.jpg')}}" alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title">Κατάστημα</h5>
                                        <p class="card-text">Καταχώρηση Καταστήματος.</p>
                                        <a href="{{ url('admin/home/new-store') }}" class="btn btn-success"
                                           aria-pressed="false">Καταχώρηση Καταστήματος</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="card" style="width: 18rem;height:22rem;">
                                    <img class="card-img-top" src="{{asset('imgs/baby.jpg')}}" alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title">Υπεύθυνος</h5>
                                        <p class="card-text">Κατάχωρηση Υπεύθυνου.</p>
                                        <a href="{{ url('admin/home/new-manager') }}" class="btn btn-success"
                                           aria-pressed="false">Κατχώρηση Υπεύθυνου Καταστήματος</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-auto">
                                <div class="card" style="width: 18rem;height:22rem;">
                                    <img class="card-img-top" src="{{asset('imgs/lawbreaker.jpg')}}"
                                         alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title">Παραβάτης</h5>
                                        <p class="card-text">Καταχώρηση Παραβάτη.</p>
                                        <a href="{{ url('admin/home/new-lawbreaker') }}" class="btn btn-success"
                                           aria-pressed="false">Κατχώρηση Παραβάτη</a>
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
