# Pinboard Links Project

## Overview

This project is a Laravel application that fetches and processes links from Pinboard, and presents them using a Vue.js front-end. The application includes a command to fetch links, an API route to return the data in JSON format, and a front-end interface to display the data with a dark/light mode switch.

## Brief

For more details about the project requirements, please refer to the [BRIEF.md](./BRIEF.md) file.

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
    ```bash
    php artisan app:fetch-links
    ```

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
    The local environment should be accessible at either http://127.0.0.1:8000/ or http://localhost:8000/  
      
    The frontend for this application is viewable at http://127.0.0.1:8000/links or http://localhost:8000/links 

## Dependencies

- Laravel 11  
- - PHP 8.3  
- Vue.js 3  
- - Axios  

## App Previews

<p align="center">
  <img src="./imgs/light-full-prev.png" alt="Light Mode Full Preview" title="Light Mode Full Preview" width="45%" />
  <img src="./imgs/dark-full-prev.png" alt="Dark Mode Full Preview" title="Dark Mode Full Preview" width="45%" />
</p>
<p align="center">
  <img src="./imgs/light-filtered-prev.png" alt="Light Mode Filtered Preview" title="Light Mode Filtered Preview" width="45%" />
  <img src="./imgs/dark-filtered-prev.png" alt="Dark Mode Filtered Preview" title="Dark Mode Filtered Preview" width="45%" />
</p>
<p align="center">
  <img src="./imgs/responsive-full-prev.png" alt="Responsive Full Preview" title="Responsive Full Preview" width="45%" />
  <img src="./imgs/responsive-filtered-prev.png" alt="Responsive Filtered Preview" title="Responsive Filtered Preview" width="45%" />
</p>

## Summary

Task Completion time was 2 hours and 32 minutes  
Unit Testing Completion Time was 35 minutes
Total Time Spent was 3 hours and 07 minutes
  
I tried to stay away from adding external packages in order to display my knowledge of what's already inside Laravel, Vue and Intertia. I chose Inertia and Breeze for this due to the fact that it's a quick and easy install of Laravel with Vue, without having to worry too much about a regular vue application set-up