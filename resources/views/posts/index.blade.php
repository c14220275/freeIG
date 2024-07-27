@extends('layouts.app')

@section('content')
<div class="container">
    @foreach($posts as $post)
    <div class="row">
        <div class="col-6 offset-3">
            <a href="/profile/{{$post->user->id}}"><img src="/storage/{{ $post->image }}" class="w-75"></a>
        </div>
    </div>
    <div class="row pt-2 pb-4">

    </div>
        <div class="col-6 offset-3 ">
   
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
    @endforeach
    <div class="row col-12 d-flex " style="align-content: center">    
        <div>{{ $posts->links() }}</div>
    </div>


</div>
@endsection
