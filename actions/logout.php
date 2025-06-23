<?php

require_once "../functions/autoload.php";

Authentication::logOut();

if (isset($_GET["login-again"])) {
  header("Location: ../index.php?section=login");
} else {
  header("Location: ../index.php");
}
