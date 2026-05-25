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

-- VIEWS

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

--
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
) AS total

FROM aluguel

INNER JOIN cliente
ON aluguel.id_cliente = cliente.id

INNER JOIN veiculo
ON aluguel.id_veiculo = veiculo.id;

-- FUNCTIONS

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

--

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

-- STORED PROCEDURE

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