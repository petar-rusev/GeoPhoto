<div class="container">

    <!-- status message will be appear here -->
    <div class="status"></div>

    <!-- multiple file upload form -->
    <form action="/albums/upload/<?=$_SESSION['albumId']?>" method="post" enctype="multipart/form-data" class="pure-form">
        <input type="file" name="files[]" multiple="multiple" id="files">
        <input type="submit" value="Upload" class="pure-button pure-button-primary">
    </form>

    <!-- progress bar -->
    <div class="progress">
        <div class="bar"></div >
        <div class="percent">0%</div >
    </div>

</div>
