<?php
/**
 * Created by PhpStorm.
 * User: fafq
 * Date: 03.09.14
 * Time: 22:22
 */

/**
 * Class Links
 *
 * Manage links repository.
 */
class Links
{
    const FETCH_NEWEST = 0;
    const FETCH_OLDEST = 1;

    /** @var PDO */
    protected $_db = null;
    /** @var int  */
    protected $_fetchType = self::FETCH_NEWEST;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->_db = Db::instance()->connection();
    }

    /**
     * Indicates fetch order. Newest links first.
     */
    public function setFetchNewest()
    {
        $this->_fetchType = self::FETCH_NEWEST;
    }

    /**
     * Indicates fetch order. Oldest links first.
     */
    public function setFetchOldest()
    {
        $this->_fetchType = self::FETCH_OLDEST;
    }

    /**
     * Adds new URL to repository.
     *
     * @param $url
     * @param null $date
     * @return bool
     */
    public function addLink($url, $date = null)
    {
        $dimensions = Image::getImageDimensions($url);

        $width = $dimensions !== null ? $dimensions['width'] : null;
        $height = $dimensions !== null ? $dimensions['height'] : null;

        $insert = $this->_db->prepare($sql = "INSERT INTO `links` (`url`, `date`, `width`, `height`) VALUES (:url, :date, :width, :height)");
        $insert->bindParam('url', $url);
        $insert->bindParam('date', $date);
        $insert->bindParam('width', $width);
        $insert->bindParam('height', $height);

        return $insert->execute();
    }

    /**
     * Retrieves number of entries from repository.
     *
     * If no parameters are given all entries are
     * fetched. Otherwise pagination is applied.
     *
     * @param null $pageSize
     * @param null $pageNo
     * @return array|null
     */
    public function getAll($pageSize = null, $pageNo = null)
    {
        $limit = '';
        if (is_numeric($pageSize) && $pageSize > 0) {
            $pageNo = (is_numeric($pageNo) && $pageNo > 0) ? $pageNo : 0;
            $offset = ($pageNo - 1) * $pageSize;

            $limit = sprintf(' LIMIT %d, %d', $offset, $pageSize);
        }

        $order = " ORDER BY `date` " . ($this->_fetchType == self::FETCH_NEWEST ? "DESC" : "ASC");

        $select = $this->_db->query("SELECT * FROM `links`" . $order . $limit );
        $select->execute();

        $result = $select->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($result)) {
            return $result;
        }

        return null;
    }
}