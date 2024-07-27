@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8">
            <img src="/storage/{{ $post->image }}" class="w-100">
        </div>
        <div class="col-4">
            <div>
            <div class="d-flex pr-5 ">
                <div class="d-flex align-items-center">
                    <img src="{{$post->user->profile->profileImage()}}" class="rounded-circle w-25" >
                                
                    <div style="font-weight: bold; padding-right:20px">
                        <a href="/profile/{{$post->user->id}}">
                            <span class="text-dark">{{ $post->user->username }}</span>
                        </a>
                        <a class="pl-5" href="#">follow</a>
                    </div>
                </div>
                </div>

            </div>
            <hr>    
            <p>
                <span  style="font-weight: bold; padding-right: 20px">
                    <a href="/profile/{{$post->user->id}}">
                        <span class="text-dark">{{ $post->user->username }}</span>
                    </a>
                </span>{{$post->caption}}
            </p>
        </div>
        </div>
    </div>
</div>
@endsection
