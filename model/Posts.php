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

    /**
     * Retrieves images from recent chat history.
     *
     * Returned data contains an array of images,
     * each row containing image URL and posting
     * date.
     *
     * @return array
     */
    public function fetchRecentImages()
    {
        $posts =  $this->_hc->get_rooms_history('517400','recent');
        $posts = array_reverse($posts);

        $images = array();
        foreach ($posts as $post) {
            $url = Image::parseImageUrl($post->message);
            if ($url !== null) {
                $images[] = array(
                    'url' => $url,
                    'date' => $post->date
                );
            }
        }

        return $images;
    }
}