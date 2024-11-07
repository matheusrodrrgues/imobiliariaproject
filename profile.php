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

// Coletar valores para o gráfico
$valores_imoveis = [];
foreach ($imoveis as $imovel) {
    $valores_imoveis[] = $imovel['valor'];
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imobiliária Barreto | Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.1.2/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                    <li class="mb-2"><a href="#charts" class="block py-2 px-4 rounded hover:bg-gray-700">Análises de Imóveis</a></li>
                    <li class="mb-2"><a href="javascript:void(0);" onclick="toggleModal('cadastro-modal')" class="block py-2 px-4 rounded hover:bg-gray-700">Cadastrar Imóvel</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Área Principal -->
        <main class="flex-grow p-8">
            <!-- Cabeçalho -->
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-bold">Painel de Controle</h1>
            </div>

            <!-- Modal de Cadastro de Imóvel -->
            <div id="cadastro-modal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center z-50">
                <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
                    <h2 class="text-2xl font-bold mb-4">Cadastrar Imóvel</h2>
                    <form method="POST" action="">
                        <div class="mb-4">
                            <label for="foto" class="block text-gray-700">Foto do Imóvel (URL)</label>
                            <input type="text" name="foto" id="foto" class="w-full px-4 py-2 border border-gray-300 rounded" placeholder="URL da foto do imóvel" required>
                        </div>
                        <div class="mb-4">
                            <label for="descricao" class="block text-gray-700">Descrição</label>
                            <textarea name="descricao" id="descricao" class="w-full px-4 py-2 border border-gray-300 rounded" placeholder="Descrição do imóvel" required></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="valor" class="block text-gray-700">Valor</label>
                            <input type="number" name="valor" id="valor" class="w-full px-4 py-2 border border-gray-300 rounded" placeholder="Valor do imóvel" required>
                        </div>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded w-full">Cadastrar</button>
                        <button type="button" onclick="toggleModal('cadastro-modal')" class="bg-red-500 text-white px-4 py-2 rounded w-full mt-4">Fechar</button>
                    </form>
                </div>
            </div>

            <!-- Modal de Visualizar Perfil -->
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

            <!-- Seção de Imóveis Registrados -->
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

            <!-- Gráfico -->
            <section id="charts" class="mb-8">
                <h3 class="text-xl font-semibold mb-4">Análises de Imóveis</h3>
                <div class="bg-white shadow-md rounded-lg p-4 mb-6">
                    <canvas id="myChart" width="400" height="200"></canvas>
                </div>
                <script>
                    var ctx = document.getElementById('myChart').getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: <?php echo json_encode(array_keys($valores_imoveis)); ?>,
                            datasets: [{
                                label: 'Valor dos Imóveis',
                                data: <?php echo json_encode($valores_imoveis); ?>,
                                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                </script>
            </section>

            <!-- Tabela de Dados -->
            <section id="data-table" class="mb-8">
                <h3 class="text-xl font-semibold mb-4">Tabela de Dados</h3>
                <div class="bg-white shadow-md rounded-lg p-4">
                    <table class="min-w-full table-auto">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 text-left">Imóvel</th>
                                <th class="px-4 py-2 text-left">Descrição</th>
                                <th class="px-4 py-2 text-left">Valor</th>
                                <th class="px-4 py-2 text-left">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($imoveis as $imovel): ?>
                                <tr>
                                    <td class="px-4 py-2"><?= htmlspecialchars($imovel['descricao']); ?></td>
                                    <td class="px-4 py-2"><?= htmlspecialchars($imovel['descricao']); ?></td>
                                    <td class="px-4 py-2">R$ <?= number_format($imovel['valor'], 2, ',', '.'); ?></td>
                                    <td class="px-4 py-2">
                                        <a href="imovel_detalhes.php?id=<?= $imovel['id']; ?>" class="text-blue-500">Ver Detalhes</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>

    <script>
        // Função para abrir/fechar o modal
        function toggleModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.classList.toggle('hidden');
        }
    </script>
</body>
</html>
