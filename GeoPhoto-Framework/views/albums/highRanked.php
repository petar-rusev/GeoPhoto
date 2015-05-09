<?php
$url = $_SERVER['REQUEST_URI'];
$parts = explode('/',$url);
$_SESSION['currentAlbum']=$parts[3];
?>
<div id="map-panel" class="panel panel-primary col-md-7 col-md-offset-2" style="height: 420px">
    <div class="panel-heading">
        <h3 class="panel-title">Geo Tagged Images</h3>
    </div>
    <div id="map-container" class="panel-body">

    </div>
</div>
<div id="gallery-panel" class="panel panel-primary col-md-7 col-md-offset-2" style="height: 420px">
    <div id="gallery-heading" class="panel-heading">
        <h3 class="panel-title">Gallery Album Name</h3>
        <a href="/albums/vote/1"><img class="rank-button" src="/content/images/thumb-up.png"/></a>
        <a href="/albums/vote/-1"><img class="rank-button" src="/content/images/thumb-down.png"/></a>
    </div>
    <div id="gallery-container" class="panel-body">


    </div>
    <div id="gpsDataContainer">
        <?php foreach($this->pictures as $picture) : ?>
            <input id="<gps>" type="hidden" value="<?= $picture['Latitude']?>,<?= $picture['Longitude']?>"/>
        <?php endforeach ?>
    </div>
    <ul id="pager" class="pager">
        <li><a href="/albums/view/<?=$_SESSION["currentAlbum"]?>/<?= $this->page-1?>/<?= $this->pageSize?>">Previous Page</a></li>
        <li><a href="/albums/view/<?=$_SESSION["currentAlbum"]?>/<?= $this->page+1?>/<?= $this->pageSize?>">Next Page</a></li>
    </ul>
</div>