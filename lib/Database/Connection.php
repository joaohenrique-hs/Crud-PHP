<?php

abstract class Connection
{
    public static $con;

    public static function getCon()
    {
        if (self::$con == null) {

            self::$con = new PDO('pgsql: host=db; dbname=crudphp;', 'crud', 'crud');
            //'mysql: host=localhost; dbname=db;', 'user', 'password'
            self::$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$con;
    }
}
