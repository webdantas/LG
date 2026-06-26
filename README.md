# LG Electronics - Production Efficiency Dashboard

![Laravel](https://img.shields.io/badge/Laravel-7.30-red)
![PHP](https://img.shields.io/badge/PHP-7.4-blue)
![MySQL](https://img.shields.io/badge/MySQL-8-orange)
![Docker](https://img.shields.io/badge/Docker-Ready-blue)
![License](https://img.shields.io/badge/license-MIT-green)

## Release

**Current Version:** `v1.0.1`

**Status:** `Stable`

**Release Status:** `Stable`

---

Technical Challenge developed for LG Electronics.

Production Efficiency Dashboard built with Laravel 7, PHP 7.4, MySQL 8 and Docker.

## Desafio Técnico

Este projeto foi desenvolvido como solução para o desafio técnico da LG Electronics.

A aplicação apresenta um Dashboard para acompanhamento da eficiência de produção da Planta A durante o mês de janeiro de 2026.

---

# Tecnologias

* PHP 7.4
* Laravel 7.30
* MySQL 8
* Blade
* Bootstrap 5
* JavaScript (Vanilla JS)
* Docker
* Nginx
* phpMyAdmin

---

# Arquitetura

```
Docker
    │
    ├── Nginx
    │
    ├── PHP-FPM
    │
    ├── Laravel 7 (MVC)
    │
    ├── Eloquent ORM
    │
    └── MySQL 8
```

Aplicação desenvolvida utilizando o padrão MVC nativo do Laravel.

---

# Funcionalidades

* Dashboard da produção
* Filtro por linha de produção
* Cards com indicadores
* Gráfico de produção por linha
* Tabela paginada
* Dados simulados através de Seeder

---

# Linhas de Produção

* Geladeira
* Máquina de Lavar
* TV
* Ar-Condicionado

---

# Estrutura da Tabela

Tabela:

```
productions
```

| Campo             | Tipo             |
| ----------------- | ---------------- |
| id                | bigint           |
| production_date   | date             |
| product_line      | varchar(50)      |
| produced_quantity | unsigned integer |
| defect_quantity   | unsigned integer |
| created_at        | timestamp        |
| updated_at        | timestamp        |

Índices:

* production_date
* product_line

SQL equivalente:

```sql
CREATE TABLE productions (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    production_date DATE NOT NULL,
    product_line VARCHAR(50) NOT NULL,
    produced_quantity INT UNSIGNED NOT NULL,
    defect_quantity INT UNSIGNED NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    INDEX productions_production_date_index (production_date),
    INDEX productions_product_line_index (product_line)
);
```

Exemplos de dados para simular o banco:

```sql
INSERT INTO productions
    (production_date, product_line, produced_quantity, defect_quantity, created_at, updated_at)
VALUES
    ('2026-01-01', 'Geladeira', 1053, 9, NOW(), NOW()),
    ('2026-01-01', 'Máquina de Lavar', 983, 11, NOW(), NOW()),
    ('2026-01-01', 'TV', 1123, 7, NOW(), NOW()),
    ('2026-01-01', 'Ar-Condicionado', 933, 13, NOW(), NOW()),
    ('2026-01-02', 'Geladeira', 1056, 10, NOW(), NOW()),
    ('2026-01-02', 'Máquina de Lavar', 986, 12, NOW(), NOW()),
    ('2026-01-02', 'TV', 1126, 8, NOW(), NOW()),
    ('2026-01-02', 'Ar-Condicionado', 936, 14, NOW(), NOW());
```

O projeto também possui um Seeder que gera automaticamente os 124 registros utilizados no Dashboard, cobrindo os 31 dias de janeiro de 2026 para as 4 linhas de produção.

---

# Cálculo da Eficiência

A eficiência é calculada dinamicamente pela aplicação.

```
((Produzidas - Defeitos) / Produzidas) × 100
```

O valor não é armazenado no banco de dados para evitar redundância de informações.

---

# Como executar

### 1. Clonar o projeto

```bash
git clone https://github.com/webdantas/LG.git

cd LG
```

### 2. Criar o arquivo de ambiente do Docker

```bash
cp .env.docker.example .env.docker
```

*(Caso o projeto já possua `.env.docker`, este passo pode ser ignorado.)*

### 3. Subir os containers

```bash
docker compose --env-file .env.docker up -d --build
```

### 4. Entrar no container PHP

```bash
docker compose --env-file .env.docker exec php bash
```

### 5. Instalar dependências

```bash
composer install
```

```bash
chown -R 1000:1000 storage bootstrap/cache

chmod -R 775 storage bootstrap/cache
```

### 6. Criar o ambiente Laravel

```bash
cp .env.example .env
```

### 7. Gerar a chave da aplicação

```bash
php artisan key:generate
```

### 8. Executar as migrations e popular o banco

```bash
php artisan migrate:fresh --seed
```

### 9. Limpar caches

```bash
php artisan optimize:clear
```

---

### Observação sobre permissões

Caso o projeto seja executado em Linux e ocorram problemas de permissão nas pastas `storage` ou `bootstrap/cache`, execute:

```bash
chown -R 1000:1000 storage bootstrap/cache

chmod -R 775 storage bootstrap/cache
```

---

# Acesso

Aplicação

```
http://localhost:8080
```

phpMyAdmin

```
http://localhost:8081
```

---

# Estrutura do Projeto

```
app/
database/
resources/
routes/
docker/
```

---

# Decisões Técnicas

- Laravel 7 utilizando arquitetura MVC.
- Eloquent ORM para acesso aos dados.
- Dashboard desenvolvido com Blade e Bootstrap 5.
- JavaScript Vanilla para interações da interface.
- Chart.js para visualização gráfica.
- Paginação nativa do Laravel.
- Cálculo da eficiência realizado dinamicamente (não persistido em banco).
- Dados simulados através de Seeders.
- Ambiente totalmente containerizado com Docker.


---

# Autor

**Eduardo Correia**

Senior PHP / Laravel Developer

São Paulo - Brazil
