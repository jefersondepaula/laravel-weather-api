# Laravel Weather API
A simple Laravel-based weather API that fetches current weather information. The project uses JWT for authentication and interacts with an external weather service.

## Table of Contents
- Installation
- Usage
- Authentication
- Fetching Weather Information
- Testing with Postman or Insomnia

## Installation
1.    ```bash
      git clone https://github.com/jefersondepaula/laravel-weather-api.git
      cd laravel-weather-api

## Set Up Environment Variables

Add the following keys to your .env file:

env
Copy code 
```bash
WEATHER_API_KEY=3990392534b149a2854113602232507
JWT_SECRET=cDjkOYXs9cAvUoWbfMTwGRO2quPky3XqLTQYuVPHMYrR4yjvhpXFQOlEeQlIK7UG
```

## Create a User in the Database

Run the command to seed the database and create a user:

```bash
Copy code
php artisan db:seed
The created user:
```

*Email: test@test.com*
*Password: password*

## Usage
-- Testing with Postman or Insomnia
-- Authenticate by sending a POST request to the login endpoint:
```
http://127.0.0.1:8000/api/login
```
## Header:
```bash
Content-Type: application/x-www-form-urlencoded
Body:
email: test@test.com
password: password
```

![image](https://github.com/jefersondepaula/laravel-weather-api/assets/55894519/7adb88b8-d0e0-4f82-8b1b-b16aef931653)


Copy the JWT token from the response.
```bash
Send a POST request to the weather endpoint at http://127.0.0.1:8000/api/weather:
```

## Header:
```
Content-Type: application/x-www-form-urlencoded
Authorization: Bearer <jwt> (Replace <jwt> with the copied JWT token)
Form parameter: location with the desired location's value.
Execute the request to fetch the weather information for the specified location.
```
![image](https://github.com/jefersondepaula/laravel-weather-api/assets/55894519/0e680dcd-e701-402a-8520-3faa10c6d734)


location: The desired location for weather information.
Testing with Postman or Insomnia
Please follow the instructions in the Usage section to test the endpoints.

Authenticate to obtain the JWT token.
Use the JWT token in the Authorization header when fetching weather information.
![image](https://github.com/jefersondepaula/laravel-weather-api/assets/55894519/c5efd359-333a-4eb3-a5d3-2a001268d7cd)
