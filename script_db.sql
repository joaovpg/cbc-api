CREATE DATABASE IF NOT EXISTS db_api_cbc;

USE db_api_cbc;

CREATE TABLE IF NOT EXISTS clube (
    id INT AUTO_INCREMENT,
    clube VARCHAR(80),
    saldo_disponivel DECIMAL(10, 2),
    PRIMARY KEY (id)
    );

CREATE TABLE IF NOT EXISTS recurso (
    id INT AUTO_INCREMENT,
    recurso VARCHAR(100),
    saldo_disponivel DECIMAL(10, 2),
    PRIMARY KEY (id)
    );

INSERT INTO recurso (recurso, saldo_disponivel)
       VALUES
             ('Recurso para passagens', 10000.00),
             ('Recurso para hospedagens', 10000.00);