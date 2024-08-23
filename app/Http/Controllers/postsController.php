<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Carbon\Carbon; 

use Illuminate\Http\Request;

class postsController extends Controller
{
  
    public function index()
    {
        $posts = Post::all();
            return view("home", ["posts"=>$posts]);
        
    }

    public function showDetails()
    {
        $posts = Post::withTrashed()->paginate(3);
        return view('show', ['posts' => $posts]);
    }
    public function create()
    {
        $users = User::all();
        return view('create_post', compact('users'));

        
    }
    public function restore($id)
    {
        $post = Post::withTrashed()->findOrFail($id);

        $post->restore(); 
        return to_route("posts.details")->with('success', 'Post restored successfully.');

        
    }

    
    public function store(Request $request)
    {
        $validated = $request->validate([
            "name" => "required",
            "title" => "required",
            "content" => "required",
            "image" => "required|image|mimes:jpeg,png,jpg|max:2048"

        ],[
            "name.required" => "you have to choose a name",
            "title.required" => "no posts without a title",
            "content.required" => "you have to add a content to your post",
            "grade.required" => "There is no student without grade",
            "image.required" => "Image is required to create a post",

        ]);
        $userInfo = explode(',', $request->input('name'));
        $id = $userInfo[0]; 
        $name = $userInfo[1]; 


        $my_path = '';
        $data = request()->all();

        if(request()->hasFile("image")){

            $image = request()->file("image");
            $my_path=$image->store('posts_images','posts_images');

        }
        $data['creator_name'] = $name;
        $data['creator_id'] = $id;

        $post = new Post();
        $post->creator_name =$name;
        $post->creator_id =$id;
        $post->title = $data['title'];
        $post->create_date = Carbon::now()->toDateString();
        $post->content= $data['content'];
        $post->image= $my_path;
        $post->save();

        return  to_route("posts.details");

        
    }

    
    public function show(Post $post)
    {
        
  
        return view("get_post", ["post"=>$post ]);

    }

 
    public function edit(Post $post)
    {
        $users = User::all();

        return view("edit_post", ["post"=>$post , "users"=> $users]);

    }

   
    public function update(Request $request, Post $post)
    {

        $validated = $request->validate([
            "id" => "required|exists:users,id",
            "title" => "required",
            "content" => "required",
            "image" => "nullable|image|mimes:jpeg,png,jpg|max:2048" 

        ],[
            "it.required" => "you have to choose a creator and have to be an exesting user",
            "title.required" => "no posts without a title",
            "content.required" => "you have to add a content to your post",
            "grade.required" => "There is no student without grade",
            "image.required" => "Image is required to create a post",

        ]);

       


        $my_path = $post->image;
        $data = request()->all();

        if(request()->hasFile("image")){

            $image = request()->file("image");
            $my_path=$image->store('posts_images','posts_images');

        }
     

        $user = User::find( $data['id']);


        $post->creator_name =$user->name;
        $post->creator_id =$user->id;
        $post->title = $data['title'];
        $post->create_date = Carbon::now()->toDateString();
        $post->content= $data['content'];
        $post->image= $my_path;

        // just to be clear
        // If the model instance is new (i.e., it has not been saved to the database before), calling save() will insert a new record.
        
        $post->save();

        return  to_route("posts.details");

        
    }

   

    public function destroy(Post $post)
    {
        $post->delete();
        return  to_route("posts.details");
    }
}
