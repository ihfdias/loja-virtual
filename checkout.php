<?php
session_start();

// Verifica se o carrinho está vazio
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit;
}

// Aqui você pode adicionar a lógica para processar o pedido,
// como salvar os dados no banco de dados e enviar e-mails de confirmação.

// Após processar o pedido, limpe o carrinho
unset($_SESSION['cart']);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Pedido Finalizado</title>
</head>
<body>
    <h1>Obrigado pela sua compra!</h1>
    <p>Seu pedido foi processado com sucesso.</p>
    <a href="index.php">Voltar para a loja</a>
</body>
</html>
