<?php
namespace Kwas;
use PDO;

class Db
{

    //protected $dbh;

    public function __construct()
    {
        $this->dbh = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
        $this->dbh->query('SET NAMES UTF8');
    }

    /*
     * compares last date with db date
     */


    public function updatePost($post)
    {


        //print_r($data);
        $q = 'UPDATE images SET `title`=?, `art`=?, `categ`=?, `link`=?, `tags`=? WHERE id=? LIMIT 1';
        $st = $this->dbh->prepare($q);
        $st->execute();

    }

    public function getTopDate()
    {
        $q = 'SELECT post_time
	FROM `images`
	WHERE 1
	ORDER BY id DESC
	LIMIT 1
	';

        $st = $this->dbh->prepare($q);
        $st->execute();
        while ($line = $st->fetch(PDO::FETCH_ASSOC)) {
            $result[] = $line;
        }
        return $result;

    }

}