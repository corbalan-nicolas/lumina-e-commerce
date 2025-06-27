<?php

require_once "../functions/autoload.php";

Cart::clearItems();

header("Location: ../index.php?section=cart");
