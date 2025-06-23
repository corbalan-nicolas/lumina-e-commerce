<?php

session_start();

function autoload($className): void
{
  $url = __DIR__ . "/../classes/$className.php";

  if (!file_exists($url)) {
    die("No se pudo cargar la clase $className");
  }

  require_once $url;
}

spl_autoload_register("autoload");
