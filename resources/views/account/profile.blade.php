@extends('layouts.app')

@section('main')
<div class="container">
    <div class="row my-5">
        <div class="col-md-3">
            @include('layouts.sidebar')
        </div>
        <div class="col-md-9">
            @include('layouts.message')
            <div class="card border-0 shadow">
                <div class="card-header  text-white">
                    Profile
                </div>
                <div class="card-body">
                    <form action="{{route('account.updateProfile')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" value="{{old('name' ,$user->name)}}"
                                class="form-control @error('name') is-invalid @enderror" placeholder="Name" name="name"
                                id="" />
                            @error('name')
                            <p class="invalid-feedback">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Email</label>
                            <input type="text" value="{{old('email' ,$user->email)}}"
                                class="form-control @error('email') is-invalid @enderror" placeholder="Email"
                                name="email" id="email" />
                            @error('email')
                            <p class="invalid-feedback">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Bio</label>
                            <input type="text" value="{{old('bio' ,$user->bio)}}"
                                class="form-control @error('bio') is-invalid @enderror" placeholder="Bio"
                                name="bio" id="bio" />
                            @error('bio')
                            <p class="invalid-feedback">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Image</label>
                            <input type="file" name="img" id="img"
                                class="form-control @error('img') is-invalid @enderror">
                            <img src="{{ asset('uploads/profile/thumb/' . ($user->img ?? 'no_image.jpg')) }}"
                                class="img-fluid mt-4 rounded-circle" alt="{{ $user->name }}">
                            @error('img')
                            <p class="invalid-feedback">{{$message}}</p>
                            @enderror
                        </div>
                        <button class="btn btn-primary mt-2">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection