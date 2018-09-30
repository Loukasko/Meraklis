@extends('layouts.master')

<style>
    body,html{
        min-height: 100%;
    }
    body{
        background-image:url(http://wallpapersdsc.net/wp-content/uploads/2016/09/Coffee-Beans-Photos.jpeg);
        background-repeat: no-repeat;
        /*background-size: 100%;*/
        background-size: cover;
    }
    h3{
        color: #43240E !important;
        background-color: #F6E0C4;
        vertical-align: bottom;
        font-weight: bold;
    }
</style>
@section('content')
    <div class="imgbox">
        @if($errors->any())
            <h3>{{$errors->first()}}</h3>
        @endif
    </div>

@endsection('content')
