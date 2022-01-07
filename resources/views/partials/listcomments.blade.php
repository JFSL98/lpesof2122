@forelse ($comments as $comment)

@php
$likes = $comment->likes;
$like = $likes->where('user_id', '=', Auth()->user()->id)->first();
@endphp
<div class="card">
    <div class="card-body">
        <p><strong>{{$comment->user->name}}:</strong>
            {{ $comment->content }}</p>     
            <small>
                posted at {{ $comment->created_at }}
                @if ($comment->created_at != $comment->updated_at)
                , edited at {{ $comment->updated_at }}
                @endif
            </small>
        <div class="container">
            <div class="row">
                <div class="col-md">
                    <form method="POST" action="{{ route('post.comment.like', ['id' => $comment->id, 'like_dislike' => true]) }}">
                        @csrf
                        @if ($like==NULL||$like->like_dislike==0)
                        <input type="submit" class="btn btn-primary fas fa-thumbs-up" value="&#xf164; {{ $comment->getLikeCount() }}">
                        @else
                        <input type="submit" class="btn btn-success fas fa-thumbs-up" value="&#xf164; {{ $comment->getLikeCount() }}">
                        @endif
                    </form>
                </div>
                <div class="col-md">
                    <form method="POST" action="{{ route('post.comment.like', ['id' => $comment->id, 'like_dislike' => false]) }}">
                        @csrf
                        @if($like == NULL||$like->like_dislike==1)
                        <input type="submit" class="btn btn-primary fas fa-thumbs-down" value="&#xf165; {{ $comment->getDislikeCount() }}">
                        @else
                        <input type="submit" class="btn btn-danger fas fa-thumbs-down" value="&#xf165; {{ $comment->getDislikeCount() }}">
                        @endif
                    </form>
                </div>
                @if ($comment->user_id === Auth()->user()->id || $post->user_id === Auth()->user()->id)
                <div class="col-md">
                    <form method="POST" action="{{ route('post.comment.remove', ['comment_id' => $comment->id]) }}">
                        @csrf
                        <input type="submit" class="btn btn-danger fas fa-trash-alt" value="&#xf2ed;">
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@empty
<h5 class="text-center">No comments yet.</h5>
@endforelse