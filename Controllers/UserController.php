<?php

require_once 'Utilitarios/RenderView.php';

class UserController {
    
    public function index() {
        echo "Página de usuários.";
    }

    public function show($id) {
        echo "Usuário: " . htmlspecialchars($id[0]);
    }

    public function login() {
        RenderView::loadView('login');
    }

}
