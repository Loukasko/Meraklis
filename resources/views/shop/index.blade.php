@extends('layouts.master')

@section('Shopping cart')

@endsection

@section('content')
    {{-- this will provide us with chunks of items --}}
    <div id="stripe">
        <h3> COFFEE AND SNACKS </h3>
    </div>
    @foreach($product->chunk(3) as $productChunk)
        <div class="row">
            @foreach($productChunk as $product)
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        {{--<div class="wrapper">--}}
                        {{--we can use this database fields like properties on the data we get back from the database cause we use eloquent--}}
                        <img src="{{ $product->imagePath }}" alt="..." class="img-responsive">
                        <div class="caption">
                            <h3>{{ $product->title }}</h3>
                            <a href="{{ route('shop.addToCart', ['id' => $product->id]) }}" id="epilogi" class="btn btn-primary" role="button"><i id="basket" class="fas fa-shopping-basket"></i> {{ $product->price }}€</a>
                        </div>
                        {{--</div>--}}
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach

@endsection
