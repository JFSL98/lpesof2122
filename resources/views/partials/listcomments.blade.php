@forelse ($comments as $comment)

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
        @if ($comment->user_id === Auth()->user()->id || $post->user_id === Auth()->user()->id)
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <form method="POST" action="{{ route('post.comment.remove', ['comment_id' => $comment->id]) }}">
                        @csrf
                        <input type="submit" class="btn btn-danger fas fa-trash-alt" value="&#xf2ed;">
                    </form>
                </div>          
            </div>
        </div>
        @endif   
    </div>
</div>

@empty
<h5 class="text-center">No comments yet.</h5>
@endforelse