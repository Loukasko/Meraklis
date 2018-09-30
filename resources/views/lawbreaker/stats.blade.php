@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <div class="card text-center">
                    <div class="card-header">Πληροφορίες</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <ul class="list-group">
                            <li class="list-group-item">Όνομα: {{ Auth::user('lawbreaker')->name }}</li>
                            <li class="list-group-item">Επώνυμο: {{ Auth::user('lawbreaker')->surname }}</li>
                            <li class="list-group-item">ΑΦΜ: {{ Auth::user('lawbreaker')->AFM }}</li>
                            <li class="list-group-item">ΑΜΚΑ: {{ Auth::user('lawbreaker')->AMKA }}</li>
                            <li class="list-group-item">IBAN: {{ Auth::user('lawbreaker')->IBAN }}</li>
                            <li class="list-group-item">Μισθοδοσία: {{ Auth::user('lawbreaker')->salary }}</li>
                            <li class="list-group-item">Σύνολο διαδρομών σήμερα: {{ Auth::user('lawbreaker')->ridesToday }}</li>
                            <li class="list-group-item">Χιλιόμετρα σήμερα: {{ Auth::user('lawbreaker')->km_today }}</li>
                            <li class="list-group-item">Χιλιόμετρα συνολικά: {{ Auth::user('lawbreaker')->km_monthly }}</li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
