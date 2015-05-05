<div class="row">
    <div class="col-md-5 col-md-offset-4">
        <form method="post" class="form-horizontal" action="/pictures/upload" enctype="multipart/form-data">
            <legend>
                Upload Pictures to Album
                <hr/>
            </legend>
            <div class="form-group">
                <label for="image_caption" class="col-md-2 control-label">Image Caption</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="image_caption" placeholder="Image Caption">
                </div>
            </div>
            <div class="form-group">
                <label for="image_filename" class="col-md-2 control-label">Upload File</label>
                <div class="col-md-8">
                    <input type="file" class="form-control" name="image_filename" placeholder="Upload file">
                </div>
            </div>
            <input type="hidden" name="albumId" value="<?php ?>" />
            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <button class="btn btn-default">Cancel</button>
                    <button type="submit" class="btn btn-primary" value="upload">Upload</button>
                </div>
            </div>
        </form>
    </div>
</div>
</div>

