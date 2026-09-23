CREATE DATABASE sistema_teste;

USE sistema_teste;

CREATE TABLE produtos(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50),
    preco DECIMAL(10, 2)
);