<div id="welcome-screen" class="row">

</div>
<div id="album_container" class="row">
    <?php foreach($this->albums as $album) : ?>
        <div id="album_plate">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= htmlspecialchars($album['Name'])?></h3>
                </div>
                <input type="hidden" value="<?php $_SESSION["selectedAlbum"]=$album['Id'] ?>"/>
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
                    <a href="/albums/edit/<?= $album['Id']?>" class="btn btn-primary btn-xs">Edit</a>
                    <a href="/albums/upload/<?= $album['Id']?>" class="btn btn-primary btn-xs">Add pictures</a>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>
