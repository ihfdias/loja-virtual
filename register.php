<?php
require_once 'includes/db.php';

// Inicializa mensagens
$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recebe dados do formulário
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];

    // Verifica se campos estão preenchidos
    if (empty($nome) || empty($email) || empty($senha)) {
        $mensagem = 'Preencha todos os campos!';
    } else {
        // Verifica se e-mail já está cadastrado
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $usuario = $stmt->fetch();

        if ($usuario) {
            $mensagem = 'E-mail já cadastrado!';
        } else {
            // Criptografa a senha
            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

            // Insere novo usuário no banco
            $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
            $stmt->execute([$nome, $email, $senhaHash]);

            $mensagem = 'Cadastro realizado com sucesso!';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>
    <link rel="stylesheet" href="assets/style.css"> <!-- opcional -->
</head>
<body>
    <h2>Cadastro de Usuário</h2>

    <?php if (!empty($mensagem)): ?>
        <p style="color: red;"><?= htmlspecialchars($mensagem) ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <label>Nome:</label><br>
        <input type="text" name="nome"><br><br>

        <label>Email:</label><br>
        <input type="email" name="email"><br><br>

        <label>Senha:</label><br>
        <input type="password" name="senha"><br><br>

        <button type="submit">Cadastrar</button>
    </form>

    <p>Já tem conta? <a href="login.php">Faça login</a></p>
</body>
</html>
