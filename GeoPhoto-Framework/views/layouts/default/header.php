<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>
        <?php if(isset($this->title)) echo htmlspecialchars($this->title)?>
    </title>
    <script src="/content/lib/jquery/jquery-2.1.3.js"></script>
    <script src="/content/lib/bootstrap/bootstrap-3.1.1.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
    <script src="/content/js/initialize.js"></script>
    <script src="/content/js/currentPosition.js"></script>
    <link rel="stylesheet" href="/content/styles/bootstrap/bootstrap.css"/>
</head>
<body>
<header>
    <img src="/content/images/geo.png" alt=""/>
</header>
</body>
</html>