# LibLab

---

## ✏️ Visão Geral
O projeto **LibLab** é uma aplicação web em PHP criada para gerenciamento de usuários, com funcionalidades como cadastro, login, autenticação, menu protegido e sistema de rotas customizadas. O sistema utiliza o padrão MVC e prioriza boas práticas de segurança e organização de código.

---

## 🎓 Estrutura de Pastas
```
liblab/
├── Config/              # Arquivos de configuração (.env, config.php)
├── Controllers/         # Lógica de controle
├── Core/                # Sistema de rotas e controlador central
├── Models/              # Conexão com banco e lógica de dados
├── Routes/              # Definição das rotas
├── Utilitarios/         # Renderização de views
├── Views/               # Interface do usuário (HTML/PHP)
├── index.php            # Ponto de entrada
├── .env                 # Variáveis de ambiente
├── composer.json        # Gerenciador de dependências
```

---

## 🔒 Segurança

### 1. **Armazenamento Seguro de Credenciais**
- Uso do pacote `vlucas/phpdotenv` para carregar variáveis sensíveis do arquivo `.env`.
- O arquivo `.env` **não deve ser commitado** no controle de versão (`.gitignore`).

### 2. **Hash de Senhas**
- As senhas dos usuários são armazenadas utilizando `password_hash()` com algoritmo seguro (bcrypt por padrão).
- Na autenticação, utiliza-se `password_verify()` para validação.

### 3. **Validação e Escapamento de Entradas**
- Utiliza-se `htmlspecialchars()` para evitar XSS em exibições.
- Dados de entrada são tratados com `trim()`.
- Todas as queries usam **prepared statements** com `PDO` para mitigar **SQL Injection**.

### 4. **Controle de Sessão**
- Início de sessão é realizado apenas quando necessário.
- Rota `/menu` é protegida por checagem de `$_SESSION['user']`.
- `session_destroy()` aplicado no logout para mitigar session hijacking.

### 5. **Tratamento de Erros e Falhas**
- Retornos de erros de login/cadastro são tratados com mensagens amigáveis.
- Erros de banco de dados exibem mensagens genéricas, evitando vazamento de detalhes internos.

---

## 🛠️ Configuração Inicial

### 1. Clonar o repositório
```bash
git clone https://github.com/7acini/liblab
cd liblab
```

### 2. Instalar dependências via Composer
```bash
composer install
```

### 3. Criar arquivo `.env`
```dotenv
DB_HOST="127.0.0.1"
DB_USER="root"
DB_PASS=""
DB_NAME="liblab"
```

### 4. Configurar banco de dados
```sql
CREATE DATABASE liblab;

USE liblab;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255)
);
```

### 5. Acessar o sistema
```text
URL: http://localhost/liblab/
```

---

## 📄 Considerações Finais
- Projeto preparado para futura expansão com PSR-4 e namespaces.
- Adoção da containerização facilitando deploy e desenvolvimento.
- Boas práticas aplicadas sem uso de frameworks, visando compreensão do ciclo completo.
- Facilmente adaptável para uso com middleware, flash messages, ACL e autenticação JWT.

---

**Desenvolvido por:** [Seu Nome ou Time]
**Contato:** email@dominio.com
**Versão:** 1.0

