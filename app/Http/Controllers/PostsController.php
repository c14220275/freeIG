<?php

namespace App\Http\Controllers;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Models\Post;

class PostsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        $user = auth()->user()->following()->pluck('profiles.user_id');
        $posts = Post::whereIn('user_id' ,$user)->with('user')->latest()->cursorPaginate(1);
        return view('posts.index',compact('posts'));
    }
    public function create(){
        return view('posts.create');
    }
    public function store(){
        $data = request()->validate([
            'caption' => 'required',
            'image' => ['required','image'],
        ]);

        $imagepath = request('image')->store('uploads','public');
        $manager = new ImageManager(Driver::class);
        $image = $manager->read(public_path("storage/{$imagepath}"))->cover(1200, 1200);
        $image->save();
        auth()->user()->posts()->create(['caption'=> $data['caption'], 'image' => $imagepath,]);

        return redirect('/profile/' . auth()->user()->id);
    }

    public function show(\App\Models\Post $post){
        return view('posts.show',compact('post'));
    }
}
