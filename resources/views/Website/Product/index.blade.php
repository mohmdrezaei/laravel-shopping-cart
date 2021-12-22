@extends('Website.app')
@section('title','home')
@section('main')
    <div class="container mt-4 ">
        <div class="row">
            @foreach($products as $product)
                <div class=" col-md-6 col-lg-4 d-flex justify-content-center  mb-4 ">
                    <div class="card" style="width: 18rem;">
                        <a href="{{$product->hrefUrl}}">
                        <img src="{{$product->imageShow}}" class="card-img-top" alt="{{$product->title}}">
                        </a>
                        <div class="card-body">
                            <a href="{{$product->hrefUrl}}" class="title"><h5 class="card-title">{{$product->title}}</h5></a>
                            <p class="card-text">{{$product->lead}}</p>
                            <div class="footer">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto">
                                        <a href="{{$product->hrefUrl}}" class="price">{{$product->priceShow}} $</a>
                                    </div>
                                    <div class="col-auto">
                                        <form action="{{route('addToCart',['product'=>$product->id])}}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-primary btn-shadow">add to cart</button>
                                        </form>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            @endforeach

            <div class="row justify-content-center">
                <div class="col-auto">
                    {{$products->links()}}
                </div>
            </div>
        </div>
    </div>


@endsection

@section('js')
    <script >
        $(document).ready(function () {
        console.log(555)
        })
    </script>
@endsection
