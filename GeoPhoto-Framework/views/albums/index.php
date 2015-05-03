<?php foreach($this->albums as $album) : ?>
<div class="row">
<div id="album_plate" class="col-md-3">
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
