<?php

require_once 'Utilitarios/RenderView.php';
require_once 'Models/UserModel.php';

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

    public function cadastro() {
        RenderView::loadView('/cadastro');
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome  = trim($_POST['nome']);
            $email = trim($_POST['email']);
            $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

            $userModel = new UserModel();
            $success = $userModel->createUser($nome, $email, $senha);

            if ($success) {
                header("Location: /login");
                exit;
            } else {
                echo "Erro ao cadastrar usuário!";
            }
        }
    }

}
