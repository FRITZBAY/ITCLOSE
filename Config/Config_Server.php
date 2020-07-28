<?php

/**
 * Created by PhpStorm.

 * User: FRITZBAY

 * Date: 27/01/2018

 * Time: 07h19.
 */
require 'Database.php';

use App\config\Database;

class App
{
    const DB_NAME = 'itclose2db';

    const DB_USER = 'root';

    const DB_PASS = 'ItClose2020*';

    const DB_HOST = 'localhost';

    /* const DB_NAME = 'adsysti2_search_engine';

     const DB_USER = 'root';

     const DB_PASS = '';

    const DB_HOST = 'localhost';

 */

    private static $database;

    public static function getDB()
    {
        if (self::$database === null) {
            self::$database = new Database(self::DB_HOST, self::DB_NAME, self::DB_USER, self::DB_PASS);
        }

        return self::$database;
    }
}
