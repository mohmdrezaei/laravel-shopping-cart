@extends('Website.app')
@section('title','login')
@section('main')
    <div class="container  ">
        <div class="row vh-100 align-items-center justify-content-center">

            <div class="col-lg-4">
                <div class="card card-custom-reg">
                    <div class="card-title mt-4 ">
                        <h1 class="title-custom text-center mb-2 pb-4 ">login</h1>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('loginSubmit') }}" method="post">
                            @csrf


                            <div class="form-group mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" value="{{ old('email') }}" id="email" name="email"
                                       class="form-control @error('email') is-invalid @enderror "
                                       aria-describedby="invalid-email">
                                @error('email')
                                <div id="invalid-email" class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3" style="position:relative;">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" id="password" name="password"
                                       class="form-control @error('password') is-invalid @enderror "
                                       aria-describedby="invalid-password">
                                <span class="material-icons eye  " onclick="myFunction()">
                                   visibility
                               </span>
                                @error('password')
                                <div id="invalid-password" class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="justify-content-start">
                                <label class="checkbox rtl ">
                                    <input type="checkbox" class="" name="remember"
                                           id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    remember me
                                </label>
                            </div>
                            <div class="mb-3 d-flex justify-content-center">

                                <button type="submit" class="btn btn-lg btn-danger mt-3 btn-reg">login</button>
                            </div>

                            <div class="mb-3 border-top pt-3">

                                <a href="{{route('register')}}" > <span class="material-icons person-add">
person_add
</span> Register</a>

                            </div>

                            <div class="mb-3">
                                        <a class="" href="">
                                            <span class="material-icons person-add">
lock
</span>
                                       forgot password
                                    </a>

                            </div>
                        </form>
                    </div>

                </div>
            </div>

        </div>
    </div>

@endsection

<script>
    function myFunction() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>

