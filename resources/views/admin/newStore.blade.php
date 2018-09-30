@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card text-center">
                    <div class="card-header">Καταχώρηση Καταστήματος και Υπεύθυνων</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('admin.newStore') }}" aria-label="{{ __('NewStore') }}">
                            @csrf
                            @if(session()->has('msg'))
                                <div class="alert alert-danger">
                                    {{ session()->get('msg') }}
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-5">
                                    <div class="alert alert-success">Καταχώρηση στοιχείων Καταστήματος</div>

                                    <div class="form-group">
                                        <label for="storeName">Όνομα Καταστήματος</label>
                                        <input type="text" class="form-control" id="storeName" name="storeName">
                                    </div>
                                    <div class="form-group">
                                        <label for="storeAddress">Διεύθυνση</label>
                                        <input type="text" class="form-control" id="storeAddress" name="storeAddress">
                                    </div>
                                    <div class="form-group">
                                        <label for="storePhone">Τηλέφωνο</label>
                                        <input type="text" class="form-control" id="storePhone" name="storePhone">
                                    </div>
                                    <div class="form-group">
                                        <label for="storeLat">Latitude</label>
                                        <input type="text" class="form-control" id="storeLat" name="storeLat">
                                    </div>
                                    <div class="form-group">
                                        <label for="storeLng">Longitude</label>
                                        <input type="text" class="form-control" id="storeLng" name="storeLng">
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="alert alert-success">Καταχώρηση νέου Υπεύθυνου</div>

                                    <div class="form-group">
                                        <label for="managerName">Όνομα Υπεύθυνου</label>
                                        <input type="text" class="form-control" id="managerName" name="managerName">
                                    </div>
                                    <div class="form-group">
                                        <label for="managerLastName">Επώνυμο</label>
                                        <input type="text" class="form-control" id="managerLastName" name="managerLastName">
                                    </div>
                                    <div class="form-group">
                                        <label for="managerUsername">username</label>
                                        <input type="text" class="form-control" id="managerUsername" name="managerUsername">
                                    </div>
                                    <div class="form-group">
                                        <label for="managerPassword">password</label>
                                        <input type="password" class="form-control" id="managerPassword" name="managerPassword">
                                    </div>
                                    <div class="form-group">
                                        <label for="managerAmka">ΑΜΚΑ</label>
                                        <input type="text" class="form-control" id="managerAmka" name="managerAmka">
                                    </div>
                                    <div class="form-group">
                                        <label for="managerAfm">ΑΦΜ</label>
                                        <input type="text" class="form-control" id="managerAfm" name="managerAfm">
                                    </div>
                                    <div class="form-group">
                                        <label for="managerIban">IBAN</label>
                                        <input type="text" class="form-control" id="managerIban" name="managerIban">
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="alert alert-success">ή Επιλογή από ήδη καταχωρημένους</div>
                                    <div class="form-group form-control-lg" >
                                        <label for="chooseManager">Επιλέξτε υπεύθυνο</label>
                                        <select multiple class="form-control" id="chooseManager" name="chooseManager">
                                            @foreach($managers as $manager)
                                            <option>{{$manager->name}}  {{ $manager->surname}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="checkChoose" name="checkChoose">
                                        <label class="form-check-label" for="checkChoose">Επιλογή από ήδη καταχωρημένους</label>
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
