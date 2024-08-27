# Pinboard Links Project

## Overview

This project is a Laravel application that fetches and processes links from Pinboard, and presents them using a Vue.js front-end. The application includes a command to fetch links, an API route to return the data in JSON format, and a front-end interface to display the data with a dark/light mode switch.

## Installation

1. **Clone the repository**:
   ```bash
   git clone https://github.com/Timmsy1998/pinboard-app.git
   cd pinboard-app
   ```

2. **Install PHP Dependencies**:
    ```bash
    composer install
    ```

3. **Install JavaScript Dependencies**:
    ```bash
    npm install
    ```

4. **Setup the Environment Variables**:
    Copy the `.env.example` file to `.env` and update the relevant configuration settings

5. **Run Database Migrations**:
    ```bash
    php artisan migrate
    ```

6. **Generate the Application Key**:
    ```bash
    php artisan key:generate
    ```

7. **Fetch the Links**:
    *To Be Configured*

## Running the Application Locally

1. **Start the PHP Server**:
    ```bash
    cd pinboard-app (if you haven't already)
    php artisan serve
    ```

2. **Compile the Frontend Assets**:
    ```bash
    npm run dev
    ```

3. **Navigate to the local environment**:
    The local environment should be accessible at either http://127.0.0.1:8000/ or http://localhost:8000

## API

**To Be Built**

## Dependencies

- Laravel 11
-- PHP 8.3
- Vue.js 3
-- Axios

## Brief

For more details about the project requirements, please refer to the [BRIEF.md](./BRIEF.md) file.