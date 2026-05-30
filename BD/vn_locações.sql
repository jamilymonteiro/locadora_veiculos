-- ------ CRIAÇÃO DO BANCO --------

CREATE DATABASE vn_locacoes;
USE vn_locacoes;

CREATE TABLE cliente (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    cpf VARCHAR(14) NOT NULL UNIQUE,
    telefone VARCHAR(20),
    email VARCHAR(255)
);

CREATE TABLE marca (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE categoria (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao VARCHAR(255)
);

CREATE TABLE veiculo (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    modelo VARCHAR(100) NOT NULL,
    ano_fabricacao INT NOT NULL,
    placa VARCHAR(10) NOT NULL UNIQUE,
    status BOOLEAN NOT NULL,
    valor_diaria DECIMAL(10,2) NOT NULL,

    id_marca BIGINT NOT NULL,
    id_categoria BIGINT NOT NULL,

    CONSTRAINT fk_veiculo_marca
        FOREIGN KEY (id_marca)
        REFERENCES marca(id),

    CONSTRAINT fk_veiculo_categoria
        FOREIGN KEY (id_categoria)
        REFERENCES categoria(id)
);

CREATE TABLE pagamento (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    valor DECIMAL(10,2) NOT NULL,
    data DATE NOT NULL,
    pagamento_tipo VARCHAR(50) NOT NULL
);

CREATE TABLE aluguel (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    data_inicio DATE NOT NULL,
    data_fim DATE NOT NULL,
    status VARCHAR(30) NOT NULL,

    id_pagamento BIGINT NOT NULL UNIQUE,
    id_cliente BIGINT NOT NULL,
    id_veiculo BIGINT NOT NULL,

    CONSTRAINT fk_aluguel_pagamento
        FOREIGN KEY (id_pagamento)
        REFERENCES pagamento(id),

    CONSTRAINT fk_aluguel_cliente
        FOREIGN KEY (id_cliente)
        REFERENCES cliente(id),

    CONSTRAINT fk_aluguel_veiculo
        FOREIGN KEY (id_veiculo)
        REFERENCES veiculo(id),

    CONSTRAINT chk_datas
        CHECK(data_fim >= data_inicio)
);

CREATE TABLE contrato (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    data_emissao DATE NOT NULL,
    termos TEXT,
    id_aluguel BIGINT NOT NULL UNIQUE,
    CONSTRAINT fk_contrato_aluguel
        FOREIGN KEY (id_aluguel)
        REFERENCES aluguel(id)
);

INSERT INTO cliente (nome, cpf, telefone, email)
VALUES (
    'João Silva',
    '123.456.789-00',
    '(87)99999-1111',
    'joao@gmail.com'
);

INSERT INTO marca (nome)
VALUES ('Toyota');

INSERT INTO categoria (nome, descricao)
VALUES (
    'SUV',
    'Veículos utilitários esportivos'
);

INSERT INTO veiculo (
    modelo,
    ano_fabricacao,
    placa,
    status,
    valor_diaria,
    id_marca,
    id_categoria
)
VALUES (
    'Corolla Cross',
    2023,
    'ABC1D23',
    true,
    250.00,
    1,
    1
);

INSERT INTO pagamento (
    valor,
    data,
    pagamento_tipo
)
VALUES (
    750.00,
    '2026-05-13',
    'PIX'
);

INSERT INTO aluguel (
    data_inicio,
    data_fim,
    status,
    id_pagamento,
    id_cliente,
    id_veiculo
)
VALUES (
    '2026-05-13',
    '2026-05-16',
    'ATIVO',
    1,
    1,
    1
);

INSERT INTO contrato (
    data_emissao,
    termos,
    id_aluguel
)
VALUES (
    '2026-05-13',
    'Contrato de locação válido por 3 dias.',
    1
);

-- ------ FUNCTIONS -----

DELIMITER $$

CREATE FUNCTION fn_calcular_total_aluguel(
    data_inicio DATE,
    data_fim DATE,
    valor_diaria DECIMAL(10,2)
)

RETURNS DECIMAL(10,2)

DETERMINISTIC
BEGIN
    DECLARE dias INT;
    SET dias = DATEDIFF(data_fim, data_inicio);
    RETURN dias * valor_diaria;
END $$

DELIMITER ;

-- --

DELIMITER $$

CREATE FUNCTION fn_quantidade_dias(
data_inicio DATE,
data_fim DATE
)

RETURNS INT

DETERMINISTIC

BEGIN

RETURN DATEDIFF(data_fim, data_inicio);

END $$

DELIMITER ;

-- --

DELIMITER $$

CREATE FUNCTION fn_calcular_multa(
data_fim DATE)

RETURNS DECIMAL(10,2)
DETERMINISTIC

BEGIN

DECLARE dias_atraso INT;
DECLARE multa DECIMAL(10,2);
SET dias_atraso = DATEDIFF(CURDATE(), data_fim);

IF dias_atraso > 0 THEN
SET multa = dias_atraso * 50;

ELSE
SET multa = 0;
END IF;

RETURN multa;

END $$
DELIMITER ;

-- ----- STORED PROCEDURES -----

DELIMITER $$

CREATE PROCEDURE sp_encerrar_aluguel(
    IN aluguelId BIGINT,
    IN veiculoId BIGINT
)
BEGIN
    UPDATE aluguel
    SET status = 'INATIVO'
    WHERE id = aluguelId;

    UPDATE veiculo
    SET status = 1
    WHERE id = veiculoId;
END $$

DELIMITER ;

-- --

DELIMITER $$

CREATE PROCEDURE sp_realizar_aluguel(

IN p_data_inicio DATE,
IN p_data_fim DATE,
IN p_id_cliente INT,
IN p_id_veiculo INT,
IN p_pagamento_tipo VARCHAR(30))

BEGIN

DECLARE v_status BOOLEAN;
DECLARE v_valor DECIMAL(10,2);
DECLARE v_id_pagamento INT;
DECLARE v_id_aluguel INT;
DECLARE v_dias INT;
DECLARE v_cliente_existe INT;
DECLARE v_veiculo_existe INT;

SELECT COUNT(*)
INTO v_cliente_existe
FROM cliente
WHERE id = p_id_cliente;
IF v_cliente_existe = 0 THEN
SIGNAL SQLSTATE '45000'
SET MESSAGE_TEXT = 'Cliente não encontrado';
END IF;

SELECT COUNT(*)
INTO v_veiculo_existe
FROM veiculo
WHERE id = p_id_veiculo;
IF v_veiculo_existe = 0 THEN
SIGNAL SQLSTATE '45000'
SET MESSAGE_TEXT = 'Veículo não encontrado';
END IF;

SELECT status
INTO v_status
FROM veiculo
WHERE id = p_id_veiculo;
IF v_status = 0 THEN
SIGNAL SQLSTATE '45000'
SET MESSAGE_TEXT = 'Veículo indisponível para aluguel';
END IF;

SELECT valor_diaria
INTO v_valor
FROM veiculo
WHERE id = p_id_veiculo;

INSERT INTO pagamento(
valor,
data,
pagamento_tipo)

VALUES(
v_valor,
CURDATE(),
p_pagamento_tipo);

SET v_id_pagamento = LAST_INSERT_ID();

INSERT INTO aluguel(
data_inicio,
data_fim,
status,
id_pagamento,
id_cliente,
id_veiculo)

VALUES(
p_data_inicio,
p_data_fim,
'ATIVO',
v_id_pagamento,
p_id_cliente,
p_id_veiculo);
SET v_id_aluguel = LAST_INSERT_ID();


SET v_dias =
fn_quantidade_dias(
p_data_inicio,
p_data_fim);

INSERT INTO contrato(
data_emissao,
termos,
id_aluguel)

VALUES(
CURDATE(),
CONCAT('Contrato válido por ', v_dias, ' dias.'),
v_id_aluguel);

UPDATE veiculo
SET status = 0
WHERE id = p_id_veiculo;

END $$
DELIMITER ;

-- --

DELIMITER $$

CREATE PROCEDURE sp_cadastrar_veiculo(

IN p_modelo VARCHAR(100),
IN p_ano INT,
IN p_placa VARCHAR(20),
IN p_valor DECIMAL(10,2),

IN p_id_marca INT,
IN p_id_categoria INT)

BEGIN

INSERT INTO veiculo(
modelo,
ano_fabricacao,
placa,
valor_diaria,
status,
id_marca,
id_categoria)

VALUES(
p_modelo,
p_ano,
p_placa,
p_valor,
1,
p_id_marca,
p_id_categoria);

END $$
DELIMITER ;

-- --

DELIMITER $$

CREATE PROCEDURE sp_cadastrar_cliente(

IN p_nome VARCHAR(100),
IN p_cpf VARCHAR(20),
IN p_telefone VARCHAR(20),
IN p_email VARCHAR(100))

BEGIN
DECLARE v_cpf_existe INT;
SELECT COUNT(*)
INTO v_cpf_existe
FROM cliente
WHERE cpf = p_cpf;

IF v_cpf_existe > 0 THEN
SIGNAL SQLSTATE '45000'
SET MESSAGE_TEXT = 'CPF já cadastrado';
END IF;

INSERT INTO cliente(
nome,
cpf,
telefone,
email)

VALUES(
p_nome,
p_cpf,
p_telefone,
p_email);

END $$
DELIMITER ;

-- ------ VIEWS ------

CREATE VIEW vw_veiculos_disponiveis AS

SELECT
veiculo.id,
veiculo.modelo,
veiculo.ano_fabricacao,
veiculo.placa,
veiculo.valor_diaria,
marca.nome AS marca,
categoria.nome AS categoria
FROM veiculo

INNER JOIN marca
ON veiculo.id_marca = marca.id

INNER JOIN categoria
ON veiculo.id_categoria = categoria.id

WHERE veiculo.status = 1;

-- --

CREATE VIEW vw_listaralugueis AS

SELECT
aluguel.id,
aluguel.data_inicio,
aluguel.data_fim,
aluguel.status,
aluguel.id_veiculo,
cliente.nome AS cliente,
veiculo.modelo AS veiculo,
veiculo.valor_diaria,

fn_quantidade_dias(
aluguel.data_inicio,
aluguel.data_fim
) AS dias,

fn_calcular_total_aluguel(
aluguel.data_inicio,
aluguel.data_fim,
veiculo.valor_diaria
) AS total,

fn_calcular_multa(
aluguel.data_fim
) AS multa

FROM aluguel

INNER JOIN cliente
ON aluguel.id_cliente = cliente.id

INNER JOIN veiculo
ON aluguel.id_veiculo = veiculo.id;