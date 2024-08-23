<?php 
use Carbon\Carbon;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Home</title>
</head>
<body>
<div class='container'>
<ul class="nav nav-tabs mt-5">
<li class="nav-item">
    <a class="nav-link text-dark" aria-current="page" href="{{route('posts.index')}}">Home</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" href="{{route('posts.details')}}">Show All details</a>
  </li>
</ul>
</div>




<div class='container'>






<table class="table mt-5">
  <thead>
    <tr>
      <th scope="col">id </th>
      <th scope="col">Tilte</th>
      <th scope="col">Posted By</th>
      <th scope="col">Created At</th>
      <th scope="col">image</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach($posts as $post)
    <tr>
      
      <td>{{$post['id']}}</td>
      <td>{{$post['title']}}</td>
      <?php

$date = Carbon::parse($post['create_date']);

//  $date->format('l jS \of F Y h:i:s A');

      ?>
      
      <td>{{$post['creator_name']}}</td>
      
      <td>{{$date->format('l jS \of F Y ')}}</td>
      <td><img src="{{ asset('uploads/' . $post->image) }}" alt="post image" width = '75' ></td>


      <td>
        @if($post['deleted_at'] == NULL)
        
      <a href="{{route('posts.show',$post)}}" class="btn btn-primary m-3">
            <i class="bi bi-eye"></i> View
        </a>
        <a href="{{route('posts.edit',$post)}}" class="btn btn-warning m-3">
            <i class="bi bi-pencil"></i> Edit
        </a>
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">
  Delete 
</button>
@else
<a href="{{route('posts.restore',$post)}}" class="btn btn-warning m-3">
            <i class="bi bi-pencil"></i> Restore
        </a>
@endif
</td>
    </tr>



<div class='container'>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Deleting Post</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this post 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <form action="{{route('posts.destroy',$post)}}" method = 'post'>
        @csrf  
        @method('DELETE')
        <input type='submit'  value ='Confirm Deleting' class="btn btn-danger">
        </form>
      </div>
    </div>
  </div>
</div>
</div>

    @endforeach  
 
    <tr>
      
      <div class="pagination justify-content-center mt-4">
    {{ $posts->links('pagination::bootstrap-4') }}
</div>
      
    </tr>
  </tbody>
</table>



  


    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>