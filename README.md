# Consuming external API with Laravel

This repository contains a Laravel application that integrates an external API to populate a product table. It uses Redis as a message broker and Laravel Horizon as an interface and queue management. Authentication to access the API is done with Laravel Sanctum.

## 🚀 Installation

**To install the application on your machine, follow the steps below:**

```bash
git clone https://github.com/oGuilherme1/consuming-external-api.git
```

```bash
cp .env.example .env
```
Set these values ​​in your .env with your data
- DB_DATABASE=your_database `Default: laravel`
- DB_USERNAME=your_username `Default: root`
- DB_PASSWORD=your_password `Default: root`

```bash
docker-compose up -d
```

```bash
docker exec -it laravel_container bash
```

```bash
php artisan key:generate
```

Wait a few seconds for the laravel server to start, otherwise the command below displays a connection error
```bash
php artisan migrate
```

Access the page [http://localhost:8000](http://localhost:8000) in your browser.

## 👨‍💻 Commands

### Create all products

```bash
php artisan products:import
```

### Create a specific product

```bash
php artisan products:import --id=123
```

### Start the horizon

```bash
php artisan horizon
```

## 📡 Endpoints 

### User

#### Create user

- **Method**: POST
- **URL**: http://localhost:8000/api/v1/register

```json
{
    "name": "test",
    "email": "test@gmail.com",
    "password": "1234"
}
```

#### Login

- **Method**: POST
- **URL**: http://localhost:8000/api/v1/login
- **Token required**: `Authorization: Bearer {TOKEN}`

```json
{
    "email": "test@gmail.com",
    "password": "1234"
}
```

#### Logout

- **Method**: POST
- **URL**: http://localhost:8000/api/v1/logout
- **Token required**: `Authorization: Bearer {TOKEN}`

```json
{}
```

### Products

#### Create product

- **Method**: POST
- **URL**: http://localhost:8000/api/v1/product
- **Token required**: `Authorization: Bearer {TOKEN}`

```json
{
    "name": "test",
    "price": 100.00,
    "description": "product test",
    "category": "test",
    "image": "https://test.jpg"
}
```

#### Edit product

- **Method**: PUT
- **URL**: http://localhost:8000/api/v1/product/1
- **Token required**: `Authorization: Bearer {TOKEN}`

```json
{
    "name": "test update",
    "price": 100.00,
    "description": "product test update",
    "category": "test update",
    "image": "https://test_update.jpg"
}
```

#### Delete product

- **Method**: DELETE
- **URL**: http://localhost:8000/api/v1/product/1
- **Token required**: `Authorization: Bearer {TOKEN}`

```json
{}
```

#### All products

- **Method**: GET
- **URL**: http://localhost:8000/api/v1/product
- **Token required**: `Authorization: Bearer {TOKEN}`

```json
{}
```

#### Single product

- **Method**: GET
- **URL**: http://localhost:8000/api/v1/product/1
- **Token required**: `Authorization: Bearer {TOKEN}`

```json
{}
```

## 🛠️ Technologies Used

- PHP (version 8.1)
- Laravel (version 10)
- Redis (latest version from Docker)
- MySQL (latest version from Docker)

