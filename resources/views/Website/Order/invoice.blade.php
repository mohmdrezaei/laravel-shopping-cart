@extends('website.app')
@section('title','cart')
@section('main')
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            @if($cart->count > 0)
                <div class="col-lg-11">
                    <div class="card-custom-3">
                        <div class="table-responsive">
                            <table class="table align-middle cart-table">
                                <thead>
                                <th scope="col">num</th>
                                <th scope="col">Product</th>
                                <th scope="col">Count</th>
                                <th scope="col">Unit price</th>
                                <th scope="col">Total price</th>
                                <th scope="col">#</th>
                                </thead>

                                <tbody>
                                @foreach($cart->products as $key=>$item)
                                    <tr>
                                        <td>{{$key +1}}</td>
                                        <td>
                                            <a href="{{$item['product']->hrefUrl}}">
                                                <img src="{{$item['product']->imageShow}}" class="item-icon">
                                                <span class="title">{{$item['product']->title}}</span>
                                            </a>
                                        </td>

                                        <td>
                                            <form action="{{route('updateCart',['product'=>$item['product']->id])}}"
                                                  method="post">
                                                @csrf
                                                @method('PATCH')
                                                <div class="d-inline-block me-1">
                                                    <input type="number" class="form-control" name="count" id="count"
                                                           value="{{$item['count']}}">
                                                </div>
                                                <div class="d-inline-block">
                                                    <button type="submit" class="btn btn-warning btn-shadow">update
                                                    </button>
                                                </div>
                                            </form>
                                        </td>

                                        <td>
                                            {{$item['product']->priceShow}} $
                                        </td>
                                        <td>
                                            {{number_format($item['product']->price *$item['count'])}} $
                                        </td>

                                        <td>
                                            <form action="{{route('removeFromCart',['product'=>$item['product']->id])}}"
                                                  method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-shadow">Remove</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>


                        <div class="row justify-content-end mt-3">
                            <div class="col-auto">
                                {{number_format($cart->price)}} $
                            </div>
                        </div>

                        <div class="border p-3">
                            @if(!is_null($cart->address))
                                {{$cart->address}}
                            @else
                                هیج آدرسی ثبت نکردید !
                                <div class="row">
                                    <div class="col-12">
                                        <form action="{{route('addAddress')}}" method="post">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="address" class="form-label">Address</label>
                                                <textarea class="form-control" name="address" id="address" placeholder="Address"></textarea>
                                            </div>
                                            <div class="">
                                                <button class="btn btn-success btn-shadow" >Invoice</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endif

                        </div>
                        @if(!is_null($cart->address))
                            <div class="mt-3">
                            <form action="{{route('orderStore')}}" method="post">
                                @csrf
                                <button class="btn btn-success btn-shadow">Send ({{number_format($cart->price)}} $)</button>
                            </form>
                            </div>
                        @endif

                    </div>
                </div>
            @else
                <div class="col-lg-7">
                    <div class="card">
                        <h3 class="text-danger p-5">هیچ محصولی در سبد خرید شما وجود ندارد!</h3>
                        <a class="m-4" href="{{route('home')}}">صفحه اصلی</a>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

