<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $username = htmlspecialchars($_POST["username"]);
    $email = htmlspecialchars($_POST["email"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Use hashing para a senha

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

    // Configurações do banco de dados
    $servername = "127.0.0.1";
    $username_db = "root";
    $password_db = "";
    $dbname = "web_server";

    // Cria a conexão
    $conn = new mysqli($servername, $username_db, $password_db, $dbname);

    // Verifica a conexão
    if ($conn->connect_error) {
        die("Falha na conexão com o banco de dados: " . $conn->connect_error);
    }

    // Prepara a declaração SQL
    $stmt = $conn->prepare("INSERT INTO usuarios (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);

    // Executa a declaração SQL
    if ($stmt->execute()) {
        // Registro bem-sucedido
        echo "Registro bem-sucedido! Agora você pode fazer login.";
    } else {
        // Erro no registro
        echo "Erro ao registrar. Tente novamente mais tarde.";
    }

    // Fecha a declaração e a conexão
    $stmt->close();
    $conn->close();
} else {
    // Acesso direto ao arquivo não permitido
    echo "Acesso não autorizado.";
}
?>
