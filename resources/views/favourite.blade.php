@extends('layouts.layout')

@section('content')
    <header class="masthead text-white text-center backgroundpic pt-5 pb-5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-xl-9 mx-auto">
                    <h1 class="mb-5">A curated list of books!!</h1>
                </div>
            </div>
        </div>
    </header>
    <section class="books ">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 mx-auto">
                    <div class="row row-eq-height">
                        @foreach($Books as $book)
                            <div class="col-lg-3 col-md-3 col-sm-3 mt-3 mb-3">
                                <div>
                                    <a href="/books/{{$book->identifier}}"><img src="{{$book->picture}}" alt="image not found"></a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('pageRelatedjs')
    <script src="/vendor/jquery/jquery.min.js"></script>
@endsection
