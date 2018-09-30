@extends('layouts.app')
<style>
    input {
        height: 34px;
        width: 15%;
        text-align: center;
        border-radius: 3px;
        border: 1px solid transparent;
        border-top: none;
        border-bottom: 1px solid #DDD;
        box-shadow: inset 0 1px 2px rgba(0,0,0,.39), 0 -1px 1px #FFF, 0 1px 0 #FFF;
        margin-bottom: 5px;
    }
</style>
<link href="{{ asset('css/custom.css') }}" rel="stylesheet">



@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <div class="card text-center">
                    <div class="card-header">Resupply</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{route('manager.update')}}" method="POST">
                            @csrf
                            @foreach($products as $product)
                                <div id="resupply_row" class="row">
                                    <h3 id="stock_h3"> {{$product['title']}} : {{$product['stock']}}</h3><br>
                                    <input type="number" name="data[]" id="number" min="0"/><br>
                                </div>
                            @endforeach
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
