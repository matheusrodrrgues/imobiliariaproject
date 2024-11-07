<?php
session_start();
require 'config.php';

// Verificar se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Obter dados do usuário
$query = $pdo->prepare("SELECT * FROM usuarios WHERE id = :id");
$query->bindParam(':id', $user_id);
$query->execute();
$user = $query->fetch();

// Atualizar dados do usuário
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cpf = $_POST['cpf'];
    $data_nascimento = $_POST['data_nascimento'];
    $email = $_POST['email'];
    $certificacao_imobiliario = $_POST['certificacao_imobiliario'];
    $redes_sociais = $_POST['redes_sociais'];
    $telefone = $_POST['telefone'];

    $query = $pdo->prepare("UPDATE usuarios SET cpf = :cpf, data_nascimento = :data_nascimento, email = :email, 
                            certificacao_imobiliario = :certificacao_imobiliario, redes_sociais = :redes_sociais, 
                            telefone = :telefone WHERE id = :id");
    $query->bindParam(':cpf', $cpf);
    $query->bindParam(':data_nascimento', $data_nascimento);
    $query->bindParam(':email', $email);
    $query->bindParam(':certificacao_imobiliario', $certificacao_imobiliario);
    $query->bindParam(':redes_sociais', $redes_sociais);
    $query->bindParam(':telefone', $telefone);
    $query->bindParam(':id', $user_id);
    $query->execute();

    // Redirecionar após a atualização
    header("Location: profile.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imobiliária Barreto | Atualizar Perfil</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.1.2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800 font-sans">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
            <h2 class="text-2xl font-bold mb-6 text-center">Atualizar Perfil</h2>
            <form method="POST" action="">

                <div class="mb-4">
                    <label for="cpf" class="block text-gray-700">CPF</label>
                    <input type="text" name="cpf" id="cpf" value="<?= htmlspecialchars($user['cpf']); ?>" class="w-full px-4 py-2 border border-gray-300 rounded" required>
                </div>

                <div class="mb-4">
                    <label for="data_nascimento" class="block text-gray-700">Data de Nascimento</label>
                    <input type="date" name="data_nascimento" id="data_nascimento" value="<?= htmlspecialchars($user['data_nascimento']); ?>" class="w-full px-4 py-2 border border-gray-300 rounded" required>
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Email</label>
                    <input type="email" name="email" id="email" value="<?= htmlspecialchars($user['email']); ?>" class="w-full px-4 py-2 border border-gray-300 rounded" required>
                </div>

                <div class="mb-4">
                    <label for="certificacao_imobiliario" class="block text-gray-700">Certificação Regional de Imobiliário</label>
                    <input type="text" name="certificacao_imobiliario" id="certificacao_imobiliario" value="<?= htmlspecialchars($user['certificacao_imobiliario']); ?>" class="w-full px-4 py-2 border border-gray-300 rounded" required>
                </div>

                <div class="mb-4">
                    <label for="redes_sociais" class="block text-gray-700">Redes Sociais</label>
                    <input type="text" name="redes_sociais" id="redes_sociais" value="<?= htmlspecialchars($user['redes_sociais']); ?>" class="w-full px-4 py-2 border border-gray-300 rounded">
                </div>

                <div class="mb-4">
                    <label for="telefone" class="block text-gray-700">Telefone</label>
                    <input type="tel" name="telefone" id="telefone" value="<?= htmlspecialchars($user['telefone']); ?>" class="w-full px-4 py-2 border border-gray-300 rounded" required>
                </div>

                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded w-full">Salvar Alterações</button>
            </form>
            <a href="profile.php" class="block text-center text-blue-500 mt-4">Voltar ao Painel</a>
        </div>
    </div>
</body>
</html>
