<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Verifica se os dados foram enviados
if (isset($_POST['product_id'], $_POST['quantity'])) {
    $productId = intval($_POST['product_id']);
    $quantity = intval($_POST['quantity']);

    // Atualiza a quantidade se o produto estiver no carrinho
    if (isset($_SESSION['cart'][$productId])) {
        if ($quantity > 0) {
            $_SESSION['cart'][$productId]['quantidade'] = $quantity;
        } else {
            // Remove o produto se a quantidade for zero ou negativa
            unset($_SESSION['cart'][$productId]);
        }
    }
}

// Redireciona de volta para o carrinho
header("Location: cart.php");
exit;
