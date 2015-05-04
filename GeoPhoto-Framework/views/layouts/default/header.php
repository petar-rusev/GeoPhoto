<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>
        <?php if(isset($this->title)) echo htmlspecialchars($this->title)?>
    </title>
    <script src="/content/lib/jquery/jquery-2.1.3.js"></script>
    <script src="/content/lib/bootstrap/bootstrap-3.1.1.js"></script>
    <script src="/content/lib/jquery.noty/jquery.noty.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
    <link rel="stylesheet" href="/content/styles/bootstrap/bootstrap.css"/>
    <link rel="stylesheet" href="/content/styles/bootstrapTheme.css"/>
    <link rel="stylesheet" href="/content/styles/app.css"/>
    <link rel="stylesheet" href="/content/styles/forms.css"/>
    <link rel="stylesheet" href="/content/styles/album.css"/>
</head>
<body>
<header>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">GeoPhoto</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
                    <li><a href="#">Link</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Separated link</a></li>
                            <li class="divider"></li>
                            <li><a href="#">One more separated link</a></li>
                        </ul>
                    </li>
                </ul>
                <form class="navbar-form navbar-left" role="search">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search">
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#">Link</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>
</body>
</html>