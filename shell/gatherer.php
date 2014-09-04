<?php
/**
 * Created by PhpStorm.
 * User: fafq
 * Date: 02.09.14
 * Time: 22:46
 */
require_once dirname(__FILE__) . '/abstract.php';

class Kwas_Gatherer_Script extends Kwas_Script_Abstract
{
    public function run()
    {
        $posts = new Posts();
        $links = new Links();

        $images = $posts->fetchRecentImages();
        foreach ($images as $image) {
            $links->addLink($image['url'], $image['date']);
        }
    }
}

$script = new Kwas_Gatherer_Script();
$script->run();