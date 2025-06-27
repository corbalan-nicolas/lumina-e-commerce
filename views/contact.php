<section class="p-4 flex max-md:flex-col md:items-center gap-4">
  <!--
  *********************************************************************************
                                     INTRODUCTION
  *********************************************************************************
  -->
  <div>
    <h2 class="text-6xl">Información de Contacto</h2>

    <p>Gracias por visitar nuestro sitio web. Estamos acá para asistirte en cualquier consulta que puedas tener 🤗</p>

    <div class="flex items-center gap-2">
      <button id="btnCopyEmail" class="btn btn--outlined btn--text-normal my-2">
        <span class="icon icon--email"></span>
        contacto@lumina.com
      </button>
      <span id="spanCopyEmail" class="copied-to-clipboard">
        <svg width="24" height="24" fill="white">
          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
          <path d="M17 3.34a10 10 0 1 1 -14.995 8.984l-.005 -.324l.005 -.324a10 10 0 0 1 14.995 -8.336zm-1.293 5.953a1 1 0 0 0 -1.32 -.083l-.094 .083l-3.293 3.292l-1.293 -1.292l-.094 -.083a1 1 0 0 0 -1.403 1.403l.083 .094l2 2l.094 .083a1 1 0 0 0 1.226 0l.094 -.083l4 -4l.083 -.094a1 1 0 0 0 -.083 -1.32z" />
        </svg>
        Copiado
      </span>
    </div>

    <div class="flex items-center gap-2">
      <button id="btnCopyNumber" class="btn btn--outlined my-2">
        <span class="icon icon--phone"></span>
        +54 9 11 3143-6286
      </button>
      <span id="spanCopyNumber" class="copied-to-clipboard">
        <svg width="24" height="24" fill="white">
          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
          <path d="M17 3.34a10 10 0 1 1 -14.995 8.984l-.005 -.324l.005 -.324a10 10 0 0 1 14.995 -8.336zm-1.293 5.953a1 1 0 0 0 -1.32 -.083l-.094 .083l-3.293 3.292l-1.293 -1.292l-.094 -.083a1 1 0 0 0 -1.403 1.403l.083 .094l2 2l.094 .083a1 1 0 0 0 1.226 0l.094 -.083l4 -4l.083 -.094a1 1 0 0 0 -.083 -1.32z" />
        </svg>
        Copiado
      </span>
    </div>

  </div>





  <!--
  *********************************************************************************
                                   CONTACT -> FORM
  *********************************************************************************
  -->
  <div>
    <form class="p-4 bg-white rounded" action="index.php?section=contact-response" method="post">
      <h3 class="text-3xl">Hacenos una pregunta</h3>
      <p>Si tenés alguna pregunta, podes contactarnos llenando el formulario de abajo</p>

      <div class="grid max-md:sm:grid-cols-2 lg:grid-cols-2 gap-4 mt-6">
        <label>
          <span class="sr-only">Nombre/s</span>
          <input type="text" name="firstName" placeholder="Nombre/s *" required>
        </label>
        <label>
          <span class="sr-only">Apellido/s</span>
          <input type="text" name="lastName" placeholder="Apellido/s *" required>
        </label>
        <label>
          <span class="sr-only">Teléfono</span>
          <input type="tel" name="phoneNumber" placeholder="Teléfono">
        </label>
        <label>
          <span class="sr-only">Email</span>
          <input type="email" name="email" placeholder="Email *" required>
        </label>
        <label class="col-span-full">
          <span class="sr-only">Mensaje</span>
          <textarea name="message" rows="6" placeholder="Mensaje *" required></textarea>
        </label>

        <button class="btn col-span-full">Enviar</button>
      </div>
    </form>
  </div>
</section>





<!--
*********************************************************************************
                                    SCRIPTS
*********************************************************************************
-->
<script defer src="js/view-contact.js"></script>