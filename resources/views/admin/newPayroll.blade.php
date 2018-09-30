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
                        <div class="container">

                            {{--<form title="Εξαγωγή Μισθοδοσίας">--}}
                            <form method="POST" action="{{ route('admin.payroll') }}" aria-label="{{ __('Payroll') }}">
                                    @csrf

                                <div class="form-group form-control-lg">
                                    <label for="selectYear">Επιλέξτε Χρονολογία</label>
                                    <select class="form-control form-control-lg" id="selectYear" name="selectYear">
                                        <option>2017</option>
                                        <option>2018</option>
                                        <option>2019</option>
                                    </select>
                                </div>
                                <div class="form-group form-control-lg">
                                    <label for="selectMonth">Επιλέξτε Μήνα</label>
                                    <select multiple class="form-control" id="selectMonth" name="selectMonth">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>6</option>
                                        <option>7</option>
                                        <option>8</option>
                                        <option>9</option>
                                        <option>10</option>
                                        <option>11</option>
                                        <option>12</option>
                                    </select>
                                </div>
                                {{--<div class="form-group">--}}
                                {{--<label for="exampleTextarea">Example textarea</label>--}}
                                {{--<textarea class="form-control" id="exampleTextarea" rows="3"></textarea>--}}
                                {{--</div>--}}
                                <button type="submit" class="btn btn-danger">
                                    {{ __('Εξαγωγή Μισθοδοσίας') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
