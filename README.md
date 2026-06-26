# LG Electronics - Dashboard de Eficiência da Produção

## Objetivo

Este projeto foi desenvolvido como resposta ao desafio técnico proposto pela LG Electronics.

A aplicação apresenta um Dashboard para acompanhamento da eficiência de produção da Planta A durante o mês de janeiro de 2026, permitindo visualizar todas as linhas de produção ou filtrar uma linha específica.

---

## Tecnologias Utilizadas

* PHP 7.4
* Laravel 7
* MySQL 8
* Blade
* Bootstrap 5
* JavaScript (Vanilla JS)
* Docker
* Nginx
* phpMyAdmin

---

## Linhas de Produção

* Geladeira
* Máquina de Lavar
* TV
* Ar-Condicionado

---

## Funcionalidades

* Dashboard de produção
* Filtro por linha de produção
* Total de peças produzidas
* Total de defeitos
* Eficiência média
* Paginação dos registros
* Dados simulados através de Seeder

---

## Estrutura da Tabela

Tabela:

```sql
productions
```

| Campo             | Tipo             |
| ----------------- | ---------------- |
| id                | bigint           |
| production_date   | date             |
| product_line      | varchar(50)      |
| produced_quantity | integer unsigned |
| defect_quantity   | integer unsigned |
| created_at        | timestamp        |
| updated_at        | timestamp        |

---

## Exemplo de INSERT

```sql
INSERT INTO productions
(
    production_date,
    product_line,
    produced_quantity,
    defect_quantity
)
VALUES
(
    '2026-01-01',
    'Geladeira',
    1053,
    9
);
```

---

## Eficiência

A eficiência é calculada dinamicamente pela aplicação.

```
((Produzidas - Defeitos) / Produzidas) * 100
```

A decisão de calcular em tempo de execução evita inconsistência de dados e elimina redundância no banco.

---

## Executando o Projeto

### Subir os containers

```bash
docker compose --env-file .env.docker up -d
```

### Instalar dependências

```bash
composer install
```

### Configurar o ambiente

```bash
cp .env.example .env
php artisan key:generate
```

### Executar as migrations

```bash
php artisan migrate
```

### Popular a base

```bash
php artisan db:seed
```

---

## Acesso

Aplicação

```
http://localhost:8080
```

phpMyAdmin

```
http://localhost:8081
```

---

## Estrutura do Projeto

```
app/
database/
resources/
routes/
docker/
```

---

## Testes

```bash
vendor/bin/phpunit
```

---

## Boas práticas adotadas

* Laravel MVC
* Eloquent ORM
* Blade Template
* PSR-12
* KISS
* DRY
* Mass Assignment Protection
* Paginação
* Índices no banco de dados
* Dados simulados via Seeder

---

## Melhorias Futuras

* Dashboard com gráficos
* Exportação para Excel
* API REST
* Indicadores em tempo real
* Autenticação de usuários

---

## Autor

Eduardo Correia
