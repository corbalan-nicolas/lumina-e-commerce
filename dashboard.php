<?php

require_once "functions/autoload.php";

$view = View::validate_view($_GET["section"] ?? "admin-products");
Authentication::verifyView(intval($view->getRestricted()));
$user = $_SESSION["lumina-user"] ?? false;

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= "{$view->getTitle()} | Dashboard Lumina" ?></title>

  <link rel="icon" href="img/favicons/favicon-16x16-dark.ico" type="image/x-icon" media="(prefers-color-scheme: light)">
  <link rel="icon" href="img/favicons/favicon-16x16-white.ico" type="image/x-icon" media="(prefers-color-scheme: dark)">

  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/menu.css">
  <script defer src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

  <script defer src="js/app.js"></script>
</head>

<body>
  <a href="#mainContent" class="skip-link">Saltar al contenido principal</a>

  <div id="smokeArea" class="smoke-area">
    <!-- ¿Cómo funciona el "efecto humo"? ¿Cuál es su z-index?
      Si el usuario tiene un cursor, éste mismo va a generar una especie de efecto humo,
      cada particula que se genera (mediante el evento mouseover en el window) se appendea
      acá, y para que no se vea por encima de los elementos decidí que iba a tener la
      siguiente estructura:

      -------------------------------------------------------------------------------------
      Z-INDEX | ELEMENTO
      --------+----------------------------------------------------------------------------
        15    | "overlapElements" (menús, modales, etc)
        10    | Header
        2     | Hijos directos del <main> o estas cases".over-smoke, .over-smoke--childs"
        1     | Partículas de humo
        0     | La clase ".ignore-smoke-overlap", <main>, y todo lo demás
      -------------------------------------------------------------------------------------

      Usando "data-cpc" (proveniente de "Change-Particle-Color"), se puede cambiar el color
      de la partícula pasándole como parámetro el nuevo color
      -->
  </div>

  <header class="container-full">
    <div class="container--logo_white">
      <div class="container flex justify-center">
        <!-- Logo -->
        <img class="logo logo--header" src="img/logo-white.svg" alt="Logo de Lumina">
        <h1 class="hidden">Lumina - Dashboard</h1>
      </div>
    </div>
    <?php
    $menuType = "dashboard";
    require_once "includes/subheader.php";
    ?>
  </header>

  <main id="mainContent" class="container">
    <?php
    require_once "views/dashboard/{$view->getName()}.php";
    ?>
  </main>

  <footer class="over-smoke--childs">
    <div class="container">
      <p>&copy; Corbalan Nicolas Leonel, 2025</p>
    </div>
  </footer>
</body>

</html>