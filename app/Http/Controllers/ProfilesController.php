<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Models\User;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
class ProfilesController extends Controller
{
    public function index(User $user)
    {
        $follows= (auth()->user()) ? auth()->user()->following->contains($user->id) : false;
        // dd($follows);
        $postCount = Cache::remember('count.post.' . $user->id,
         now()->addSeconds(30),
          function() use($user){
            return  $user->posts()->count();
        });
        $followerCount = Cache::remember('count.follower.' . $user->id,
         now()->addSeconds(30),
          function() use($user){
            return  $user->profile->followers->count();
        });
        $followingCount = Cache::remember('count.following.' . $user->id,
         now()->addSeconds(30),
          function() use($user){
            return  $user->following->count();
        });

        return view('profiles.index',compact('user' , 'follows', 'postCount','followerCount','followingCount'));
    }
    public function edit(User $user){
        $this->authorize('update' , $user->profile);
        // dd(auth()->user()->id);
        // dd($user->profile);
        return view('profiles.edit',compact('user'));
    }
    public function update(User $user){
        
        $this->authorize('update' , $user->profile);
        $data = request()->validate(['title'=> 'required','description' => '', 'url' =>'url', 'image' =>'nullable|image',]);
        if(request('image')){
            $imagepath = request('image')->store('profile','public');
            $manager = new ImageManager(Driver::class);
            $image = $manager->read(public_path("storage/{$imagepath}"))->cover(1000, 1000);
            $image->save();
            $imageArray=['image' => $imagepath];
        }
        auth()->user()->profile->update(array_merge($data,$imageArray ??[]));
        return redirect("/profile/{$user->id}");
    }
    

}
