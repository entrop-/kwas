<?php
/**
 * Created by PhpStorm.
 * User: fafq
 * Date: 04.09.14
 * Time: 21:50
 */

/**
 * Class Image
 *
 * Helper for image operations.
 */
class Image
{
    const IMG_URL_REGEXP = '!http://[^?#]+\.(?:jpe?g|png|gif)!Ui';

    /**
     * Extracts image URL from given subject.
     *
     * Returns extracted URL or null on failure.
     *
     * @param $subject
     * @return null
     */
    static public function parseImageUrl($subject)
    {
        $urls = array();
        preg_match(self::IMG_URL_REGEXP, $subject, $urls);

        return !empty($urls) ? $urls[0] : null;
    }

    /**
     * Checks if given URL leads to an image.
     *
     * @param $url
     * @return bool
     */
    static public function isImageUrl($url)
    {
        return preg_match(self::IMG_URL_REGEXP, $url) === 1;
    }

    /**
     * Retrieves dimensions of image under given
     * URL address.
     *
     * Returns dimensions or null on failure.
     *
     * @param $url
     * @return array|null
     */
    static public function getImageDimensions($url)
    {
        if (!static::isImageUrl($url)) {
            return null;
        }

        $data = @getimagesize($url);
        if ($data === false) {
            return null;
        }

        return array(
            'width' => $data[0],
            'height' => $data[1]
        );
    }
}