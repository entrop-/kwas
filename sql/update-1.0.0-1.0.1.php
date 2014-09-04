<?php
/**
 * Created by PhpStorm.
 * User: fafq
 * Date: 04.09.14
 * Time: 21:36
 */
require_once dirname(__FILE__) . '/../bootstrap.php';

$db = Db::instance()->connection();
/*
 * Add new columns.
 */
$db->exec("
    ALTER TABLE `links`
        ADD COLUMN `width` INT UNSIGNED NULL DEFAULT NULL AFTER `date`,
        ADD COLUMN `height` INT UNSIGNED NULL DEFAULT NULL AFTER `width`;
");
/*
 * Update app version.
 */
$db->exec("
    UPDATE `config` SET `value` = '1.0.1' WHERE `key` = 'version';
");