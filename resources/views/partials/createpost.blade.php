<form method="POST" enctype="multipart/form-data" id="create_post" action="{{ route('create.post') }}">
    @csrf
    <div class="row">

        <div class="col-md-12">
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Example textarea</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
              </div>
        </div>

        <div class="col-md-12">
            <button type="submit" class="btn btn-primary" id="submit">Submit</button>
        </div>
    </div>
</form>
