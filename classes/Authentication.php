<?php

class Authentication
{
  /**
   * Attempts to log in a user with the given email and password.
   * Adds alert messages if the email is not found or the password is incorrect.
   * If successful, stores user data in the session.
   *
   * @param string $email    The user's email address.
   * @param string $password The user's plain text password.
   *
   * @return string|false|null Returns the user's role on success, false on wrong password,
   *                           or null if the user does not exist.
   */
  public static function logIn(string $email, string $password): mixed
  {
    $user = User::filter_by_email($email);

    if (!$user) {
      // User doesn't exist
      Alert::addAlert("warning", "No existe un usuario con ese correo electrónico");
      return null;
    } else if (!password_verify($password, $user->getPassword())) {
      // Wrong password
      Alert::addAlert("danger", "Contraseña incorrecta");
      return false;
    } else {
      // Everything's good 👍
      $_SESSION["lumina-user"] = [
        "fullname" => $user->getFullName(),
        "email" => $user->getEmail(),
        "rol" => $user->getRol(),
        "id" => $user->getId()
      ];

      return $user->getRol();
    }
  }

  /**
   * Logs out the current user by removing their data from the session.
   *
   * @return void
   */
  public static function logOut(): void
  {
    if (isset($_SESSION["lumina-user"])) {
      unset($_SESSION["lumina-user"]);
    }
  }

  /**
   * Verifies if the current user has access to a restricted view.
   * Redirects to login or a 403 page if the user lacks permission.
   *
   * @param int    $restrict            Set to 1/2 to restrict access (default is 0 = public access, 1 = requires to be logged in, 2 = only admins).
   * @param string $relativeURLToRoot   (Optional) base URL for redirection (e.g., "../" or "").
   *
   * @return bool Returns true if access is allowed. Otherwise, the user is redirected.
   */
  public static function verifyView(int $restrict = 0, string $relativeURLToRoot = ""): bool
  {
    if (!$restrict) {
      // Have access :)
      return true;
    }

    $userExists = $_SESSION["lumina-user"];
    $userRol = $_SESSION["lumina-user"]["rol"];

    if (!$userExists) {
      // Requires an account, and user it's not logged in
      Alert::addAlert('info', 'Inicie sesión para continuar');
      header("Location: $relativeURLToRoot" . "index.php?section=login");
      return false;
    } else if ($userRol == "customer" && $restrict > 1) {
      // Doesn't have access, get out you dirty boy (only admins allowed)
      header("Location: $relativeURLToRoot" . "index.php?section=403");
      return false;
    } else {
      // Have access :)
      return true;
    }
  }
}
