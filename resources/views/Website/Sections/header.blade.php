<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">shopping cart</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active"  href="{{route('home')}}">Home</a>
                </li>



            </ul>
            <div class="d-flex">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    @if(auth()->check())
                    <li class="nav-item">
                        <a class="nav-link active" href="{{route('logout')}}">
                            logout
                            <i class="fas fa-sign-out-alt"></i>
                        </a>
                    </li>
                        @else
                        <li class="nav-item">
                            <a class="nav-link active" href="{{route('login')}}">
                                <i class="far fa-user"></i>
                            </a>
                        </li>
                    @endif
                    <li class="nav-item" id="basket">
                        <a class="nav-link" href="{{route('cartShow')}}">
                            <i class="fas fa-shopping-basket item-icon"></i>
                            @if($cart->count > 0)
                            <span class="qty"> {{$cart->count}}</span>
                            @endif
                        </a>
                    </li>


                </ul>
            </div>
        </div>
    </div>
</nav>
