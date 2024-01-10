# Laravel Test

Assignment Test

## Table of Contents

- [Prerequisites](#prerequisites)
- [Getting Started](#getting-started)
- [Configuration](#configuration)
- [Database Setup](#database-setup)
- [Running the Application](#running-the-application)
- [Testing](#testing)
- [Deployment](#deployment)
- [Built With](#built-with)
- [Contributing](#contributing)
- [License](#license)
- [Acknowledgments](#acknowledgments)

## Prerequisites

Before you begin, ensure you have met the following requirements:

- PHP >= 8.1
- Composer installed ([Install Composer](https://getcomposer.org/doc/00-intro.md#installation))
- Node.js and npm installed ([Install Node.js and npm](https://nodejs.org/))

## Getting Started

1. Clone the repository:

    ```bash
    git clone https://github.com/shubham-joshi765/laravel_test.git
    ```

2. Navigate to the project directory:

    ```bash
    cd laravel_test
    ```

3. Install PHP dependencies:

    ```bash
    composer install
    ```

4. Install JavaScript dependencies:

    ```bash
    npm install
    ```

## Configuration

1. Copy the `.env.example` file to `.env`:

    ```bash
    cp .env.example .env
    ```

2. Generate an application key:

    ```bash
    php artisan key:generate
    ```

3. Update the `.env` file with your database and other configuration details.

## Database Setup

1. Create a new database for your project.

2. Update the `.env` file with your database credentials:

    ```dotenv
    DB_CONNECTION=mysql
    DB_HOST=your_database_host
    DB_PORT=your_database_port
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_username
    DB_PASSWORD=your_database_password
    ```

3. Migrate the database:

    ```bash
    php artisan migrate
    ```

4. Seed the database with sample data:

    ```bash
    php artisan db:seed
    ```

## Running the Application

```bash1
php artisan serve 

```bash2
npm run dev


