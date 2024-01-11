<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $username = htmlspecialchars($_POST["username"]);
    $email = htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);

    // Validação básica
    if (empty($username) || empty($email) || empty($password)) {
        // Algum campo está em branco
        echo "Todos os campos são obrigatórios. Por favor, preencha todos.";
        exit;
    }

    // Validação adicional, por exemplo, para o formato do e-mail
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Por favor, insira um endereço de e-mail válido.";
        exit;
    }

    // Salva os dados em um arquivo (exemplo simples)
    // Aqui, você deve usar hashing para a senha em um ambiente de produção
    $dados = "$username|$email|$password\n";
    file_put_contents("usuarios.txt", $dados, FILE_APPEND);

    // Registro bem-sucedido
    echo "Registro bem-sucedido! Agora você pode fazer login.";
} else {
    // Acesso direto ao arquivo não permitido
    echo "Acesso não autorizado.";
}
