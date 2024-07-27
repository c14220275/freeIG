@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 pt-5">
            <img src="{{$user->profile->profileImage()}}" style="max-height:100px; max-width:110px; border-radius:50%">
        </div>
        <div class="col-9 pt-5 ">
            <div class="d-flex align-items-baseline justify-content-between" >
                <div class="d-flex ">               
                     <div class="h3">{{ $user->username }}</div>
                     <follow-button user-id="{{$user->id}}" follows="{{$follows}}"></follow-button>
                </div>
                @can('update', $user->profile)
                <a href="/p/create">Add New Post</a>
                @endcan
               
            </div>
            @can('update', $user->profile)
                     
                <a href="/profile/{{ $user->id }}/edit">Edit Profile</a>
            @endcan
            <div class="d-flex ">
                <div style="padding-right:30px"><strong>{{$postCount}}</strong> posts</div>
                <div style="padding-right:30px"><strong>{{$followerCount}}</strong> followers</div>
                <div style="padding-right:30px"><strong>{{$followingCount}}</strong> following</div>
            </div>
            <div class="pt-4" style="font-weight:800">{{ $user->profile->title }}</div>
            <div>{{ $user->profile->description }}</div>
            <div><a href="#">{{ $user->profile->url }}</a></div>
        </div>
    </div>
<div class="row pt-5">
    @foreach ($user->posts as $post)
        <div class="col-4 pb-4">
            <a href="/p/{{$post->id}}">
                <img src="/storage/{{ $post->image }}" class="w-100">
            </a>
        </div>
    @endforeach

</div>
</div>
@endsection
