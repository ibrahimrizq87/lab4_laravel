<?php 
use Carbon\Carbon;
?>

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
    <a class="nav-link active" aria-current="page" href="{{route('posts.index')}}">post by {{$post['creator_name']}}</a>
  </li>
</ul>
</div>



<div class='container'>





<div class="card mt-5 p-3"  >
    <!-- <p>{{$post->image}}</p> -->
 

  <img class="mt-3 me-3" src="{{ asset('uploads/' . $post->image) }}" alt="Card image cap" width = '250' height = '250'>
  <div class="card-body">
  <h5 class="card-header"><strong>{{$post['title']}}</strong></h5>
  <div class="card-body">
    <h5 class="card-title">Creator: {{$post['creator_name']}}</h5>
    <p class="card-text">{{$post['content']}}</p>
    <?php

$date = Carbon::parse($post['create_date']);

if ($post['deleted_at'] == NULL)
{echo "A&A";}
      ?>
    
    <p class="card-text border shadow p-2 text-center">{{$date->format('l jS \of F Y ')}}</p>

  </div>
</div>
    <!-- <div class="card mt-5 shadow" >
        
  
       
  
        
  </div> -->
  </div>




    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>