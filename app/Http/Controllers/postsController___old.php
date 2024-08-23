<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon; 


// use Illuminate\Support\Facades\DB;
use App\Models\Post;

class postsController extends Controller
{
    

        function  getAllPosts (){
                    $posts = Post::all(); 
                    return view("home", ["posts"=>$posts]);
                }

                function  details (){
                    $posts = Post::paginate(1);
                    return view("show", ["posts"=>$posts]);
                }



        function getPostByID($id)
    {
        $post = Post::find($id);
        if($post == null){
             abort(404);
        }
        return view("get_post", ["post"=>$post]);
    }


    function deletePost($id){
        $post = Post::find($id);
        if($post == null){
            abort(404);
        }
        $post->delete();
        // return view('home');
        return  to_route("posts.details");

    }



    function addPost(){

        $my_path = '';
        $data = request()->all();

        if(request()->hasFile("image")){

            $image = request()->file("image");
            $my_path=$image->store('posts_images','posts_images');

        }

        $post = new Post();
        $post->creator_name =$data['name'];
        $post->title = $data['title'];
        $post->create_date = Carbon::now()->toDateString();
        $post->content= $data['content'];
        $post->image= $my_path;
        $post->save();

        return  to_route("posts.show");
    }

    function createPost(){
        return view('create_post');
    }



function editPost($id) {
    $post = Post::find($id);
        if($post == null){
             abort(404);
        }
        return view("edit_post", ["post"=>$post]);
    }
    
    
    // another way to handel the request by passing the request as a parameter 
    // public function store(Request $request) {

    //     $newId = end($this->posts)['id'] + 1;
    
    //     $newPost = [
    //         'id' => $newId,
    //         'created_time' => Carbon::now()->toDateTimeString(), 
    //         'creator_name' => $request->input('creator_name'),   
    //         'title' => $request->input('title'),                 
    //         'content' => $request->input('content')              
    //     ];
    
    //     $this->posts[] = $newPost;
    
    //     return view('home', ['posts' => $this->posts]);
    // }




}