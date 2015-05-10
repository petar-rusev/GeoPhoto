<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>
        <?= htmlspecialchars($this->title)?>
    </title>
    <link rel="stylesheet" href="/content/styles/bootstrap/bootstrap.css"/>
    <link rel="stylesheet" href="/content/styles/bootstrapTheme.css"/>
    <link rel="stylesheet" href="/content/styles/app.css"/>
    <link rel="stylesheet" href="/content/styles/forms.css"/>
    <link rel="stylesheet" href="/content/styles/album.css"/>
    <link rel="stylesheet" href="/content/styles/fileUpload/pure-min.css"/>
    <link rel="stylesheet" href="/content/styles/fileUpload/style.css"/>
    <link rel="stylesheet" href="/content/styles/slider.css"/>
</head>
<body style="margin-bottom: 0px">
<header>
    <nav id="header_navbar" class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">
                    <div class="logo">
                        <img class="logo" src="/content/images/logo.png"/>
                    </div>
                </a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class=""><a href="/albums/index">Albums</a></li>
                    <li class="dropdown">
                        <a id="show-categories" href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Categories<span class="caret"></span></a>
                        <ul id="categories" class="dropdown-menu" role="menu">

                        </ul>
                    </li>
                </ul>
                <form class="navbar-form navbar-left" role="search">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search">
                    </div>
                    <button type="submit" class="btn btn-default">Search</button>
                </form>
                <ul id="user_info" class="nav navbar-nav navbar-right">
                    <?php if(!$this->isLoggedIn()) : ?>
                        <li><a href="/account/login">Login</a></li>
                        <li><a href="/account/register">Signup</a></li>
                    <?php endif;?>
                    <?php if($this->isLoggedIn()) : ?>
                        <a href="/account/view/<?=htmlspecialchars($_SESSION['userId']['Id'])?>">
                        <li><span>Hello, <?= htmlspecialchars($_SESSION['username'])?></span></li>
                        </a>
                        <a href="/account/logout" class="btn btn-primary btn-xs">Logout</a>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
</header>
<script src="/content/lib/jquery/jquery-2.1.3.js"></script>
<script src="/content/lib/bootstrap/bootstrap-3.1.1.js"></script>
<script src="/content/lib/jquery.noty/jquery.noty.js"></script>
<script src="/content/lib/jquery.form/jquery.form.js"></script>
<script src="/content/js/fileUpload.js"></script>
<script src="/content/js/initiateCategories.js"></script>
<script src="/content/js/hideWelcomeScreens.js"></script>
<script src="/content/js/showHighRanked.js"></script>
<!--<script src="/content/js/showAlbumVote.js"></script>-->
<!--<script src="/content/js/jssor.js"></script>-->
<!--<script src="/content/js/jssor.slider.js"></script>-->
<!--<sript src="/content/js/slider.js"></sript>-->
<!--<script src="/content/js/showAlbumsComments.js"></script>-->
<div id="container">

