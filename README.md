
## Installation
```sh
git clone https://github.com/matheusroomao/home-appliances-api.git
```
```sh
composer install
```
Populate the database.
```sh
php artisan migrate
```
## API Route
### Marcas
Listar marcas
```bash
GET: http://127.0.0.1:8000/api/brands/
```
Cadastrar nova marca
```bash
POST: http://127.0.0.1:8000/api/brands/
{
  "name": "Nome marca"
}
```
Atualizar marca
```bash
PUT: http://127.0.0.1:8000/api/brands/1
{
  "name": "Atualizar marca"
}
```
Apagar marca
```bash
DELETE: http://127.0.0.1:8000/api/brands/1
```

### Eletrodomésticos
Listar eletrodomésticos
```bash
GET: http://127.0.0.1:8000/api/products/
```
Cadastrar novo eletrodomésticos
```bash
POST: http://127.0.0.1:8000/api/products/
{
   "name": "Geladeira",
   "description": "Cycle Defrost 260 Litros Branco DC35A – 220 Volts O Refrigerador Cycle. ",
   "voltage": "220v" ou "110v",
   "brand_id": 1 = id da marca
}
```
Atualizar eletrodomésticos
- Pode-se passar apenas os campos desejados para atualizar

```bash
PUT: http://127.0.0.1:8000/api/products/1
{
  "name": "Geladeira",
  "description": "Cycle Defrost 260 Litros Branco DC35A – 220 Volts O Refrigerador Cycle. ",
  "voltage": "220v",
  "brand_id": 1 = id da marca
}
```
Apagar products
```bash
DELETE: http://127.0.0.1:8000/api/products/1
```

## Test
```sh
 php artisan test
```
