<?php

if(!isset($_SESSION)) {
    session_start();
}

if(!isset($_SESSION['id_usuario'])) {
    die("Faça o login antes de acessar. <p> <a href=\"index.php\"> Entrar </a> </p>");

}

?>