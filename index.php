<?php
require_once 'bootstrap.php';
?>
<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Kwas</title>
<!--    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>-->
    <script src="assets/js/vendor/jquery-1.11.min.js"></script>
    <link href="assets/stylesheets/screen.css" rel="stylesheet" >
</head>
<body>
<div class="gallery">
<?php
$model = new Links();

$links = $model->getAll();
foreach ($links as $link) {
    echo '<div class="element-item span_3"><a href="#"><img src="' . $link['url'] . '" alt=""></a></div>';
}

?>
</div>
<script src="assets/js/vendor/isotope.pkgd.min.js"></script>
<script src="assets/js/scripts.js"></script>
</body>
</html>