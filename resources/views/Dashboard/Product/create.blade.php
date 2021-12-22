@extends('dashboard.app')
@section('title','product create')
@section('main')
    <div class="container mt-5">
        <div class="row justify-content-center ">
            <div class="col-lg-6" >
                <div class="card-custom-1">
                    <form  class="p-4" action="{{route('dashboard.product.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="" placeholder="title" value="{{old('title')}}">
                            @error('title')
                            <div id="invalid-title" class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" id="" placeholder="price" value="{{old('price')}}">
                            @error('price')
                            <div id="invalid-price" class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="body" class="form-label">Body</label>
                            <textarea name="body" id="body"  class="form-control " cols="10" rows="4">{{old('body')}}</textarea>
                        </div>

                        <div class="mb-3">
                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" >
                            @error('image')
                            <div id="invalid-image" class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary btn-shadow">send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
