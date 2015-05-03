<div class="row">
    <div class="col-md-5 col-md-offset-4">
        <form method="post" class="form-horizontal" action="/albums/create">
            <legend>
                Create Album
                <hr/>
            </legend>
            <div class="form-group">
                <label for="album_name" class="col-md-2 control-label">Album Name</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="album_name" placeholder="Album Name">
                </div>
            </div>
            <div class="form-group">
                <label for="album_description" class="col-md-2 control-label">Description</label>
                <div class="col-md-8">
                    <textarea class="form-control" rows="3" name="album_description"></textarea>
                    <span class="help-block">Short description for the album content and etc.</span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <button class="btn btn-default">Cancel</button>
                    <button type="submit" class="btn btn-primary" value="Create">Create</button>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
