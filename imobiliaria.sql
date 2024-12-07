-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 07/12/2024 às 19:48
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

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
  `titulo` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `valor` decimal(10,2) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `imoveis`
--

INSERT INTO `imoveis` (`id`, `foto_url`, `titulo`, `descricao`, `valor`, `usuario_id`) VALUES
(37, NULL, NULL, NULL, NULL, 2),
(38, NULL, NULL, NULL, NULL, 2);

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
(10, 'https://resizedimgs.zapimoveis.com.br/crop/614x297/vr.images.sp/82e7b4b0b151f2061aa9db1f5f79d5ab.webp', 'Apartamento 3/4 C/ varanda', 'Apartamento 3/4 com varanda, lorem, l lorem, lorem, lorem, lorem, lorem, lorem, lorem, lorem, lorem, lorem, lorem, lorem, lorem, lorem, lorem, lorem, lorem, lorem, lorem,lorem, lorem, lorem,orem, lorem, lorem,', 2000.00, 'FSA, BA'),
(20, 'https://resizedimgs.zapimoveis.com.br/crop/614x297/vr.images.sp/82e7b4b0b151f2061aa9db1f5f79d5ab.webp', 'Apartamento 3/4 C/ varanda', 'Apartamento 3/4 com varanda, lorem, l lorem, lorem, lorem, lorem, lorem, lorem, lorem, lorem, lorem, lorem, lorem, lorem, lorem, lorem, lorem, lorem, lorem, lorem, lorem,lorem, lorem, lorem,orem, lorem, lorem,', 2000.00, 'FSA, BA'),
(30, 'https://resizedimgs.zapimoveis.com.br/crop/614x297/vr.images.sp/82e7b4b0b151f2061aa9db1f5f79d5ab.webp', 'Apartamento 3/4 C/ varanda', 'Apartamento 3/4 com varanda, lorem, l lorem, lorem, lorem, lorem, lorem, lorem, lorem, lorem, lorem, lorem, lorem, lorem, lorem, lorem, lorem, lorem, lorem, lorem, lorem,lorem, lorem, lorem,orem, lorem, lorem,', 2000.00, 'FSA, BA');

-- --------------------------------------------------------

--
-- Estrutura para tabela `mensagens`
--

CREATE TABLE `mensagens` (
  `id` int(11) NOT NULL,
  `remetente_id` int(11) NOT NULL,
  `destinatario_id` int(11) NOT NULL,
  `mensagem` text NOT NULL,
  `data_envio` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `mensagens`
--

INSERT INTO `mensagens` (`id`, `remetente_id`, `destinatario_id`, `mensagem`, `data_envio`) VALUES
(1, 3, 2, 'Olá!', '2024-11-07 17:24:24'),
(2, 2, 2, 'Olá!\n', '2024-11-07 17:24:36'),
(3, 2, 3, 'Olá!', '2024-11-07 17:24:48'),
(4, 2, 3, 'O que deseja?', '2024-11-07 17:24:56'),
(5, 3, 2, 'Gostaria de alugar esse imóvel!\n', '2024-11-07 17:25:06'),
(6, 3, 2, 'Qual data?', '2024-11-07 17:25:21'),
(7, 2, 3, 'Oi', '2024-11-07 17:30:42');

-- --------------------------------------------------------

--
-- Estrutura para tabela `notificacoes`
--

CREATE TABLE `notificacoes` (
  `id` int(11) NOT NULL,
  `corretor_id` int(11) NOT NULL,
  `imovel_id` int(11) NOT NULL,
  `mensagem` text NOT NULL,
  `lida` tinyint(1) DEFAULT 0,
  `data_criacao` timestamp NOT NULL DEFAULT current_timestamp()
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
(1, 'João Silva', 'joao@example.com', 'senha123', '2024-11-07 15:54:17', '123.456.789-00', '1990-01-01', '12345', NULL, '(11) 91234-5678'),
(2, 'Matheus Silva Rodrigues', 'matheus@matheus.com', '$2y$10$5uv6eaXwXQ8TVPoDZSw90u013/L/aZT69kBo5pyB8ETSZVZATY30u', '2024-11-07 15:55:15', NULL, NULL, NULL, NULL, NULL),
(3, 'João da Silva', 'joao@silva.com', '$2y$10$K65Zhzr80Eqlr5R6DUL8B.y4Ibj1RV00CoihDgDOt8UGCldSdj0GS', '2024-11-07 17:08:23', NULL, NULL, NULL, NULL, NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `imoveis`
--
ALTER TABLE `imoveis`
  ADD PRIMARY KEY (`id`);

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
  ADD KEY `remetente_id` (`remetente_id`),
  ADD KEY `destinatario_id` (`destinatario_id`);

--
-- Índices de tabela `notificacoes`
--
ALTER TABLE `notificacoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `corretor_id` (`corretor_id`),
  ADD KEY `imovel_id` (`imovel_id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `imoveis`
--
ALTER TABLE `imoveis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de tabela `imoveis1`
--
ALTER TABLE `imoveis1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de tabela `mensagens`
--
ALTER TABLE `mensagens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `notificacoes`
--
ALTER TABLE `notificacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `mensagens`
--
ALTER TABLE `mensagens`
  ADD CONSTRAINT `mensagens_ibfk_1` FOREIGN KEY (`remetente_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `mensagens_ibfk_2` FOREIGN KEY (`destinatario_id`) REFERENCES `usuarios` (`id`);

--
-- Restrições para tabelas `notificacoes`
--
ALTER TABLE `notificacoes`
  ADD CONSTRAINT `notificacoes_ibfk_1` FOREIGN KEY (`corretor_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `notificacoes_ibfk_2` FOREIGN KEY (`imovel_id`) REFERENCES `imoveis` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
