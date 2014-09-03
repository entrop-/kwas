<?php
/**
 * Created by PhpStorm.
 * User: fafq
 * Date: 03.09.14
 * Time: 20:31
 */
require_once dirname(__FILE__) . '/../bootstrap.php';

$db = Db::instance()->connection();
/*
 * Create required tables.
 */
$db->exec("
            CREATE TABLE `config` (
                `key` VARCHAR(64) NOT NULL,
                `value` VARCHAR(255) NULL,
                PRIMARY KEY (`key`)
            )
            COLLATE='utf8_general_ci'
            ENGINE=InnoDB;
        ");
$db->exec("
            CREATE TABLE `links` (
                `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
                `url` VARCHAR(255) NOT NULL,
                `date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                UNIQUE INDEX `UNQ_URL` (`url`),
                PRIMARY KEY (`id`)
            )
            COLLATE='utf8_general_ci'
            ENGINE=InnoDB;
        ");

/*
 * Insert initial version if none is set.
 */
$q = $db->query("SELECT `value` FROM `config` WHERE `key` = 'version'");
$q->execute();
$r = $q->fetchColumn();

if (empty($r)) {
    $db->exec("INSERT INTO `config` VALUES ('version', '1.0.0')");
}