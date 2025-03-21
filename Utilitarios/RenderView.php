<?php 

class RenderView {

    public static function loadView($view, $args = []) {
        if (!file_exists(__DIR__ . "/../Views/$view.php")) {
            die("Erro: A view '$view' não foi encontrada.");
        }

        extract($args); // Transforma array associativo em variáveis individuais
        require_once __DIR__ . "/../Views/$view.php";
    }
}
