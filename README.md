# Locadora de Veículos

Sistema web de gerenciamento de locadora de veículos desenvolvido em PHP e MySQL. O projeto permite o controle de clientes, veículos, aluguéis, contratos, pagamentos e usuários administradores.

---

# Funcionalidades

## Área pública

* Visualização de veículos disponíveis
* Consulta de aluguéis por CPF
* Consulta de contratos por CPF

## Área administrativa

* Login de administrador
* Cadastro de clientes
* Cadastro de veículos
* Cadastro de marcas
* Cadastro de categorias
* Cadastro de pagamentos
* Cadastro de contratos
* Gerenciamento de aluguéis
* Exclusão e edição de registros

---

# Tecnologias utilizadas

* PHP
* MySQL
* HTML5
* CSS3
* Bootstrap
* XAMPP
* VS Code

---

# Banco de Dados

O sistema utiliza o banco de dados MySQL com as seguintes entidades:

* Cliente
* Veículo
* Marca
* Categoria
* Aluguel
* Contrato
* Pagamento
* Usuário

---

# Regras de Negócio

* Um veículo não pode ser alugado se estiver indisponível.
* Ao realizar um aluguel:
  * o veículo fica indisponível.
* Ao encerrar um aluguel:
  * o veículo volta a ficar disponível.
* Cada contrato pertence a apenas um aluguel.
* Cada aluguel possui um pagamento associado.

---

# Procedures, Functions e Views

O projeto utiliza recursos avançados do banco de dados:

## Procedures

* Cadastro de aluguel
* Encerramento de aluguel

## Functions

* Cálculo do valor total do aluguel

## Views

* View de aluguéis ativos
* View de veículos disponíveis

---

# Autoras

Projeto desenvolvido para fins acadêmicos por Jamily Monteiro de Lima e Vitória Nayara da Silva Batista.
