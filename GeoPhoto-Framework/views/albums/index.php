<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="jumbotron">
            <h1>You don't have any albums yet</h1>
            <p>Lets go to create one</p>
            <p><a href="/albums/create" class="btn btn-primary btn-lg">Create</a></p>
        </div>
    </div>
</div>
<div id="album_container" class="row">
    <?php foreach($this->albums as $album) : ?>
        <div id="album_plate">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= htmlspecialchars($album['Name'])?></h3>
                </div>
                <input type="hidden" value="<?= $_SESSION['albumId'] = $album['Id']?>"/>
                <div id="album_front_picture">
                    <?php
                        if($this->hasImages()>0){
                            $wallImage=$this->setWallImage();
                            echo '<img src="/'.$wallImage.'"/>';
                        }
                        else{
                            echo '<img src="/content/images/camera-no-image.jpg">';
                        }
                    ?>
                </div>
                <div id="album_actions">
                    <a id="getData" href="/albums/view/<?= $album['Id']?>" class="btn btn-primary btn-xs">View</a>
                    <input type="hidden" value="<?php $_SESSION["selectedAlbum"]=$album['Id'] ?>"/>
                    <a href="/albums/edit/<?= $album['Id']?>" class="btn btn-primary btn-xs">Edit</a>
                    <a href="/albums/upload/<?= $album['Id']?>" class="btn btn-primary btn-xs">Add pictures</a>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>
