CREATE DATABASE imobiliaria;

USE imobiliaria;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL
);

CREATE TABLE imoveis (
    id INT AUTO_INCREMENT PRIMARY KEY,
    foto_url VARCHAR(255),
    descricao TEXT,
    valor DECIMAL(10, 2),
    usuario_id INT,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);
