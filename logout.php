<?php
session_start();

// Destrói todas as variáveis da sessão
session_unset();
session_destroy();

// Redireciona para a página de login
header("Location: login.php");
exit;
