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
        <a id="voteUp" href="/albums/upVote/1"><img class="rank-button" src="/content/images/thumb-up.png"/></a>
        <a id="voteDown" href="/albums/downVote/1"><img class="rank-button" src="/content/images/thumb-down.png"/></a>

    </div>
    <div id="gallery-container" class="panel-body">
        <div class="row center-block">
            <div id="slider-responsive" class="col-md-6">
                <script>
                    jQuery(document).ready(function ($) {
                        //Reference http://www.jssor.com/development/tip-make-responsive-slider.html

                        var _CaptionTransitions = [];
                        _CaptionTransitions["CLIP|L"] = { $Duration: 600, $Clip: 1, $Easing: $JssorEasing$.$EaseInOutCubic };
                        _CaptionTransitions["RTT|10"] = { $Duration: 600, $Zoom: 11, $Rotate: 1, $Easing: { $Zoom: $JssorEasing$.$EaseInExpo, $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseInExpo }, $Opacity: 2, $Round: { $Rotate: 0.8} };
                        _CaptionTransitions["ZMF|10"] = { $Duration: 600, $Zoom: 11, $Easing: { $Zoom: $JssorEasing$.$EaseInExpo, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 };
                        _CaptionTransitions["FLTTR|R"] = { $Duration: 600, x: -0.2, y: -0.1, $Easing: { $Left: $JssorEasing$.$EaseLinear, $Top: $JssorEasing$.$EaseInWave }, $Opacity: 2, $Round: { $Top: 1.3} };

                        var options = {
                            $AutoPlay: false,                                    //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
                            $DragOrientation: 3,                                //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0),

                            $CaptionSliderOptions: {                            //[Optional] Options which specifies how to animate caption
                                $Class: $JssorCaptionSlider$,                   //[Required] Class to create instance to animate caption
                                $CaptionTransitions: _CaptionTransitions,       //[Required] An array of caption transitions to play caption, see caption transition section at jssor slideshow transition builder
                                $PlayInMode: 1,                                 //[Optional] 0 None (no play), 1 Chain (goes after main slide), 3 Chain Flatten (goes after main slide and flatten all caption animations), default value is 1
                                $PlayOutMode: 3                                 //[Optional] 0 None (no play), 1 Chain (goes before main slide), 3 Chain Flatten (goes before main slide and flatten all caption animations), default value is 1
                            }
                        };

                        var jssor_slider2 = new $JssorSlider$("slider2_container", options);

                        //responsive code begin
                        //you can remove responsive code if you don't want the slider scales while window resizes
                        function ScaleSlider() {

                            //reserve blank width for margin+padding: margin+padding-left (10) + margin+padding-right (10)
                            var paddingWidth = 20;

                            //minimum width should reserve for text
                            var minReserveWidth = 225;

                            var parentElement = jssor_slider2.$Elmt.parentNode;

                            //evaluate parent container width
                            var parentWidth = parentElement.clientWidth;

                            if (parentWidth) {

                                //exclude blank width
                                var availableWidth = parentWidth - paddingWidth;

                                //calculate slider width as 70% of available width
                                var sliderWidth = availableWidth * 0.7;

                                //slider width is maximum 600
                                sliderWidth = Math.min(sliderWidth, 600);

                                //slider width is minimum 200
                                sliderWidth = Math.max(sliderWidth, 200);
                                var clearFix = "none";

                                //evaluate free width for text, if the width is less than minReserveWidth then fill parent container
                                if (availableWidth - sliderWidth < minReserveWidth) {

                                    //set slider width to available width
                                    sliderWidth = availableWidth;

                                    //slider width is minimum 200
                                    sliderWidth = Math.max(sliderWidth, 200);

                                    clearFix = "both";
                                }

                                //clear fix for safari 3.1, chrome 3
                                $('#clearFixDiv').css('clear', clearFix);

                                jssor_slider2.$ScaleWidth(sliderWidth);
                            }
                            else
                                window.setTimeout(ScaleSlider, 30);
                        }
                        ScaleSlider();

                        $(window).bind("load", ScaleSlider);
                        $(window).bind("resize", ScaleSlider);
                        $(window).bind("orientationchange", ScaleSlider);
                        //responsive code end
                    });
                </script>
                <div id="slider2_container" style="position: relative; margin: 0px 5px 5px 0px; float: left; top: 0px; left: 0px; width: 600px;
            height: 300px; overflow: hidden;">
                    <!-- Slides Container -->
                    <div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 600px; height: 300px;
                overflow: hidden;">
                        <?php foreach($this->pictures as $picture) : ?>
                            <div>
                                <img class="img-responsive center-block" u="image" src="/<?= $picture['ImageUrl']?>" />
                            </div>
                            <a href="/albums/download/<?=$picture['Id']?>">
                                <button style="position:absolute;left:500px;top;900px;z-index=999">download this image</button>
                            </a>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <ul id="pager" class="pager">
                <li><a href="/albums/view/<?=$_SESSION["currentAlbum"]?>/<?= $this->page-1?>/<?= $this->pageSize?>">Previous Page</a></li>
                <li><a href="/albums/view/<?=$_SESSION["currentAlbum"]?>/<?= $this->page+1?>/<?= $this->pageSize?>">Next Page</a></li>
            </ul>

        </div>

        <div id="gpsDataContainer">
            <?php foreach($this->pictures as $picture) : ?>
                <input id="<gps>" type="hidden" value="<?= $picture['Latitude']?>,<?= $picture['Longitude']?>"/>
            <?php endforeach ?>
        </div>
        <div id="create-comment" class="panel panel-primary col-md-7 col-md-offset-2" style="height: 420px">
            <div class="panel-heading">
                <h3 class="panel-title">Add comment to this album</h3>
            </div>
            <div id="createComment-container" class="panel-body">
                <form method="post" action="/comments/add/<?=htmlspecialchars($_SESSION['currentAlbum'])?>/<?=htmlspecialchars($_SESSION['userId']['Id'])?>">
                    <div class="form-group">
                        <label for="Text" class="col-md-2 control-label">Description</label>
                        <div class="col-md-8">
                            <textarea id="Text" class="form-control" rows="3" name="Text"></textarea>
                            <span class="help-block">Create your comment here</span>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-2">
                                <button class="btn btn-default">Cancel</button>
                                <button type="submit" class="btn btn-primary" value="Create">Create</button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
    <div id="albums-comment" class="panel panel-primary col-md-7 col-md-offset-2">

    </div>
</div>



