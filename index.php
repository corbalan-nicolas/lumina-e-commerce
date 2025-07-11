<?php

require_once "functions/autoload.php";

$view = View::validate_view($_GET["section"] ?? "catalog");
Authentication::verifyView(intval($view->getRestricted()));
$user = $_SESSION["lumina-user"] ?? false;

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Lo mejor en calidad y cantidad sobre velas aromatizadas">
  <title><?= "{$view->getTitle()} | Lumina" ?></title>

  <link rel="icon" href="img/favicons/favicon-16x16-dark.ico" type="image/x-icon" media="(prefers-color-scheme: light)">
  <link rel="icon" href="img/favicons/favicon-16x16-white.ico" type="image/x-icon" media="(prefers-color-scheme: dark)">

  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/menu.css">
  <script defer src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

  <?php
  if ($view->getName() === "catalog") {
  ?>
    <link rel="stylesheet" href="css/filters.css">
  <?php
  }
  ?>

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
        2     | Hijos directos del <main> o estas clases: ".over-smoke, .over-smoke--childs"
        1     | Partículas de humo
        0     | La clase ".ignore-smoke-overlap", <main>, y todo lo demás
      -------------------------------------------------------------------------------------

      Usando el atributo "data-cpc" (proveniente de "Change-Particle-Color"), se puede
      cambiar el color de la partícula pasándole como parámetro el nuevo color (cualquier
      color utilizable desde css es válido, por ejemplo rgb, hsl, hexadecimal, o colores
      nativos de css como rebeccapurple, red, etc)
      -->
  </div>

  <header class="container-full">
    <div class="container--logo">
      <div class="container flex justify-center">
        <!-- Logo -->
        <img class="logo logo--header" src="img/logo.svg" alt="Logo de Lumina">
        <h1 class="hidden">Lumina</h1>
      </div>
    </div>
    <?php
    $menuType = "index";
    require_once "includes/subheader.php";
    ?>
  </header>

  <main id="mainContent" class="container">
    <?php
    // echo "<pre>";
    // print_r($_SESSION);
    // echo "</pre>";

    require_once "views/{$view->getName()}.php";
    ?>
  </main>

  <footer class="over-smoke--childs">
    <div class="container">
      <p>&copy; Corbalan Nicolas Leonel, 2025</p>
    </div>
  </footer>
</body>

</html>

<!-- TO DO
[ ] Eliminar todos los console.log
[ ] Eliminar todos los print_r
[ ] Confirmar borrar (CRUD)
-->