<?php

class Authentication
{
  public static function logIn(string $email, string $password): mixed
  {
    $user = User::filter_by_email($email);
    if (!$user) {
      // User doesn't exist
      return null;
    } else if (!password_verify($password, $user->getPassword())) {
      // Wrong password
      return false;
    } else {
      // Everything's good 👍
      $_SESSION["user"] = [
        "fullname" => $user->getFullName(),
        "email" => $user->getEmail(),
        "rol" => $user->getRol(),
        "id" => $user->getId()
      ];

      return $user->getRol();
    }
  }

  public static function logOut()
  {
    if (isset($_SESSION["user"])) {
      unset($_SESSION["user"]);
    }
  }

  public static function verifyView(int $restrict = 0, $rootRelativeUrl = "")
  {
    if (!$restrict) {
      // Have access :)
      return true;
    }

    $userExists = $_SESSION["user"];
    $userRol = $_SESSION["user"]["rol"];

    if (!$userExists) {
      // It's restricted and user is not logged in
      header("Location: $rootRelativeUrl" . "index.php?section=login");
    } else if ($userRol == "customer") {
      // Doesn't have access, get tf out of here >:(
      header("Location: $rootRelativeUrl" . "index.php?section=403");
    } else {
      // Have access :)
      return true;
    }
  }
}
