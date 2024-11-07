-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 07/11/2024 às 16:38
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `imobiliaria`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `imoveis`
--

CREATE TABLE `imoveis` (
  `id` int(11) NOT NULL,
  `foto_url` varchar(255) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `valor` decimal(10,2) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `imoveis`
--

INSERT INTO `imoveis` (`id`, `foto_url`, `descricao`, `valor`, `usuario_id`) VALUES
(1, 'https://www.chavesnamao.com.br/imn/0000x0000/N/imoveis/412400/17583820/sc-blumenau-velha-rua-artur-poli-casa-em-condominio-fechado-a-venda-4-quartos-65418cd1-9.jpg', 'Lorem inpsu, Lorem inpsu, Lorem inpsu, Lorem inpsu, Lorem inpsu, Lorem inpsu, Lorem inpsu, Lorem inpsu, Lorem inpsu, Lorem inpsu, Lorem inpsu, Lorem inpsu, Lorem inpsu, Lorem inpsu, Lorem inpsu, Lorem inpsu, Lorem inpsu, Lorem inpsu, Lorem inpsu, Lorem inpsu, Lorem inpsu, Lorem inpsu, Lorem inpsu, Lorem inpsu, Lorem inpsu, ', 10000.00, 6),
(2, 'https://www.chavesnamao.com.br/imn/0000x0000/N/imoveis/412400/17583820/sc-blumenau-velha-rua-artur-poli-casa-em-condominio-fechado-a-venda-4-quartos-65418cd1-9.jpg', 'Lorem inpsu, Lorem inpsu, Lorem inpsu, Lorem inpsu, Lorem inpsu, Lorem inpsu, Lorem inpsu, Lorem inpsu, Lorem inpsu, Lorem inpsu, Lorem inpsu, Lorem inpsu, Lorem inpsu, Lorem inpsu, Lorem inpsu, Lorem inpsu, Lorem inpsu, Lorem inpsu, Lorem inpsu, Lorem inpsu, Lorem inpsu, Lorem inpsu, Lorem inpsu, Lorem inpsu, Lorem inpsu, Lorem inpsu, Lorem inpsu, Lorem inpsu, Lorem inpsu, Lorem inpsu, Lorem inpsu, Lorem inpsu, Lorem inpsu, ', 1000.00, 6),
(8, 'https://resizedimgs.zapimoveis.com.br/crop/614x297/vr.images.sp/82e7b4b0b151f2061aa9db1f5f79d5ab.webp', 'Atualizando', 12.00, 5),
(9, 'https://resizedimgs.zapimoveis.com.br/crop/614x297/vr.images.sp/82e7b4b0b151f2061aa9db1f5f79d5ab.webp', 'Atualizando', 12.00, 5),
(10, 'https://resizedimgs.zapimoveis.com.br/crop/614x297/vr.images.sp/82e7b4b0b151f2061aa9db1f5f79d5ab.webp', 'Atualizando', 12.00, 5),
(11, 'https://resizedimgs.zapimoveis.com.br/crop/614x297/vr.images.sp/82e7b4b0b151f2061aa9db1f5f79d5ab.webp', '342', 2000.00, 6);

-- --------------------------------------------------------

--
-- Estrutura para tabela `imoveis1`
--

CREATE TABLE `imoveis1` (
  `id` int(11) NOT NULL,
  `imagem` varchar(255) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descricao` text NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `localidade` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `imoveis1`
--

INSERT INTO `imoveis1` (`id`, `imagem`, `titulo`, `descricao`, `valor`, `localidade`) VALUES
(1, 'https://resizedimgs.zapimoveis.com.br/crop/614x297/vr.images.sp/82e7b4b0b151f2061aa9db1f5f79d5ab.webp', 'Apartamento 3/4 C/ varanda', 'Apartamento 3/4 com varanda, lorem, l lorem, lorem, lorem, lorem, lorem, lorem, lorem, lorem, lorem, lorem, lorem, lorem, lorem, lorem, lorem, lorem, lorem, lorem, lorem,lorem, lorem, lorem,orem, lorem, lorem,', 2000.00, 'FSA, BA'),
(2, 'https://resizedimgs.zapimoveis.com.br/crop/614x297/vr.images.sp/82e7b4b0b151f2061aa9db1f5f79d5ab.webp', 'Apartamento 3/4 C/ varanda', 'Apartamento 3/4 com varanda, lorem, l lorem, lorem, lorem, lorem, lorem, lorem, lorem, lorem, lorem, lorem, lorem, lorem, lorem, lorem, lorem, lorem, lorem, lorem, lorem,lorem, lorem, lorem,orem, lorem, lorem,', 2000.00, 'FSA, BA'),
(3, 'https://resizedimgs.zapimoveis.com.br/crop/614x297/vr.images.sp/82e7b4b0b151f2061aa9db1f5f79d5ab.webp', 'Apartamento 3/4 C/ varanda', 'Apartamento 3/4 com varanda, lorem, l lorem, lorem, lorem, lorem, lorem, lorem, lorem, lorem, lorem, lorem, lorem, lorem, lorem, lorem, lorem, lorem, lorem, lorem, lorem,lorem, lorem, lorem,orem, lorem, lorem,', 2000.00, 'FSA, BA');

-- --------------------------------------------------------

--
-- Estrutura para tabela `mensagens`
--

CREATE TABLE `mensagens` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mensagem` text DEFAULT NULL,
  `imovel_id` int(11) DEFAULT NULL,
  `data_envio` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `data_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `cpf` varchar(14) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `certificacao_imobiliario` varchar(50) DEFAULT NULL,
  `redes_sociais` text DEFAULT NULL,
  `telefone` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `data_registro`, `cpf`, `data_nascimento`, `certificacao_imobiliario`, `redes_sociais`, `telefone`) VALUES
(1, 'Carlos Silva', 'carlos.silva@example.com', '$2y$10$e1n5/F7d9uUtnm4Q.WQF5.X7f8z08s9JTi8OewfZPt9Xb7ZaO1Ena', '2024-11-06 21:53:17', NULL, NULL, NULL, NULL, NULL),
(2, 'Mariana Costa', 'mariana.costa@example.com', '$2y$10$G9QJ24yR97my/zi8XbD4ge7JrFEXmRjROEP5b8yk35dA2byfUqZDS', '2024-11-06 21:53:17', NULL, NULL, NULL, NULL, NULL),
(3, 'João Pedro', 'joao.pedro@example.com', '$2y$10$95g10Tm/TUlf8O0nX1Uz.e5bfg9mYgJ5RVJdEmJSsHEwP9oVeOvli', '2024-11-06 21:53:17', NULL, NULL, NULL, NULL, NULL),
(4, 'Matheus Rodrigues', 'matheus@matheus.com', '123456', '2024-11-06 21:53:17', NULL, NULL, NULL, NULL, NULL),
(5, 'Admin ', 'admin@adminteste.com', '$2y$10$r2mUajU0tkNX57YsR5Pi5OrB2Dp5WwwWWqYj6EGA7JZZjpZUqo.Mm', '2024-11-06 21:55:03', '087.784.975-74', '2001-01-20', '4884959-02', 'fb.com/matheus', '75991303289'),
(6, 'Matheus Silva', 'matheusilva@gmail.com', '$2y$10$KTd/GJFF78kM1MNwvGuwUetpe7lXtAz5kcVc/EAzB7YEGJDjsFn3e', '2024-11-07 01:18:20', NULL, NULL, NULL, NULL, NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `imoveis`
--
ALTER TABLE `imoveis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices de tabela `imoveis1`
--
ALTER TABLE `imoveis1`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `mensagens`
--
ALTER TABLE `mensagens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `imovel_id` (`imovel_id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `imoveis`
--
ALTER TABLE `imoveis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `imoveis1`
--
ALTER TABLE `imoveis1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `mensagens`
--
ALTER TABLE `mensagens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `imoveis`
--
ALTER TABLE `imoveis`
  ADD CONSTRAINT `imoveis_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Restrições para tabelas `mensagens`
--
ALTER TABLE `mensagens`
  ADD CONSTRAINT `mensagens_ibfk_1` FOREIGN KEY (`imovel_id`) REFERENCES `imoveis` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
