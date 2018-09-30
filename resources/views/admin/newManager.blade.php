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
                        <form method="POST" action="{{ route('admin.newManager') }}" aria-label="{{ __('NewManager') }}">
                            @csrf

                            <div class="row justify-content-center">
                                <div class="col-8">
                                    @if(session()->has('msg'))
                                        <div class="alert alert-danger">
                                            {{ session()->get('msg') }}
                                        </div>
                                    @endif
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
