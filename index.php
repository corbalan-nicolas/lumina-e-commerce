<?php

require_once "functions/autoload.php";

$view = View::validate_view($_GET["section"] ?? "catalog");
Authentication::verifyView($view->getRestricted());
$user = $_SESSION["user"] ?? false;
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
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
                      <span class="icon icon--candle-white"></span>
                      <span>Productos</span>
                    </a>
                  </li>
                  <li>
                    <a class="nav__item <?= $view->getName() == "about-us" ? "active" : "" ?>" href="index.php?section=about-us">
                      <span class="icon icon--about-us-white"></span>
                      <span>Nosotros</span>
                    </a>
                  </li>
                  <li>
                    <a class="nav__item <?= $view->getName() == "student" ? "active" : "" ?>" href="index.php?section=student">
                      <span class="icon icon--school-white"></span>
                      <span>Alumno</span>
                    </a>
                  </li>
                  <li>
                    <a class="nav__item <?= $view->getName() == "contact" ? "active" : "" ?>" href="index.php?section=contact">
                      <span class="icon icon--phone-white"></span>
                      <span>Contacto</span>
                    </a>
                  </li>
                  <?php
                  if ($user) {
                  ?>
                    <li class="relative">
                      <a class="nav__item" href>
                        <span class="icon icon--user-white"></span>
                        <span><?= $user["fullname"] ?></span>
                      </a>
                      <ul class="hidden absolute top-[100%] left-0 w-full bg-(--col-marron)">
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
                            <span class="icon icon--user-replace-white"></span>
                            <span>Cambiar de cuenta</span>
                          </a>
                        </li>
                        <li>
                          <a class="nav__item" href="actions/logout.php">
                            <span class="icon icon--logout-white"></span>
                            <span>Cerrar sesión</span>
                          </a>
                        </li>
                      </ul>
                    </li>
                  <?php
                  } else {
                  ?>
                    <li>
                      <a class="nav__item" href="index.php?section=login">
                        <span class="icon icon--login-white"></span>
                        <span>Iniciar sesión</span>
                      </a>
                    </li>
                  <?php
                  }
                  ?>
                </ul>
              </nav>
              <div class="menu__show-only-on-phone mt-6">
                <strong class="menu__title">Accesibilidad</strong>
                <ul>
                  <li>
                    <button id="btnAnimations" class="nav__item">
                      <span class="icon icon--animation"></span>
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