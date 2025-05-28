# Service Booking Platform API

This is a backend API for a service booking platform, built with **Laravel** and Dockerized for easy setup.

## 🚀 Features

-   User authentication
-   Service CRUD (for admin)
-   Service booking and status updates
-   Dockerized environment (MySQL, PHPMyAdmin, Laravel app)

## ⚙️ Setup & Run Instructions

### 🐳 Prerequisites

-   Docker & Docker Compose installed
-   Make

### 📦 Setup

**Clone the repo:**

```bash
git clone https://github.com/RatulAlMamun/Assignment-Sheba-Platform-Ltd.git
cd Assignment-Sheba-Platform-Ltd
```

**Start the containers:**

```bash
make up
```

**Install dependencies and set up the Laravel app:**

```bash
make bash
composer install
cp .env.example .env

// DB setup
DB_CONNECTION=mysql
DB_HOST=laravel-db
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=root

// Mail setup (mailtrip.io)
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mailtrip_username
MAIL_PASSWORD=our_mailtrip_password
MAIL_ENCRYPTION=null

// Generate the key
php artisan key:generate
exit

```

**Run migrations and seed the db:**

```bash
make artisan cmd="migrate"
make artisan cmd="db:seed"
```

📍 **Visit your app at:** http://localhost:8000  
📍 **PHPMyAdmin at:** http://localhost:8081

> PHPMyAdmin Login info: `Username: root, Password: root`

## 📬 API Documentation

### Postman Collection

Import the file: [postman_collection.json](./sheba-postman-collection.json)

## 🧪 How to Run Tests

```bash
make test
```

## 🛠 Useful Makefile Commands

| Command                  | Description                     |
| ------------------------ | ------------------------------- |
| `make up`                | Start the app                   |
| `make down`              | Stop the app                    |
| `make restart`           | Rebuild and start the app       |
| `make bash`              | Bash into the Laravel container |
| `make artisan cmd="..."` | Run any Artisan command         |
| `make queue-work`        | Run the queue                   |
| `make test`              | Run Laravel test suite          |

> **⚠️ Queue Warning:** Must run `make queue-work`. Without this, queued jobs like emails will not be processed
