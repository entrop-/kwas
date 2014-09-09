<?php
require_once 'bootstrap.php';
?><!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Kwas</title>
<!--    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>-->
    <script src="assets/js/vendor/jquery-1.11.min.js"></script>
    <script src="assets/js/vendor/masonry.pkgd.min.js"></script>
    <link href="assets/stylesheets/screen.css" rel="stylesheet" >
</head>
<body>
<div class="gallery" data-page="1">
<?php
$model = new Links();

$links = $model->getAll(10,1);
foreach ($links as $link) {
    echo '<div class="element-item span-3';
    echo $link['width'] < $link['height'] ? ' portrait' : ' landscape';
    echo '"><a href="' . $link['url'] . '"><img src="' . $link['url'] . '" alt=""></a></div>';
}

?>

</div>
<!--<div class="spinner">loading..</div>-->
<script src="assets/js/scripts.js"></script>
</body>
</html>