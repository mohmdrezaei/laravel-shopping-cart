@extends('Website.app')
@section('title','register')
@section('main')
    <div class="container  ">
        <div class="row vh-100 align-items-center justify-content-center">

            <div class="col-lg-4">
                <div class="card card-custom-reg">
                    <div class="card-title mt-4 ">
                        <h1 class="title-custom text-center mb-2 pb-4 ">Register</h1>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('registerSubmit') }}" method="post">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" value="{{ old('name') }}" id="name" name="name" class="form-control @error('name') is-invalid @enderror "
                                       aria-describedby="invalid-name">
                               @error('name')
                                <div id="invalid-name" class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" value="{{ old('email') }}" id="email" name="email" class="form-control @error('email') is-invalid @enderror "
                                       aria-describedby="invalid-email">
                                @error('email')
                                <div id="invalid-email" class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3" style="position:relative;">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror "
                                       aria-describedby="invalid-password">
                                <span class="material-icons eye  " onclick="myFunction()" >
                                   visibility
                               </span>
                                @error('password')
                                <div id="invalid-password" class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="mb-3 d-flex justify-content-center">

                                <button type="submit" class="btn btn-lg btn-danger mt-3 btn-reg">register</button>
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
