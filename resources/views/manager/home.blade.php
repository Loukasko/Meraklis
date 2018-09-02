@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <div class="card text-center">
                    <div class="card-header">Καλώς την</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        You are logged in as Manager!

                        <div class="container">
                            <div class="row">
                                <div class="align-middle">
                                    {{--@if(  Auth::user('manager')->status == 0 )--}}
                                        {{--<a href="{{ url('lawbreaker/home/change-status') }}" class="btn btn-danger"--}}
                                           {{--aria-pressed="false" id="btn-sample">Ανενεργός</a>--}}
                                    {{--@else--}}
                                        {{--<a href="{{ url('lawbreaker/home/change-status') }}" class="btn btn-success"--}}
                                           {{--aria-pressed="false" id="btn-sample">Ενεργός</a>--}}
                                    {{--@endif--}}

                                    {{Auth::user('manager')->name}}

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
