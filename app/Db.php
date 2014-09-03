<?php
/**
 * Class Db
 *
 * Wrapper for database connection. Implements singleton pattern.
 */
class Db
{
    /** @var string */
    protected $_host = null;
    /** @var string */
    protected $_user = null;
    /** @var string */
    protected $_password = null;
    /** @var string */
    protected $_dbName = null;
    /** @var PDO */
    protected $_con = null;
    /** @var bool */
    protected $_installed = true;

    /** @var Db */
    static private $_instance = null;

    /**
     * Reads DB config, currently from constants
     * defined in CFG file.
     */
    protected function _readDbConfig()
    {
        $this->_host = Config::DB_HOST;
        $this->_user = Config::DB_USER;
        $this->_password = Config::DB_PASS;
        $this->_dbName = Config::DB_NAME;
    }

    /**
     * Constructor.
     */
    protected function __construct()
    {
        $this->_readDbConfig();

        $this->_con = new PDO(
            'mysql:host=' . $this->_host . ';dbname=' . $this->_dbName,
            $this->_user,
            $this->_password
        );
        $this->_con->exec('SET NAMES UTF8');
    }

    /**
     * Fetches Db instance. Creates a new instance on
     * first call.
     *
     * @return Db
     */
    public static function instance()
    {
        if (static::$_instance === null) {
            static::$_instance = new static;
        }

        return static::$_instance;
    }

    /**
     * PDO connection getter.
     *
     * @return PDO
     */
    public function connection()
    {
        return $this->_con;
    }
}