


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Get Post</title>
</head>


<body>

<div class='container'>
<ul class="nav nav-tabs mt-5">
  <li class="nav-item">
    <a class="nav-link text-dark" aria-current="page" href="{{route('posts.index')}}">Home</a>
  </li>
  <li class="nav-item">
    <a class="nav-link text-dark" href="{{route('posts.details')}}">Show All details</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="{{route('posts.show',$post)}}">edit post by {{$post['creator_name']}}</a>
  </li>
</ul>
</div> 




<div class='container'>
<img class="mt-3 mb-3" src="{{ asset('uploads/' . $post->image) }}" alt="Card image cap" width = '250' height = '250'>

<form action="{{ route('posts.update',$post)}}" method="POST" enctype="multipart/form-data">   
    @csrf  
    @method('PUT')

    @error('title')
    <div class="alert alert-warning" role="alert">
    {{ $message }}
</div>
            @enderror



        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title"  value ="{{ $post->title }}" name="title" placeholder="Enter title" >
        </div>



        @error('content')
    <div class="alert alert-warning" role="alert">
    {{ $message }}
</div>
            @enderror
        
        <div class="mb-3">
            <label for="content" class="form-label">Description</label>
            <textarea class="form-control" id="content"   name="content" rows="3" placeholder="Enter description" > {{ $post->content }}</textarea>
        </div>
        
   

        @error('name')
    <div class="alert alert-warning" role="alert">
    {{ $message }}
</div>
            @enderror
        <div class="input-group mb-3">
  <select class="custom-select" name='id' id="inputGroupSelect02">

  @foreach($users as $user)
  @if($post->creator_id == $user->id)

  <option value="{{$user->id}}" selected >{{$user->name}}</option>
  @else
  <option value="{{$user->id}}" >{{$user->name}}</option>
  
  @endif
  @endforeach
  
    

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

        <button type="submit" class="btn btn-primary">Update</button>
    </form>

    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>