<div class="card">
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data" id="create_post" action="{{ route('post.create') }}">
            @csrf
            <div class="container">
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="new-post">O que estás a pensar?</label>
                        <textarea class="form-control" id="new-post" rows="3" name='content'></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <input type="submit" class="btn btn-primary fas fa-chevron-circle-right" value="&#xf138;">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>