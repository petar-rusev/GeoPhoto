<div id="album_container" class="row">
    <?php foreach($this->pictures as $picture) : ?>
        <div id="album_plate">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= htmlspecialchars($picture['Name'])?></h3>
                </div>
                <div id="album_front_picture">
                    <img src="/<?= htmlspecialchars($picture['ImageUrl'])?>"/>
                </div>
                <div id="album_actions">
                    <input type="hidden" name="pictureId" value="<?php $_SESSION['pictureId']=$picture['Id'] ?>" />
                    <input class="latitude" type="hidden" name="pictureLat" value="<?=$picture['Latitude'] ?>"/>
                    <input class="longitude" type="hidden" name="pictureLon" value="<?=$picture['Longitude'] ?>"/>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>
<div class="panel panel-primary" style="height: 600px">
    <div class="panel-heading">
        <h3 class="panel-title">Geo Tagged Images</h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6 col-lg-offset-3" id="map-canvas"></div>
        </div>
    </div>
</div>
