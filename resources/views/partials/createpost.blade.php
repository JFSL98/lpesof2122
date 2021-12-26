<div class="card">
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data" id="create_post" action="{{ route('post.create') }}">
            @csrf
            <div class="row">
                <div class="form-group">
                    <label for="new-post">O que estás a pensar?</label>
                    <textarea class="form-control" id="new-post" rows="3" name='content'></textarea>
                </div>

                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary" id="submit">Submeter</button>
                </div>
            </div>
        </form>
    </div>
</div>