<div style="margin-bottom: 10px" class="panel-heading">
    <h3 class="panel-title">Comments</h3>
</div>
<?php foreach($this->comments as $comment):?>
<div id="comment" class="panel panel-primary col-md-7 col-md-offset-2">
    <div class="panel-heading">
        <h3 class="panel-title"></h3>
    </div>
    <div id="albumComments-container" class="panel-body">
    <p><?=htmlspecialchars($comment['Text'])?></p>
    </div>
    <a href="/comments/delete/<?=htmlspecialchars($comment['Id'])?>">Delete</a>
</div>
<?php endforeach?>