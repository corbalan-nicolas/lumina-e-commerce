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
        2     | Hijos directos del <main> o estas cases".over-smoke, .over-smoke--childs"
        1     | Partículas de humo
        0     | La clase ".ignore-smoke-overlap", <main>, y todo lo demás
      -------------------------------------------------------------------------------------

      Usando "data-cpc" (proveniente de "Change-Particle-Color"), se puede cambiar el color
      de la partícula pasándole como parámetro el nuevo color
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
    <div class="container--subheader">
      <div class="container subheader flex justify-end [@media(pointer:fine)]:justify-between">
        <button id="btnSmoke" title="Activar / Desactivar efecto de humo">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M3 21l14 -9" />
            <path d="M17 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
            <path class="icon-smoke__path" d="M17 3l3.62 7.29a4.007 4.007 0 0 1 -.764 4.51a4 4 0 0 1 -6.493 -4.464l3.637 -7.336z" />
          </svg>
        </button>

        <!-- Menu -->
        <button id="btnMenu" class="py-2 tab-ignore" title="Abrir / Cerrar menú">
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
                  </li>
                  <li>
                    <a class="nav__item <?= $view->getName() == "catalog" ? "active" : "" ?>" href="index.php?section=catalog">
                      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M9 21h6v-10a1 1 0 0 0 -1 -1h-4a1 1 0 0 0 -1 1z" />
                        <path d="M12 2l1.465 1.638a2 2 0 1 1 -3.015 .099z" />
                      </svg>
                      <span>Productos</span>
                    </a>
                  </li>
                  <li>
                    <a class="nav__item <?= $view->getName() == "about-us" ? "active" : "" ?>" href="index.php?section=about-us">
                      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round">
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
                    <a class="nav__item <?= $view->getName() == "student" ? "active" : "" ?>" href="index.php?section=student">
                      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M22 9l-10 -4l-10 4l10 4l10 -4v6" />
                        <path d="M6 10.6v5.4a6 3 0 0 0 12 0v-5.4" />
                      </svg>
                      <span>Alumno</span>
                    </a>
                  </li>
                  <li>
                    <a class="nav__item <?= $view->getName() == "contact" ? "active" : "" ?>" href="index.php?section=contact">
                      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" />
                      </svg>
                      <span>Contacto</span>
                    </a>
                  </li>
                  <?php
                  if ($user) {
                  ?>
                    <li class="nav__sublist-parent">
                      <a class="nav__item" href="index.php?section=user-panel">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                          <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                          <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                        </svg>
                        <span><?= $user["fullname"] ?></span>
                      </a>
                      <ul class="nav__sublist-child">
                        <?php
                        if ($user["rol"] !== "customer") {
                        ?>
                          <li>
                            <a class="nav__item" href="dashboard.php">
                              <span>Panel de administrador</span>
                            </a>
                          </li>
                        <?php
                        }
                        ?>
                        <li>
                          <a class="nav__item" href="actions/logout.php?login-again=true">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round">
                              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                              <path d="M21 11v-3c0 -.53 -.211 -1.039 -.586 -1.414c-.375 -.375 -.884 -.586 -1.414 -.586h-6m0 0l3 3m-3 -3l3 -3" />
                              <path d="M3 13.013v3c0 .53 .211 1.039 .586 1.414c.375 .375 .884 .586 1.414 .586h6m0 0l-3 -3m3 3l-3 3" />
                              <path d="M16 16.502c0 .53 .211 1.039 .586 1.414c.375 .375 .884 .586 1.414 .586c.53 0 1.039 -.211 1.414 -.586c.375 -.375 .586 -.884 .586 -1.414c0 -.53 -.211 -1.039 -.586 -1.414c-.375 -.375 -.884 -.586 -1.414 -.586c-.53 0 -1.039 .211 -1.414 .586c-.375 .375 -.586 .884 -.586 1.414z" />
                              <path d="M4 4.502c0 .53 .211 1.039 .586 1.414c.375 .375 .884 .586 1.414 .586c.53 0 1.039 -.211 1.414 -.586c.375 -.375 .586 -.884 .586 -1.414c0 -.53 -.211 -1.039 -.586 -1.414c-.375 -.375 -.884 -.586 -1.414 -.586c-.53 0 -1.039 .211 -1.414 .586c-.375 .375 -.586 .884 -.586 1.414z" />
                              <path d="M21 21.499c0 -.53 -.211 -1.039 -.586 -1.414c-.375 -.375 -.884 -.586 -1.414 -.586h-2c-.53 0 -1.039 .211 -1.414 .586c-.375 .375 -.586 .884 -.586 1.414" />
                              <path d="M9 9.499c0 -.53 -.211 -1.039 -.586 -1.414c-.375 -.375 -.884 -.586 -1.414 -.586h-2c-.53 0 -1.039 .211 -1.414 .586c-.375 .375 -.586 .884 -.586 1.414" />
                            </svg>
                            <span>Cambiar de cuenta</span>
                          </a>
                        </li>
                        <li>
                          <a class="nav__item" href="actions/logout.php">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round">
                              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                              <path d="M10 8v-2a2 2 0 0 1 2 -2h7a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-2" />
                              <path d="M15 12h-12l3 -3" />
                              <path d="M6 15l-3 -3" />
                            </svg>
                            <span>Cerrar sesión</span>
                          </a>
                        </li>
                      </ul>
                    </li>
                  <?php
                  } else {
                  ?>
                    <li>
                      <a class="nav__item <?= $view->getName() == "login" ? "active" : "" ?>" href="index.php?section=login">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                          <path d="M9 8v-2a2 2 0 0 1 2 -2h7a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-2" />
                          <path d="M3 12h13l-3 -3" />
                          <path d="M13 15l3 -3" />
                        </svg>
                        <span>Iniciar sesión</span>
                      </a>
                    </li>
                  <?php
                  }
                  ?>
                  <li>
                    <a class="nav__item <?= $view->getName() == "cart" ? "active" : "" ?>" href="index.php?section=cart">
                      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                        <path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                        <path d="M17 17h-11v-14h-2" />
                        <path d="M6 5l14 1l-1 7h-13" />
                      </svg>
                    </a>
                  </li>
                </ul>
              </nav>
              <div class="menu__show-only-on-phone mt-6">
                <strong class="menu__title">Accesibilidad</strong>
                <ul>
                  <li>
                    <button id="btnAnimations" class="nav__item">
                      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M3 20c8 0 10 -16 18 -16" />
                      </svg>
                      <span id="textAnimation">Desactivar animaciones</span>
                    </button>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
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