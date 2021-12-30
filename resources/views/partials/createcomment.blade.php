<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('post.comment.add', ['post_id' => $post->id]) }}">
            @csrf
            <div class="form-group">
                <label for="content">Comment:</label>
                <textarea class="form-control" rows="3" id="content" name="content"></textarea>
            </div>
            <input type="submit" class="btn btn-primary fas fa-chevron-circle-right" value="&#xf138;">
        </form>        
    </div>
</div>