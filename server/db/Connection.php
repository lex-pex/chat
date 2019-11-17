<?php
namespace Server\Db;

use mysqli;

class Connection
{
    /**
     * Database Connection Object
     * @return MySqli obejct
     */
    public static function getConnection() {
        $params = include 'params.php';
        return new mysqli($params['host'], $params['username'], $params['password'], $params['database']);
    }
}