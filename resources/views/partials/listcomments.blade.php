@forelse ($comments as $comment)

<div class="card">
    <div class="card-body">
        <p><strong>{{$comment->user->name}}:</strong>
            {{ $comment->content }}</p>
        @if ($comment->user_id === Auth()->user()->id)
        <div class="text-end">
            <form method="POST" action="{{ route('post.comment.remove', ['id' => $comment->id]) }}">
                @csrf
                <button type="submit" class="btn btn-danger">Remover Comentario</button>
            </form>
        </div>
        @endif
    </div>
</div>

@empty
<p>No comments yet.</p>
@endforelse