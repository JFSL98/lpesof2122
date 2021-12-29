@forelse ($posts as $post)
<div class="card">
    @php
    $user=$post->user;
    @endphp
    <div class="card-header">
        <a  class="text-reset text-decoration-none" href="{{route("profile",$user->id)}}">
            @if ($user->profile_pic==NULL)
            <img class="rounded-circle profile-pic profile-pic-listposts" src="{{asset('storage/images/profile_pic/default.jpg')}}" alt="Avatar">
            @else
            <img class="rounded-circle profile-pic profile-pic-listposts" src="{{asset('storage/images/profile_pic/'.$user->profile_pic->path)}}" alt="Avatar" >
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
        @if ($post->user_id === Auth()->user()->id)
        <form method="POST" action="{{ route('post.remove', ['id' => $post->id]) }}">
            @csrf
            <button type="submit" class="btn btn-danger">Remover</button>
        </form>
        @endif
        <!--
            comment section
        -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Comments</h5>
            </div>
            @if (count($post->comments)>0)
            <div class="card-body">
                @forelse ($post->comments as $comment)
                <div class="card">
                    <div class="card-body">
                        <p class="card-text">{{ $comment->body }}</p>
                        @if ($comment->user_id === Auth()->user()->id)
                        <form method="POST" action="{{ route('post.comment.remove', ['id' => $comment->id]) }}">
                            @csrf
                            <button type="submit" class="btn btn-danger">Remover</button>
                        </form>
                        @endif
                    </div>
                </div>
                @empty
                <p>No comments yet.</p>
                @endforelse
                @endif
            </div>
        </div>
        <form method="POST" action="{{ route('post.comment.add', ['id' => $post->id]) }}">
            @csrf
            <div class="form-group">
                <label for="content">Comment:</label>
                <textarea class="form-control" rows="3" id="content" name="content"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Comment</button>
        </form>


        <div class="text-end">
            <a class="btn btn-secondary" href="{{ route('post.single',$post->id) }}">Ver mais</a>
        </div>
    </div>

</div>
@empty
<h5 class="text-center">Nothing to see here!</h3>
@endforelse
