<?php

function redirect($pagina) {
    header("location:".URL_PROYECTO."/".$pagina);
}