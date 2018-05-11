@extends('layouts.layout')

@section('content')
    {{--Vue app--}}
<div id="app">
    <book-component></book-component>
</div>
@endsection

@section('pageRelatedjs')
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/js/app.js"></script>
@endsection