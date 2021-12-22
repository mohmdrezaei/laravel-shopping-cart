@extends('dashboard.app')
@section('title','product index')
@section('main')
    <div class="container mt-5">
        <div class="row justify-content-center ">
            <div class="col-lg-8" >
                <div class="card-custom-1">
                    <div class="row m-4">
                    <div class="table-responsive ">
                    <table class="table caption-top ">
                        <caption >
                            Product Index
                            <a href="{{route('dashboard.product.create')}}" class="btn btn-success btn-shadow d-inline-block float-end">new +</a>
                        </caption>

                        <thead>
                        <tr >
                            <th scope="col">title</th>
                            <th scope="col">price</th>
                            <th scope="col">image</th>
                            <th>edit</th>
                            <th>delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                        <tr >

                            <td>{{$product->title}}</td>
                            <td>{{$product->price}}</td>
                            <td><img src="{{$product->imageShow}}" alt="" class="table-img"></td>
                            <td>
                                <a href="{{route('dashboard.product.edit',['product' =>$product->id])}}" class="btn btn-info btn-shadow">Edit</a>

                            </td>
                            <td>
                                <form class="d-inline-block ml-3" method="post" action="{{route('dashboard.product.destroy',['product' =>$product->id])}}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-shadow">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-auto">
                            {{$products->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
