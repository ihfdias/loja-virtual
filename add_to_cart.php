<?php
session_start();
require_once 'includes/db.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Verifica se o ID do produto foi enviado
if (isset($_POST['product_id'])) {
    $productId = intval($_POST['product_id']);

    // Busca o produto no banco
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$productId]);
    $produto = $stmt->fetch();

    if ($produto) {
        // Inicializa o carrinho se ainda não existir
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        // Se o produto já estiver no carrinho, aumenta a quantidade
        if (isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId]['quantidade'] += 1;
        } else {
            // Adiciona novo produto ao carrinho
            $_SESSION['cart'][$productId] = [
                'id' => $produto['id'],
                'nome' => $produto['name'],
                'preco' => $produto['price'],
                'quantidade' => 1
            ];
        }
    }
}

// Redireciona de volta para a loja
header("Location: index.php");
exit;
