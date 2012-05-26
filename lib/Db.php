<?php

class Db {
  private static $_pdoInstance = null;

  public static function getPdoInstance() {
    if(self::$_pdoInstance == null) {
      $dbConfig = include 'config/db.php';
      self::$_pdoInstance = new PDO($dbConfig['dsn'], $dbConfig['username'], $dbConfig['password'], $dbConfig['driverOptions']);
      self::$_pdoInstance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      self::$_pdoInstance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE , PDO::FETCH_ASSOC);
    }
    return self::$_pdoInstance;
  }
}