<?php
require_once __DIR__.'/../model/Database.php';
class Config{
    const DB_NAME = 'id20013112_blogdb';
    const DB_USER = 'id20013112_ahmedsellami';
    const DB_PASS = 'Azerty##2022';
    const DB_HOST = 'localhost';
    public static function getDB(){
        return Database::getInstance(self::DB_HOST, self::DB_NAME, self::DB_USER, self::DB_PASS);
        }
}
?>