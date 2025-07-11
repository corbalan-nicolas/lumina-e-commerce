<div class="p-4">

  <h2 class="text-4xl font-semibold">Iniciar sesión</h2>





  <!--
  *********************************************************************************
                                      ALERTS
  *********************************************************************************
  -->
  <?php require_once "includes/alerts.php" ?>





  <!--
  *********************************************************************************
                                      FORM
  *********************************************************************************
  -->
  <form action="actions/verify-login.php" method="get">
    <label class="block mb-3">
      Correo Electrónico <span class="text-red-500">*</span>
      <input type="text" name="email" placeholder="usuario@ejemplo.com">
    </label>

    <label for="password">Contraseña <span class="text-red-500">*</span></label>
    <div class="input-group mb-3">
      <input id="password" name="password" type="password" required>
      <label class="has-focus-visible:ring-1">
        <input id="showPassword" class="sr-only" type="checkbox">
        <span title="Mostrar / Ocultar contraseña" id="showPasswordIcon" class="p-2 icon icon--eye-closed"></span>
      </label>
    </div>
    <button class="btn">Iniciar sesión</button>
  </form>
</div>





<!--
*********************************************************************************
                                    SCRIPTS
*********************************************************************************
-->
<script defer src="js/view-login.js"></script>