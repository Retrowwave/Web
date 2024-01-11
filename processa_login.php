<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $username = htmlspecialchars($_POST["username"]);
    $password = htmlspecialchars($_POST["password"]);

    // Salva os dados em um arquivo (exemplo simples)
    $dados = "$username|$password\n";
    file_put_contents("usuarios.txt", $dados, FILE_APPEND);

    // Registro bem-sucedido
    echo "Registro bem-sucedido! Agora você pode fazer login.";
} else {
    // Acesso direto ao arquivo não permitido
    echo "Acesso não autorizado.";
}