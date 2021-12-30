<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('post.comment.add', ['post_id' => $post->id]) }}">
            @csrf
            <div class="form-group">
                <label for="content">Comment:</label>
                <textarea class="form-control" rows="3" id="content" name="content"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Comment</button>
        </form>        
    </div>
</div>