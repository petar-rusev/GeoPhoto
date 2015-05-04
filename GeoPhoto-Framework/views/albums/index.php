<div id="album_container" class="row">
<?php foreach($this->albums as $album) : ?>
<div id="album_plate">
<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title"><?= htmlspecialchars($album['Name'])?></h3>
    </div>
    <div class="panel-body">
        <?= htmlspecialchars($album['Description'])?>
    </div>
</div>
</div>
<?php endforeach ?>
</div>
