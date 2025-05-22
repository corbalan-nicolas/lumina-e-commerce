<?php

require_once "classes/View.php";

$view = View::validate_view($_GET["section"] ?? "catalog");


?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= "{$view->getTitle()} | Lumina" ?></title>

  <link rel="icon" href="img/favicons/favicon-16x16-dark.ico" type="image/x-icon" media="(prefers-color-scheme: light)">
  <link rel="icon" href="img/favicons/favicon-16x16-white.ico" type="image/x-icon" media="(prefers-color-scheme: dark)">

  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/menu.css">
  <link rel="stylesheet" href="css/filters.css">
  <script defer src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

  <script defer src="js/app.js"></script>
</head>

<body class="animations-none">
  <a href="#mainContent" class="skip-link">Saltar al contenido principal</a>

  <div id="smokeArea" class="smoke-area"></div>

  <header class="container-full">
    <div class="container--logo">
      <div class="container flex justify-center">
        <!-- Logo -->
        <img class="logo logo--header" src="img/logo.svg" alt="Logo de Lumina">
        <h1 class="hidden">Lumina</h1>
      </div>
    </div>
    <div class="container--subheader">
      <div class="container subheader flex justify-end [@media(pointer:fine)]:justify-between">
        <button id="btnSmoke" title="Activar / Desactivar efecto de humo">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-matchstick">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M3 21l14 -9" />
            <path d="M17 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
            <path class="icon-smoke__path" d="M17 3l3.62 7.29a4.007 4.007 0 0 1 -.764 4.51a4 4 0 0 1 -6.493 -4.464l3.637 -7.336z" />
          </svg>
        </button>

        <!-- Navegación -->
        <button id="btnMenu" class="tab-ignore" title="Abrir / Cerrar menú">
          <svg class="icon-menu" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <!-- <path stroke="none" d="M0 0h24v24H0z" fill="none" /> -->
            <path class="icon-menu__path icon-menu__path--top" d="M4 6l16 0" />
            <path class="icon-menu__path icon-menu__path--mid" d="M4 12l16 0" />
            <path class="icon-menu__path icon-menu__path--bot" d="M4 18l16 0" />
          </svg>
        </button>

        <div class="menu__container">
          <div class="menu">
            <div class="menu__header">
              <img class="logo" src="img/logo.svg" alt="Logo de Lumina">
            </div>
            <div class="menu__body">
              <nav>
                <strong class="menu__title">Navegación</strong>
                <ul>
                  <li>
                    <a class="nav__item" href="index.php?section=catalog">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-candle">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M9 21h6v-10a1 1 0 0 0 -1 -1h-4a1 1 0 0 0 -1 1z" />
                        <path d="M12 2l1.465 1.638a2 2 0 1 1 -3.015 .099z" />
                      </svg>
                      <span>Productos</span>
                    </a>
                  </li>
                  <li>
                    <a class="nav__item" href="index.php?section=about-us">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-users-group">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                        <path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1" />
                        <path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                        <path d="M17 10h2a2 2 0 0 1 2 2v1" />
                        <path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                        <path d="M3 13v-1a2 2 0 0 1 2 -2h2" />
                      </svg>
                      <span>Nosotros</span>
                    </a>
                  </li>
                  <li>
                    <a class="nav__item" href="index.php?section=student">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-school">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M22 9l-10 -4l-10 4l10 4l10 -4v6" />
                        <path d="M6 10.6v5.4a6 3 0 0 0 12 0v-5.4" />
                      </svg>
                      <span>Alumno</span>
                    </a>
                  </li>
                  <li>
                    <a class="nav__item" href="index.php?section=contact">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-phone">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" />
                      </svg>
                      <span>Contacto</span>
                    </a>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>

  <main id="mainContent" class="container">
    <?php
    require_once "views/{$view->getName()}.php";
    ?>
    <div class="h-900"></div>
  </main>

  <footer>
    <div class="container">
      <p>&copy; Corbalan Nicolas Leonel, 2025</p>
    </div>
  </footer>
</body>

</html>