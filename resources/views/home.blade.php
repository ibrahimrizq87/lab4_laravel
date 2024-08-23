<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Home</title>
</head>
<body>
  
<div class="container">
    <ul class="nav nav-tabs mt-5">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{ route('posts.index') }}">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-dark" href="{{ route('posts.details') }}">Show All Details</a>
        </li>
    </ul>
</div>

<div class="container mt-5">
    <a class="btn btn-success" href="{{ route('posts.create') }}">Create</a>
</div>

<div class="container mt-5">
    @foreach($posts as $post)
        <div class="card mt-5 p-3">
            @if($post->image)
                <img class="mt-3 me-3" src="{{ asset('uploads/' . $post->image) }}" alt="Card image cap" width="250" height="250">
            @endif
            <div class="card-body">
                <h5 class="card-header"><strong>{{ $post->title }}</strong></h5>
                <h5 class="card-title">Creator: {{ $post->creator_name }}</h5>
                <p class="card-text">{{ $post->content }}</p>
            </div>
        </div>
    @endforeach
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>
