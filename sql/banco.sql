--Informações para criação do banco de dados e tabelas a serem utilizadas no projeto.


-- CRIAÇÃO DO BANCO DE DADOS NO MYSQL
CREATE DATABASE crudpdo
DEFAULT CHARACTER SET utf8 
DEFAULT COLLATE utf8_general_ci;


-- CHAMANDO O BANCO DE DADOS CRIADO 'CRUDPDO'
USE CRUDPDO;

-- CRIANDO A TABELA NO BANCO DE DADOS 'CRUDPDO' CHAMADA 'PESSOA'
CREATE TABLE pessoa (
    id INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(120) NOT NULL, 
    telefone VARCHAR(20), 
    email VARCHAR (80),
    PRIMARY KEY (id)
) DEFAULT charset = utf8;