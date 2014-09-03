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

        $urls = $posts->test();
        foreach ($urls as $url) {
            $links->addLink($url);
        }
    }
}

$script = new Kwas_Gatherer_Script();
$script->run();