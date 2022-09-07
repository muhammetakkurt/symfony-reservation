# Symfony reservation system

Ports used in the project:
| Software | Port |
|-------------- | -------------- |
| **nginx** | 8081 |
| **phpmyadmin** | 8086 |
| **mysql** | 33007 |
| **php** | 9000 |

## Installation

1. Clone this project:

   ```sh
   git clone https://github.com/muhammetakkurt/symfony-reservation
   ```

2. Inside the folder `symfony-reservation` and Generate your own `.env` to docker compose with the next command:

   ```sh
   cp .env.example .env
   ```

3. Build the project whit the next commands:

   ```sh
   docker-compose up --build
   ```

4. Update Composer:
   ```sh
   docker-compose run --rm composer update
   ```

5. Run all migrations:

   ```sh
   docker-compose run --rm console doctrine:migrations:diff
   ```

   ```sh
   docker-compose run --rm console doctrine:migrations:migrate
   ```
---