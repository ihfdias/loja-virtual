<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Verifica se o carrinho existe e não está vazio
if (empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit;
}

// Aqui você pode implementar a lógica para salvar o pedido no banco de dados
// Por enquanto, vamos apenas limpar o carrinho

unset($_SESSION['cart']); // Limpa o carrinho

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Pedido Finalizado</title>
</head>
<body>
    <h2>Pedido finalizado com sucesso!</h2>
    <p>Obrigado por comprar conosco, <?= htmlspecialchars($_SESSION['user_name']) ?>.</p>
    <a href="index.php">Voltar para a loja</a>
</body>
</html>
