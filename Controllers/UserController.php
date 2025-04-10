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

    public function logout() {
        session_start();
        session_destroy();
        header("Location: /login");
        exit;
    }
    

    public function auth() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email']);
            $senha = trim($_POST['password']);
    
            $userModel = new UserModel();
            $user = $userModel->getUserByEmail($email);
    
            if ($user && password_verify($senha, $user['password'])) {
                session_start();
                $_SESSION['user'] = $user;
                header("Location: /menu");
                exit;
            } else {
                echo "Email ou senha inválidos.";
            }
        }
    }
    
    public function menu() {
        session_start();
        if (!isset($_SESSION['user'])) {
            header("Location: /login");
            exit;
        }
    
        RenderView::loadView('user_menu.php', [
            'user' => $_SESSION['user']['name'],
        ]);
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
