<?php
/**
 * Created by PhpStorm.
 * User: fafq
 * Date: 03.09.14
 * Time: 22:22
 */

/**
 * Class Posts
 *
 * Fetch and process chat history.
 */
class Posts
{
    /** @var HipChat */
    protected $_hc = null;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->_hc = new HipChat(Config::HC_TOKEN);
        $this->_hc->set_verify_ssl(false);
    }

    public function test()
    {
        //@todo: test method - for removal

        $posts =  $this->_hc->get_rooms_history('517400','recent');
        $posts = array_reverse($posts);

        $urls = array();
        foreach ($posts as $post) {
            $msg = $post->message;
            $images = array();
            preg_match('!http://[^?#]+\.(?:jpe?g|png|gif)!Ui' , $msg , $images);
            if (!empty($images[0])) {
                $img = $images[0];
                $urls[] = $img;
            }
        }

        return $urls;
    }
}