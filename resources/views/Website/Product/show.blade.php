@extends('Website.app')
@section('title','show')
@section('main')
    <div class="container mt-4 ">
        <div class="row justify-content-center p-3 p-md-5 cart-back">
            <div class="col-12 col-md-6 ">

                <img src="{{$product->imageShow}}" class="card-img-top" alt="...">
            </div>

            <div class="col-12 col-md-6 mt-3 mt-md-0">
                <div class="content">
                    <div class="title">
                        <h1> {{$product->title}}</h1>
                        <div class="btn-cart footer">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-auto">
                                    {{$product->price}} $
                                </div>

                                <div class="col-auto">
                                    <form action="{{route('addToCart',['product'=>$product->id])}}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">add to cart</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="lead">
                        <p>{{$product->body}}</p>
                    </div>
                </div>
            </div>


        </div>
    </div>


@endsection
