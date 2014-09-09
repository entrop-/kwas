<?
if (!is_numeric($_GET['page'])) die('idź byc hackerem gdzie indziej :(');
require_once 'bootstrap.php';
$model = new Links();

$links = $model->getAll(10,$_GET['page']);
if (!empty($links)){
foreach ($links as $link) {
    echo '<div class="element-item span-3';
    echo $link['width'] < $link['height'] ? ' portrait' : ' landscape';
    echo '"><a href="' . $link['url'] . '"><img src="' . $link['url'] . '" alt=""></a></div>';
}
}