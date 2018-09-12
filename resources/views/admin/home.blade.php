@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <div class="card text-center">
                    <div class="card-header">Γεια σας {{Auth::user('admin')->username}}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="container">
                            <a href="{{ url('admin/home/payroll') }}" class="btn-sm btn-success"
                               aria-pressed="false">Payroll</a>

                            <a href="{{ url('admin/home/new-store') }}" class="btn-sm btn-success"
                               aria-pressed="false">Καταχώρηση Καταστήματος</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
