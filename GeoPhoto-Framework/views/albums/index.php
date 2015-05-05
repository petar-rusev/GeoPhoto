<div id="album_container" class="row">
<?php foreach($this->albums as $album) : ?>
<div id="album_plate">
<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title"><?= htmlspecialchars($album['Name'])?></h3>
    </div>
    <div id="album_front_picture">
        <img src="/content/uploads/image_1.jpg"/>
    </div>
    <div class="panel-body">
        <?= htmlspecialchars($album['Description'])?>
    </div>
    <div id="album_actions">
        <a href="/albums/view/<?=$album['Id'] ?>" class="btn btn-primary btn-xs">View</a>
        <a href="/albums/edit/<?=$album['Id'] ?>" class="btn btn-primary btn-xs">Edit</a>
        <a href="/pictures/upload/<?=$album['Id'] ?>" class="btn btn-primary btn-xs">Add pictures</a>
    </div>
</div>
</div>
<?php endforeach ?>
</div>

