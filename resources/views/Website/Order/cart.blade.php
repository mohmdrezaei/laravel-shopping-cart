@extends('website.app')
@section('title','cart')
@section('main')
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center cart-none">
            @if($cart->count > 0)
                <div class="col-lg-11">
                    <div class="card-custom-3">
                        <div class="table-responsive">
                            <table class="table align-middle cart-table" id="cart_product">
                                <thead>
                                <th scope="col">num</th>
                                <th scope="col">Product</th>
                                <th scope="col">Count</th>

                                <th scope="col">Unit price</th>
                                <th scope="col">Total price</th>
                                <th scope="col">#</th>
                                <th scope="col">delete</th>
                                </thead>

                                <tbody>
                                @foreach($cart->products as $key=>$item)
                                    <tr >
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

                                        <td>
                                            <form action="{{route('removeFromCart',['product'=>$item['product']->id])}}"
                                                  method="POST" class="ajax-remove" data-id="{{$item['product']->id}}">
                                                @csrf
                                                <button class="btn btn-danger btn-shadow">Remove with AJAX</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="row justify-content-end mt-3">
                            <div class="col-auto price-kol">
                                {{number_format($cart->price)}} $
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <form action="{{route('addAddress')}}" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Address</label>
                                        <textarea class="form-control" name="address" id="address"
                                                  placeholder="Address"></textarea>
                                    </div>
                                    <div class="">
                                        <button class="btn btn-success btn-shadow">Invoice</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="col-lg-7 ">
                    <div class="card">
                        <h3 class="text-danger p-5">!هیچ محصولی در سبد خرید شما وجود ندارد</h3>
                        <a class="m-4" href="{{route('home')}}">صفحه اصلی</a>
                    </div>
                </div>
            @endif
        </div>@section('js')
            <script>
                $(document).ready(function () {
                    $(document).on('submit',".ajax-remove",function (e) {
                        e.preventDefault();
                        var id = $(this).data("id");
                        $.ajax({
                            url:$(this).attr("action"),
                            type:"DELETE",
                            data:{
                                ajax:true,
                                '_method': 'delete',
                            },
                            dataType:"JSON",
                            success:function (res) {
                                $("#cart_product").load(window.location + " #cart_product");

                                $("#cart-qty").removeClass('d-none').html(res.count)
                                $(".price-kol").html(res.price)
                                if(res.count < 1 ){
                                $('.cart-none').html("<div class=\"col-lg-7 \">\n" +
                                    "                    <div class=\"card\">\n" +
                                    "                        <h3 class=\"text-danger p-5\">!هیچ محصولی در سبد خرید شما وجود ندارد</h3>\n" +
                                    "                        <a class=\"m-4\" href=\"{{route('home')}}\">صفحه اصلی</a>\n" +
                                    "                    </div>\n" +
                                    "                </div>");
                                    $("#cart-qty").removeClass('qty').html("")
                                }
                            },
                            error:function (res) {
                              console.log(2)
                            }
                        })
                    })
                })
            </script>
        @endsection
    </div>
@endsection

