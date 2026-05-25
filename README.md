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

---

# Como abrir

1. Coloque a pasta locadora_veiculos em htdocs
2. Inicie Apache e MySQL no XAMPP
3. Importe o arquivo vn_locacoes.sql no phpMyAdmin
4. Acesse:
http://localhost/locadora_veiculos

---

# Autoras

Projeto desenvolvido para fins acadêmicos por Jamily Monteiro de Lima e Vitória Nayara da Silva Batista.
