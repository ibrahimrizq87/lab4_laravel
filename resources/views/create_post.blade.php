
@extends('layout')

@section('title', 'Create Post')

@section('nav')

<ul class="nav nav-tabs mt-5">
  <li class="nav-item">
    <a class="nav-link text-dark" aria-current="page" href="{{route('posts.index')}}">Home</a>
  </li>
  <li class="nav-item">
    <a class="nav-link text-dark" href="{{route('posts.details')}}">Show All details</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="{{route('posts.index')}}">creating post</a>
  </li>

  @endsection
  

  @section('content')
<div class='container mt-5 shadow'>

    <form action="{{ route('posts.store')}}" method="POST" enctype="multipart/form-data">   
    @csrf  
    @error('title')
    <div class="alert alert-warning" role="alert">
    {{ $message }}
</div>
            @enderror



        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" >
        </div>



        @error('content')
    <div class="alert alert-warning" role="alert">
    {{ $message }}
</div>
            @enderror
        
        <div class="mb-3">
            <label for="content" class="form-label">Description</label>
            <textarea class="form-control" id="content" name="content" rows="3" placeholder="Enter description" ></textarea>
        </div>
        
        <!-- <div class="mb-3">
            <label for="creator_name" class="form-label">Creator Name</label>
            <input type="text" class="form-control" id="creator_name" name="name" placeholder="Enter creator's name" required>
        </div> -->

        @error('name')
    <div class="alert alert-warning" role="alert">
    {{ $message }}
</div>
            @enderror
        <div class="input-group mb-3">
  <select class="custom-select" name='name' id="inputGroupSelect02">

  @foreach($users as $user)
  <option value="{{$user->id}},{{$user->name}}">{{$user->name}}</option>
  @endforeach
    <!-- <option >Choose Creator</option> -->
    <!-- <option value="">One</option> -->
    

  </select>
  <div class="input-group-append">
    <label class="input-group-text" for="inputGroupSelect02">Choose Creator</label>
  </div>
</div>

@error('image')
    <div class="alert alert-warning" role="alert">
    {{ $message }}
</div>
            @enderror


        <div class="form-group">
    <label for="formControlFile1">Add post image</label>
    <input type="file" class="form-control-file" name='image' id="formControlFile1">
  </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
    </div>
    @endsection