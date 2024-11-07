<?php
session_start();
require 'config.php';

// Verificar se o ID do imóvel foi passado na URL
$imovel_id = $_GET['id'] ?? null;
if (!$imovel_id) {
    echo "Imóvel não encontrado!";
    exit();
}

// Obter os detalhes do imóvel
$query = $pdo->prepare("SELECT * FROM imoveis WHERE id = :id");
$query->bindParam(':id', $imovel_id);
$query->execute();
$imovel = $query->fetch();

if (!$imovel) {
    echo "Imóvel não encontrado!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Imóvel</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.1.2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800 font-sans">
    <div class="container mx-auto p-8">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <img src="<?= htmlspecialchars($imovel['foto_url']); ?>" alt="Foto do Imóvel" class="w-full h-64 object-cover rounded-lg mb-4">
            <h1 class="text-2xl font-bold mb-4"><?= htmlspecialchars($imovel['descricao']); ?></h1>
            <p class="text-gray-600 mb-4">Descrição: <?= htmlspecialchars($imovel['descricao']); ?></p>
            <p class="text-gray-800 font-semibold">Valor: R$ <?= number_format($imovel['valor'], 2, ',', '.'); ?></p>
        </div>
    </div>
</body>
</html>
