# API Livros

API RESTful em Laravel com `apiResource` e `JsonResource`, mais o consumo da PokéAPI.

## Instalação

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

No Windows (cmd), use `copy .env.example .env`. Se o `migrate` perguntar sobre criar o arquivo `database.sqlite`, responda `yes`.

A API fica em `http://localhost:8000/api`.

## Rotas

| Verbo | URI | Ação |
|---|---|---|
| GET | /api/livros | index |
| POST | /api/livros | store |
| GET | /api/livros/{id} | show |
| PUT/PATCH | /api/livros/{id} | update |
| DELETE | /api/livros/{id} | destroy |
| GET | /api/externo/pokemon/{nome} | consumo da PokéAPI |

## Postman

Importe `postman/API-Livros.postman_collection.json` e rode a collection.

| Requisição | Esperado |
|---|---|
| POST /api/livros | 201 |
| GET /api/livros | 200 |
| GET /api/livros/{id} | 200 |
| PUT /api/livros/{id} | 200 |
| POST /api/livros com `{}` | 422 |
| GET /api/livros/999999 | 404 |
| DELETE /api/livros/{id} | 204 |
| GET /api/externo/pokemon/pikachu | 200 |
| GET /api/externo/pokemon/xyz | 404 |
