@forelse ($posts as $post)
<div class="card">
    @php
    $user=$post->user;
    @endphp
    <div class="card-header">
        <a class="text-reset text-decoration-none" href="{{route("profile",$user->id)}}">
            @if ($user->profile_pic==NULL)
            <img class="rounded-circle profile-pic profile-pic-listposts"
                src="{{asset('storage/images/profile_pic/default.jpg')}}" alt="Avatar">
            @else
            <img class="rounded-circle profile-pic profile-pic-listposts"
                src="{{asset('storage/images/profile_pic/'.$user->profile_pic->path)}}" alt="Avatar">
            @endif
            <h5 class="card-title">{{ $post->user->name }}</h5>
        </a>
        <small>
            posted at {{ $post->created_at }}
            @if ($post->created_at != $post->updated_at)
            , edited at {{ $post->updated_at }}
            @endif
        </small>
    </div>
    <div class="card-body">
        <p class="card-text">{{ $post->content }}</p>
        @php
        $likes = $post->likes;
        $like = $likes->where('user_id', '=', Auth()->user()->id)->first();
        @endphp
        <div class="container">
            <div class="row">
                <div class="col-md">
                    <form method="POST" action="{{ route('post.like', ['id' => $post->id, 'like_dislike' => true]) }}">
                        @csrf                      
                        @if($like == NULL||$like->like_dislike==0)
                        <input type="submit" class="btn btn-primary fas fa-thumbs-up" value="&#xf164; {{ $post->getLikeCount() }}">
                        @else
                        <input type="submit" class="btn btn-success fas fa-thumbs-up" value="&#xf164; {{ $post->getLikeCount() }}">
                        @endif
                    </form>
                </div>
                <div class="col-md">
                    <form method="POST" action="{{ route('post.like', ['id' => $post->id, 'like_dislike' => false]) }}">
                        @csrf
                        @if ($like == NULL||$like->like_dislike==1)
                        <input type="submit" class="btn btn-primary fas fa-thumbs-down" value="&#xf165; {{ $post->getDislikeCount() }}">
                        @else
                        <input type="submit" class="btn btn-danger fas fa-thumbs-down" value="&#xf165; {{ $post->getDislikeCount() }}">
                        @endif
                    </form>
                </div>
                <div class="col-md">
                    <a class="btn btn-primary far fa-comment" href="{{ route('post.single',$post->id) }}"> {{$post->getCommentCount()}}</a>
                </div>
                <div class="col-md">
                    @if ($post->user_id === Auth()->user()->id)                    
                    <form method="POST" action="{{ route('post.remove', ['id' => $post->id]) }}">
                        @csrf
                        <input type="submit" class="btn btn-danger fas fa-trash-alt" value="&#xf2ed;">
                    </form>
                    @endif
                </div>
            </div>
        </div>


    </div>
</div>
@empty
<h5 class="text-center">Nothing to see here!</h3>
@endforelse