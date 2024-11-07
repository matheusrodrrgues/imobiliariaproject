<!DOCTYPE html>
<html lang="pt-br">

<?php
// Conexão com o banco de dados
$host = 'localhost';
$db = 'imobiliaria';  
$user = 'root';        
$pass = 'admin';            

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->query('SELECT * FROM imoveis1');
    $imoveis = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erro na conexão com o banco de dados: " . $e->getMessage();
    $imoveis = [];
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imobiliária Barreto | Seus imóveis em um só lugar</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f7f9fc;
            margin: 0;
            color: #4a4a4a;
        }

        /* Navbar Styling */
        .navbar {
            background-color: #5e6b7a;
        }

        .navbar-brand,
        .navbar-nav .nav-link {
            color: #fff !important;
            font-weight: 600;
        }

        .navbar-nav .nav-link:hover {
            color: #f1c40f !important;
        }

        .navbar-nav .dropdown-menu {
            background-color: #6c7a89;
            border-radius: 5px;
        }

        .navbar-nav .dropdown-menu .dropdown-item:hover {
            background-color: #f1c40f;
            color: #fff;
        }

        /* Hero Section */
        .hero {
            background: url('images/banner1.jpg') center/cover no-repeat;
            height: 500px;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: #fff;
            position: relative;
        }

        .hero h1 {
            font-size: 3.5rem;
            font-weight: 700;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        }

        .hero p {
            font-size: 1.2rem;
            margin-top: 10px;
        }

        .btn-primary {
            background-color: #f1c40f;
            border-color: #f1c40f;
            padding: 12px 25px;
            border-radius: 30px;
            font-weight: bold;
            margin-top: 20px;
            transition: all 0.3s ease-in-out;
        }

        .btn-primary:hover {
            background-color: #e67e22;
        }

        .properties {
            padding: 80px 0;
            background-color: #fff;
        }

        .property-card {
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease-in-out;
        }

        .property-card:hover {
            transform: translateY(-10px);
        }

        .property-card img {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }

        .property-card .card-body {
            padding: 20px;
        }

        .property-card .card-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: #34495e;
        }

        .property-card .price {
            font-size: 1.5rem;
            color: #f1c40f;
            font-weight: bold;
        }

        footer {
            background-color: #5e6b7a;
            color: #fff;
            padding: 40px 0;
            text-align: center;
        }

        footer a {
            color: #fff;
            text-decoration: none;
        }

        footer a:hover {
            color: #f1c40f;
        }

        /* Sobre e Contato */
        .about-contact {
            padding: 50px 0;
        }

        .about-contact .box {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }

        .about-contact .box h2 {
            font-size: 1.8rem;
            font-weight: 600;
            color: #34495e;
        }

        .about-contact .box p {
            font-size: 1.1rem;
            color: #7f8c8d;
        }

        .about-contact .box .contact-form input,
        .about-contact .box .contact-form textarea {
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            border-radius: 6px;
            border: 1px solid #ddd;
            margin-bottom: 20px;
            font-size: 1rem;
        }

        .about-contact .box .contact-form button {
            background-color: #f1c40f;
            border: none;
            color: #fff;
            padding: 12px 25px;
            font-size: 1rem;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .about-contact .box .contact-form button:hover {
            background-color: #e67e22;
        }

    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">Imobiliária Barreto</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link" href="#home">Início</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">Sobre</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Imóveis
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Casa</a>
                            <a class="dropdown-item" href="#">Apartamento</a>
                            <a class="dropdown-item" href="#">Comercial</a>
                        </div>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contato</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <section id="home" class="hero">
        <div id="heroCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="hero" style="background-image: url('https://via.placeholder.com/1920x500'); height: 500px; background-size: cover;">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <h1>Apartamento no Centro</h1>
                            <p>Lindo apartamento com 3 quartos, próximo a todas as comodidades da cidade.</p>
                            <a href="#imoveis" class="btn-primary">Veja os imóveis</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="hero" style="background-image: url('https://via.placeholder.com/1920x500'); height: 500px; background-size: cover;">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <h1>Casa com Piscina</h1>
                            <p>Ampla casa com área de lazer completa e piscina para sua família aproveitar.</p>
                            <a href="#imoveis" class="btn-primary">Veja os imóveis</a>
                        </div>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#heroCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#heroCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </section>

    <!-- Properties Section -->
    <section id="imoveis" class="properties">
        <div class="container">
            <h2 class="text-center mb-5">Imóveis Recentes</h2>
            <div class="row">
                <?php if (!empty($imoveis)): ?>
                    <?php foreach ($imoveis as $imovel): ?>
                        <div class="col-md-4 mb-4">
                            <div class="property-card">
                                <img src="<?php echo $imovel['imagem']; ?>" alt="<?php echo htmlspecialchars($imovel['titulo']); ?>" class="img-fluid">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($imovel['titulo']); ?></h5>
                                    <p class="price">R$ <?php echo number_format($imovel['valor'], 2, ',', '.'); ?></p>
                                    <p class="card-text"><?php echo htmlspecialchars(substr($imovel['descricao'], 0, 100)); ?>...</p>
                                    <a href="../imobiliaria/detalhes.php" class="btn btn-primary">Ver Mais</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12 text-center">
                        <p>Nenhum imóvel disponível no momento.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Imobiliária Barreto | <a href="#">Política de Privacidade</a> | <a href="#">Termos de Serviço</a></p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
