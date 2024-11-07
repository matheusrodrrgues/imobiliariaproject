<?php
session_start();
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $query = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
    $query->bindParam(':email', $email);
    $query->execute();
    $user = $query->fetch();

    if ($user && password_verify($senha, $user['senha'])) {
        $_SESSION['user_id'] = $user['id'];
        header("Location: profile.php");
        exit();
    } else {
        $error = "Credenciais inválidas.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Área de Login</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.1.2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-20">
        <h2 class="text-3xl font-bold text-center">Acesso</h2>
        <form method="POST" action="" id="loginForm" class="max-w-md mx-auto mt-8 bg-white p-6 rounded-lg shadow-md">
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email</label>
                <input type="email" id="email" name="email" class="w-full px-4 py-2 border rounded-lg" required>
            </div>
            <div class="mb-6">
                <label for="password" class="block text-gray-700">Senha</label>
                <input type="password" name="senha" id="password" class="w-full px-4 py-2 border rounded-lg" required>
            </div>
            <button type="submit" class="w-full btn-primary bg-blue-500 text-white py-2 rounded-lg">Entrar</button>
            <a href="/login" class="btn btn-primary mt-6" style=" margin-top: 3px;
            background: #e90000;">Registrar-se</a>

        

        </form>
        
        
        <?php if (isset($error)): ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>    </div>
</body>
</html>
