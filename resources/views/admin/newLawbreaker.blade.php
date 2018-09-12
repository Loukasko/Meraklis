@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card text-center">
                    <div class="card-header">Καταχώρηση παραβάτη του κώδικα οδικής κυκλοφορίας</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('admin.newLawbreaker') }}" aria-label="{{ __('NewLawbreaker') }}">
                            @csrf
                            @if(session()->has('msg'))
                                <div class="alert alert-danger">
                                    {{ session()->get('msg') }}
                                </div>
                            @endif
                            <div class="row justify-content-center">
                                <div class="col-8">
                                    <div class="alert alert-success">Καταχώρηση νέου Παραβάτη</div>

                                    <div class="form-group">
                                        <label for="lawbreakerName">Όνομα Παραβάτη</label>
                                        <input type="text" class="form-control" id="lawbreakerName" name="lawbreakerName">
                                    </div>
                                    <div class="form-group">
                                        <label for="lawbreakerLastName">Επώνυμο</label>
                                        <input type="text" class="form-control" id="lawbreakerLastName" name="lawbreakerLastName">
                                    </div>
                                    <div class="form-group">
                                        <label for="lawbreakerUsername">username</label>
                                        <input type="text" class="form-control" id="lawbreakerUsername" name="lawbreakerUsername">
                                    </div>
                                    <div class="form-group">
                                        <label for="lawbreakerPassword">password</label>
                                        <input type="password" class="form-control" id="lawbreakerPassword" name="lawbreakerPassword">
                                    </div>
                                    <div class="form-group">
                                        <label for="lawbreakerAmka">ΑΜΚΑ</label>
                                        <input type="text" class="form-control" id="lawbreakerAmka" name="lawbreakerAmka">
                                    </div>
                                    <div class="form-group">
                                        <label for="lawbreakerAfm">ΑΦΜ</label>
                                        <input type="text" class="form-control" id="lawbreakerAfm" name="lawbreakerAfm">
                                    </div>
                                    <div class="form-group">
                                        <label for="lawbreakerIban">IBAN</label>
                                        <input type="text" class="form-control" id="lawbreakerIban" name="lawbreakerIban">
                                    </div>
                                </div>

                            </div>
                            <button type="submit" class="btn btn-success">
                                {{ __('Καταχώρηση Καταστήματος-Υπεύθυνου') }}
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

@endsection
