<div id="map-panel" class="panel panel-primary col-md-7 col-md-offset-2" style="height: 420px">
    <div class="panel-heading">
        <h3 class="panel-title">Geo Tagged Images</h3>
    </div>
    <div id="map-container" class="panel-body">
        <div class="col-md-7 col-md-offset-3" id="map-canvas"></div>
    </div>
</div>
<div id="gallery-panel" class="panel panel-primary col-md-7 col-md-offset-2" style="height: 420px">
    <div id="gallery-heading" class="panel-heading">
        <h3 class="panel-title">Gallery Album Name</h3>
        <a href="/albums/rank/like"><img class="rank-button" src="/content/images/thumb-up.png"/></a>
        <a href="/albums/rank/dislike"><img class="rank-button" src="/content/images/thumb-down.png"/></a>
    </div>
    <div id="gallery-container" class="panel-body">

            <div id="slider" class="col-md-7 col-md-offset-3">
                <div id="slider1_container" style="position: relative; top: 0px; left: 0px; width: 100%;
        height: 100%;">
                    <!-- Loading Screen -->
                    <div u="loading" style="position: absolute; top: 0px; left: 0px;">
                        <div style="filter: alpha(opacity=70); opacity:0.7; position: absolute; display: block;
                background-color: #000000; top: 0px; left: 0px;width: 100%;height:100%;">
                        </div>
                        <div style="position: absolute; display: block; background: url(/content/img/loading.gif) no-repeat center center;
                top: 0px; left: 0px;width: 100%;height:100%;">
                        </div>
                    </div>

                    <!-- Slides Container -->
                    <div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 600px; height: 300px;
            overflow: hidden;">
                    <?php foreach($this->pictures as $picture) : ?>
                            <div>
                                <img u="image" src="/<?= $picture['ImageUrl']?>" />
                            </div>
                        <input id="gps" type="hidden" value="<?= $picture['Latitude']?>,<?= $picture['Longitude']?>"/>
                    <?php endforeach ?>
                    </div>
                </div>
            </div>
    </div>
    <div id="gpsDataContainer">
        <?php foreach($this->pictures as $picture) : ?>
            <input id="<gps>" type="hidden" value="<?= $picture['Latitude']?>,<?= $picture['Longitude']?>"/>
        <?php endforeach ?>
    </div>
    <ul id="pager" class="pager">
        <li><a href="/albums/view/<?=$_SESSION["albumId"]?>/<?= $this->page-1?>/<?= $this->pageSize?>">Previous Page</a></li>
        <li><a href="/albums/view/<?=$_SESSION["albumId"]?>/<?= $this->page+1?>/<?= $this->pageSize?>">Next Page</a></li>
    </ul>
</div>



