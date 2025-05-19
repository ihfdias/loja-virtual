<?php
session_start();
require_once 'includes/db.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Pega todos os produtos do banco
$stmt = $pdo->query("SELECT * FROM products");
$produtos = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Loja Virtual</title>
</head>
<body>
    <h2>Bem-vindo, <?= htmlspecialchars($_SESSION['user_name']) ?>!</h2>
    <a href="cart.php">🛒 Ver Carrinho</a>
    <a href="logout.php">Sair</a>
    

    <h3>Produtos</h3>

    <?php if (count($produtos) === 0): ?>
        <p>Nenhum produto cadastrado.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($produtos as $produto): ?>
                <li>
                    <strong><?= htmlspecialchars($produto['name']) ?></strong> — R$ <?= number_format($produto['price'], 2, ',', '.') ?>
                    <br>
                    <?php if ($produto['image']): ?>
                        <img src="<?= htmlspecialchars($produto['image']) ?>" alt="<?= htmlspecialchars($produto['name']) ?>" width="100" />
                    <?php endif; ?>
                    <br>
                    <form method="POST" action="add_to_cart.php">
                        <input type="hidden" name="product_id" value="<?= $produto['id'] ?>" />
                        <button type="submit">Adicionar ao carrinho</button>
                    </form>
                </li>
                <hr>
            <?php endforeach; ?>
        </ul>        
    <?php endif; ?>
</body>
</html>


