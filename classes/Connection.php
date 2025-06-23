<?php

class Connection
{
  private const DB_SERVER = "localhost";
  private const DB_USERNAME = "root";
  private const DB_PASSWORD = "";
  private const DB_NAME = "pii_lumina";

  private const DB_DSN = "mysql:host=" . self::DB_SERVER . ";dbname=" . self::DB_NAME . ";charset=utf8mb4";

  private static ?PDO $database = null;

  public static function getConnection(): PDO
  {
    if (self::$database === null) {
      self::connect();
    }

    return self::$database;
  }

  public static function connect()
  {
    try {
      self::$database = new PDO(self::DB_DSN, self::DB_USERNAME, self::DB_PASSWORD);
    } catch (Exception $e) {
      die('Hubo un error al conectarse a la Base de Datos');
    }

    return self::$database;
  }
}
