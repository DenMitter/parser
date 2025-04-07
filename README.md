<h1 align="center">
    <b>ParserService</b>
</h1>

<p align="center">
    This project implements a service for parsing data from websites. It uses the `PHPHtmlParser` library to process HTML content and retrieve necessary information about channels on the website. Additionally, it features caching of parsed results using Laravel Cache.
</p>

## Description

ParserService allows you to retrieve data about channels from **TwitchMetrics**, including:
- Channel name
- Subscriber count
- Time since last activity
- Progress bar to show subscriber growth
- Link to the channel's avatar

## Features

1. **Data Parsing**: Retrieves channel information from the **TwitchMetrics** website.
2. **Caching**: Uses Laravel Cache to store parsed results, reducing the number of requests to the external site.
3. **Error Handling**: In case of parsing errors, it returns an empty array to avoid program crashes.

## Setup Instructions

1. Clone the repository:
    ```bash
    git clone https://github.com/your-username/parser-service.git
    ```
2. Navigate to the project directory:
    ```bash
    cd parser-service
    ```
3. Install dependencies:
    ```bash
    composer install
    ```
4. Create the `.env` file:
    ```bash
    cp .env.example .env
    ```
5. Run migrations (if necessary):
    ```bash
    php artisan migrate
    ```
6. Generate the application key:
    ```bash
    php artisan key:generate
    ```

## Tests
To run the tests, use `PHPUnit`. Execute the following command:

```bash
php artisan test
```

The tests check the following functionalities:

- Return of cached data if it exists.
- Successful parsing of data from the website.
- Handling of parsing errors (returns an empty array on error).