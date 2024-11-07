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

// Cadastro de imóvel
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $foto = $_POST['foto'];
    $descricao = $_POST['descricao'];
    $valor = $_POST['valor'];

    $query = $pdo->prepare("INSERT INTO imoveis (foto_url, descricao, valor, usuario_id) VALUES (:foto, :descricao, :valor, :usuario_id)");
    $query->bindParam(':foto', $foto);
    $query->bindParam(':descricao', $descricao);
    $query->bindParam(':valor', $valor);
    $query->bindParam(':usuario_id', $user_id);
    $query->execute();
}

// Obter imóveis cadastrados pelo usuário
$imoveis = $pdo->query("SELECT * FROM imoveis WHERE usuario_id = $user_id")->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imobiliária Barreto | Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.1.2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800 font-sans">

    <div class="flex min-h-screen">
        
        <!-- Menu Lateral -->
        <aside class="w-64 bg-gray-900 text-white flex flex-col">
            <div class="p-4 text-center border-b border-gray-800">
                <img id="user-avatar" src="images/perfil.webp" alt="Foto de Perfil" class="w-24 h-24 rounded-full mx-auto mb-4">
                <h3 id="user-name" class="text-xl font-semibold"><?= htmlspecialchars($user['nome']); ?></h3>
                <p id="user-email" class="text-blue-300"><?= htmlspecialchars($user['email']); ?></p>
                <a href="logout.php" class="bg-red-500 text-white px-4 py-2 rounded-lg mt-2">Sair</a>
            </div>
            <nav class="flex-grow p-4">
                <ul>
                    <li class="mb-2"><a href="javascript:void(0);" onclick="toggleModal('perfil-modal')" class="block py-2 px-4 rounded hover:bg-gray-700">Visualizar Perfil</a></li>
                    <li class="mb-2"><a href="#imoveis" class="block py-2 px-4 rounded hover:bg-gray-700">Meus imóveis</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Área Principal -->
        <main class="flex-grow p-8">
            <!-- Cabeçalho -->
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-bold">Painel de Controle</h1>
            </div>

            <!-- Modal para Visualizar Perfil -->
            <div id="perfil-modal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center z-50">
                <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
                    <h2 class="text-2xl font-bold mb-4">Perfil do Usuário</h2>
                    <p><strong>Nome:</strong> <?= htmlspecialchars($user['nome']); ?></p>
                    <p><strong>Email:</strong> <?= htmlspecialchars($user['email']); ?></p>
                    <p><strong>CPF:</strong> <?= htmlspecialchars($user['cpf']); ?></p>
                    <p><strong>Data de Nascimento:</strong> <?= htmlspecialchars($user['data_nascimento']); ?></p>
                    <p><strong>Certificação Imobiliária:</strong> <?= htmlspecialchars($user['certificacao_imobiliario']); ?></p>
                    <p><strong>Redes Sociais:</strong> <?= htmlspecialchars($user['redes_sociais']); ?></p>
                    <p><strong>Telefone:</strong> <?= htmlspecialchars($user['telefone']); ?></p>
                    <button onclick="toggleModal('perfil-modal')" class="bg-blue-500 text-white px-4 py-2 rounded mt-4 w-full">Fechar</button>
                </div>
            </div>

            <!-- Lista de Imóveis Registrados -->
            <section id="imoveis" class="mb-8">
                <h3 class="text-xl font-semibold mb-4">Meus Imóveis</h3>
                <div id="imoveis-list" class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <?php foreach ($imoveis as $imovel): ?>
                        <div class="bg-white p-6 shadow-md rounded-lg">
                            <img src="<?= htmlspecialchars($imovel['foto_url']); ?>" alt="Foto do Imóvel" class="w-full h-48 object-cover rounded-lg mb-4">
                            <h3 class="text-xl font-semibold"><?= htmlspecialchars($imovel['descricao']); ?></h3>
                            <p class="text-gray-600"><?= htmlspecialchars($imovel['descricao']); ?></p>
                            <p class="text-gray-800 font-semibold mt-2">Valor: R$ <?= number_format($imovel['valor'], 2, ',', '.'); ?></p>
                            <a href="imovel_detalhes.php?id=<?= $imovel['id']; ?>" class="text-blue-500 mt-2">Ver Detalhes</a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
        </main>
    </div>

    <script>
        function toggleModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.classList.toggle('hidden');
        }
    </script>
</body>
</html>
