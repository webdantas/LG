# LG Electronics - Dashboard de Eficiência da Produção

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

---

# Cálculo da Eficiência

A eficiência é calculada dinamicamente pela aplicação.

```
((Produzidas - Defeitos) / Produzidas) × 100
```

O valor não é armazenado no banco de dados para evitar redundância de informações.

---

# Como executar

Subir os containers

```bash
docker compose --env-file .env.docker up -d --build
```

Entrar no container

```bash
docker compose exec php bash
```

Instalar dependências

```bash
composer install
```

Gerar chave

```bash
php artisan key:generate
```

Executar migrations

```bash
php artisan migrate
```

Popular o banco

```bash
php artisan db:seed
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

* Utilização do Eloquent ORM.
* Paginação para melhor desempenho da listagem.
* Dados simulados utilizando Seeders.
* Dashboard desenvolvido com Blade, Bootstrap e JavaScript.
* Gráfico utilizando Chart.js.

---

# Autor

Eduardo Correia
