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
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>
