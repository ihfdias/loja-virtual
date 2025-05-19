<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (isset($_POST['product_id'])) {
    $productId = intval($_POST['product_id']);

    if (isset($_SESSION['cart'][$productId])) {
        unset($_SESSION['cart'][$productId]);
    }
}

// Redireciona de volta para o carrinho
header("Location: cart.php");
exit;
