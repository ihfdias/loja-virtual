<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Obtém o carrinho da sessão
$carrinho = $_SESSION['cart'] ?? [];
$total = 0;

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <title>Seu Carrinho</title>
</head>

<body>
    <h2>Seu Carrinho</h2>
    <a href="index.php">← Voltar para a loja</a> |
    <a href="logout.php">Sair</a>
    <hr>

    <?php if (empty($carrinho)): ?>
        <p>O carrinho está vazio.</p>
    <?php else: ?>
        <table border="1" cellpadding="8" cellspacing="0">
            <tr>
                <th>Produto</th>
                <th>Preço</th>
                <th></th>
                <th>Subtotal</th>
                <th>Ação</th>
            </tr>

            <?php foreach ($carrinho as $item): ?>
                <?php $subtotal = $item['preco'] * $item['quantidade']; ?>
                <?php $total += $subtotal; ?>

                <tr>
                    <td><?= htmlspecialchars($item['nome']) ?></td>
                    <td>R$ <?= number_format($item['preco'], 2, ',', '.') ?></td>
                    <td>
                        <form method="POST" action="update_cart.php">
                            <input type="hidden" name="product_id" value="<?= $item['id'] ?>">
                            <input type="number" name="quantity" value="<?= $item['quantidade'] ?>" min="1">
                            <button type="submit">Atualizar</button>
                        </form>
                    </td>

                    <td>R$ <?= number_format($subtotal, 2, ',', '.') ?></td>
                    <td>
                        <form method="POST" action="remove_from_cart.php" style="display:inline;">
                            <input type="hidden" name="product_id" value="<?= $item['id'] ?>">
                            <button type="submit">Remover</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>

            <tr>
                <td colspan="3"><strong>Total:</strong></td>
                <td colspan="2"><strong>R$ <?= number_format($total, 2, ',', '.') ?></strong></td>
            </tr>

        </table>
    <?php endif; ?>
</body>

</html>

<form method="POST" action="finalizar_pedido.php">
    <button type="submit">Finalizar Pedido</button>
</form>