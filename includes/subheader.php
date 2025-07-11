<div class="container--subheader">
  <div class="container subheader flex justify-end [@media(pointer:fine)]:justify-between">





    <!--
    *********************************************************************************
                                TOGGLE SMOKE EFFECT
    *********************************************************************************
    -->
    <button id="btnSmoke" title="Activar / Desactivar efecto de humo">
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
        <path d="M3 21l14 -9" />
        <path d="M17 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
        <path class="icon-smoke__path" d="M17 3l3.62 7.29a4.007 4.007 0 0 1 -.764 4.51a4 4 0 0 1 -6.493 -4.464l3.637 -7.336z" />
      </svg>
    </button>





    <!--
    *********************************************************************************
                                    TOGGLE MENU
    *********************************************************************************
    -->
    <button id="btnMenu" class="py-2 tab-ignore" title="Abrir / Cerrar menú">
      <svg class="icon-menu" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <!-- <path stroke="none" d="M0 0h24v24H0z" fill="none" /> -->
        <path class="icon-menu__path icon-menu__path--top" d="M4 6l16 0" />
        <path class="icon-menu__path icon-menu__path--mid" d="M4 12l16 0" />
        <path class="icon-menu__path icon-menu__path--bot" d="M4 18l16 0" />
      </svg>
    </button>





    <!--
    *********************************************************************************
                                    MENU CONTAINER
    *********************************************************************************
    -->
    <div class="menu__container">
      <div class="menu">





        <!--
        *********************************************************************************
                                        HEADER
        *********************************************************************************
        -->
        <div class="menu__header">
          <img class="logo" src="img/logo.svg" alt="Logo de Lumina">
        </div>





        <!--
        *********************************************************************************
                                      NAGIVATION
        *********************************************************************************
        -->
        <div class="menu__body">
          <nav>
            <strong class="menu__title">Navegación</strong>
            <ul>





              <!--
              *********************************************************************************
                                    NAGIVATION LINKS -> INDEX / FRONTEND
              *********************************************************************************
              -->
              <?php if ($menuType === "index") { ?>
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





                <!--
              *********************************************************************************
                                    NAGIVATION LINKS -> DASHBOARD / BACKEND
              *********************************************************************************
              -->
              <?php } else if ($menuType === "dashboard") { ?>
                <li>
                  <a class="nav__item <?= $view->getName() == "admin-products" ? "active" : "" ?>" href="dashboard.php">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                      <path d="M9 21h6v-10a1 1 0 0 0 -1 -1h-4a1 1 0 0 0 -1 1z" />
                      <path d="M12 2l1.465 1.638a2 2 0 1 1 -3.015 .099z" />
                    </svg>
                    <span>Velas</span>
                  </a>
                </li>
                <li>
                  <a class="nav__item <?= $view->getName() == "admin-categories" ? "active" : "" ?>" href="dashboard.php?section=admin-categories">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                      <path d="M14 4h6v6h-6z" />
                      <path d="M4 14h6v6h-6z" />
                      <path d="M17 17m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                      <path d="M7 7m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                    </svg>
                    <span>Categorías</span>
                  </a>
                </li>
                <li>
                  <a class="nav__item <?= $view->getName() == "admin-tags" ? "active" : "" ?>" href="dashboard.php?section=admin-tags">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                      <path d="M7.5 7.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                      <path d="M3 6v5.172a2 2 0 0 0 .586 1.414l7.71 7.71a2.41 2.41 0 0 0 3.408 0l5.592 -5.592a2.41 2.41 0 0 0 0 -3.408l-7.71 -7.71a2 2 0 0 0 -1.414 -.586h-5.172a3 3 0 0 0 -3 3z" />
                    </svg>
                    <span>Etiquetas</span>
                  </a>
                </li>
              <?php } ?>





              <!--
              *********************************************************************************
                                      NAGIVATION LINKS -> GLOBAL
              *********************************************************************************
              -->
              <li>
                <a title="Carrito" class="nav__item <?= $view->getName() == "cart" ? "active" : "" ?>" href="index.php?section=cart">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                    <path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                    <path d="M17 17h-11v-14h-2" />
                    <path d="M6 5l14 1l-1 7h-13" />
                  </svg>
                  <span class="menu__hide-on-desktop">Carrito</span>
                </a>
              </li>
              <?php
              if ($user) {
              ?>
                <li class="nav__sublist-parent">
                  <a title="Panel de usuario" class="nav__item <?= $view->getName() == "user-panel" ? "active" : "" ?>" href="index.php?section=user-panel">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                      <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                      <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                    </svg>
                    <span class="menu__hide-on-desktop"><?= $user["fullname"] ?></span>
                  </a>
                  <ul class="nav__sublist-child">
                    <li class="nav__item no-hover menu__hide-on-phone"><?= $user["fullname"] ?></li>
                    <?php if ($user["rol"] !== "customer" && $menuType === "index") { ?>
                      <li>
                        <a class="nav__item" href="dashboard.php">
                          <span>Dashboard</span>
                        </a>
                      </li>
                    <?php } else if ($user["rol"] !== "customer" && $menuType === "dashboard") { ?>
                      <li>
                        <a class="nav__item" href="index.php">
                          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M3 5m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" />
                            <path d="M6 8h.01" />
                            <path d="M9 8h.01" />
                          </svg>
                          <span>Sitio web</span>
                        </a>
                      </li>
                    <?php } ?>
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
            </ul>
          </nav>





          <!--
          *********************************************************************************
                                          ACCESIBILITY
          *********************************************************************************
          -->
          <div class="menu__hide-on-desktop mt-6">
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