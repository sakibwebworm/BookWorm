@extends('layouts.layout')
@section('content')

    {{--Vue app--}}
    <div id="app">
        <singlebook-component id="{{$id}}" @if(auth::check()) saved="{{$saved}}" @else saved="forceToLogIn" @endif></singlebook-component>
    </div>

@endsection
