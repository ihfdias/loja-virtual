<a href="cart.php">
    🛒 Carrinho (<?= $totalItens ?>)
</a>

<?php if (isset($_SESSION['user_id'])): ?>
    <a href="logout.php">Sair</a>
<?php else: ?>
    <a href="login.php">Entrar</a>
<?php endif; ?>
