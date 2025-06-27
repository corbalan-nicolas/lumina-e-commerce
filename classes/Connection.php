<?php

class Connection
{
  private const DB_SERVER = "localhost";
  private const DB_USERNAME = "root";
  private const DB_PASSWORD = "";
  private const DB_NAME = "pii_lumina";

  private const DB_DSN = "mysql:host=" . self::DB_SERVER . ";dbname=" . self::DB_NAME . ";charset=utf8mb4";

  private static ?PDO $database = null;

  /**
   * Returns the PDO database connection instance.
   * Establishes the connection if it hasn't been created yet.
   *
   * @return PDO The active PDO database connection.
   */
  public static function getConnection(): PDO
  {
    if (self::$database === null) {
      self::connect();
    }

    return self::$database;
  }

  /**
   * Establishes a new PDO connection to the database.
   * If the connection fails, it stops execution with an error message.
   *
   * @return PDO The PDO database connection instance.
   */
  public static function connect()
  {
    try {
      self::$database = new PDO(self::DB_DSN, self::DB_USERNAME, self::DB_PASSWORD);
    } catch (Exception $e) {
      die('Hubo un error al conectarse a la Base de Datos. Disculpe las molestias que esto pueda ocasionar.');
    }

    return self::$database;
  }
}
