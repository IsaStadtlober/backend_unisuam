<?php
// Redireciona para a tela de cadastro após 5 segundos
header("refresh:5;url=cadastro.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Concluído</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
            background-color: #f8f9fa;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-success">Cadastro Concluído!</h2>
        <p>Parabéns! Seu cadastro foi realizado com sucesso.</p>
        <p>Você será redirecionado automaticamente para a tela de cadastro em 5 segundos.</p>
        <p>Se não for redirecionado, <a href="cadastro.php">clique aqui</a>.</p>
    </div>
</body>
</html>
