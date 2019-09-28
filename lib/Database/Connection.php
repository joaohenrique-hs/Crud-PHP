<?php

abstract class Connection
{
    public static $con;

    public static function getCon()
    {
        if (self::$con == null) {
            self::$con = new PDO('mysql: host=localhost; dbname=SitePhp;', 'root', 'j2002');
            self::$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$con;
    }
}
