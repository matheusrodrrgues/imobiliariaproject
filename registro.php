<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuário</title>
    <!-- Estilo Básico -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.1.2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="container mx-auto mt-10">
        <h2 class="text-3xl font-bold mb-6 text-center">Registrar-se</h2>
        <div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-lg">
            <!-- Formulário de Registro -->
            <form action="registro.php" method="POST">
                <div class="mb-4">
                    <label for="nome" class="block text-gray-700 font-semibold mb-2">Nome Completo</label>
                    <input type="text" id="nome" name="nome" required class="w-full p-2 border rounded-lg">
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
                    <input type="email" id="email" name="email" required class="w-full p-2 border rounded-lg">
                </div>
                <div class="mb-4">
                    <label for="senha" class="block text-gray-700 font-semibold mb-2">Senha</label>
                    <input type="password" id="senha" name="senha" required class="w-full p-2 border rounded-lg">
                </div>
                <button type="submit" name="registrar" class="bg-blue-500 text-white px-4 py-2 rounded-lg font-semibold">Registrar</button>
            </form>
        </div>
    </div>

    <?php
    // Processar o formulário ao enviar
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Obter dados do formulário
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Hash da senha para segurança

        // Conectar ao banco de dados
        $host = 'localhost';
        $db = 'imobiliaria';  // Nome do banco de dados criado
        $user = 'root';
        $pass = 'admin';
        
        try {
            $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Inserir o usuário no banco de dados
            $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)");
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':senha', $senha);
            $stmt->execute();

            echo "<p class='text-center text-green-500 mt-4'>Registro realizado com sucesso!</p>";
        } catch (PDOException $e) {
            echo "<p class='text-center text-red-500 mt-4'>Erro ao registrar: " . $e->getMessage() . "</p>";
        }
    }
    ?>
</body>
</html>
