<?php
    if (!session_start()){
        die("Impossivel prosseguir!! <br> Retorne para <a href='login01.php'>Login</a> e tente novamente");
    }
    if(!isset($_SESSION['id'])){
        die("Não foi possível continuar <br> Retorne para <a href='login01.php'>Login</a> e tente novamente");
    }                   
?>