
# Rekaz Drive - Simple Blob Storage

A PHP application to store and retrieve data using a MySQL database. This project handles storing and retrieving data with metadata in a simple, efficient way.

## Features

- **Store Data**: Save data in two MySQL tables (`blob_metadata` and `blob_data`) based on JSON input containing an ID and data.
- **Retrieve Metadata**: Fetch metadata (`id`, `size`, `created_at`) from the `blob_metadata` table using the ID parameter.

## Technologies

- PHP
- MySQL
- PDO for database interaction
- JSON for data exchange

## Database Schema

### `blob_metadata` Table
- `id` (VARCHAR): Unique identifier for the blob
- `size` (INT): Size of the blob
- `created_at` (TIMESTAMP): Timestamp when the blob was created

### `blob_data` Table
- `id` (VARCHAR): Unique identifier for the blob (foreign key)
- `data` (BLOB): The actual data

## Setup

1. **Database Configuration**: Ensure you have a MySQL database named `rekaz_drive` and update the connection details in `db_connection.php`.

    ```php
    $host = 'localhost'; 
    $dbname = 'rekaz_drive'; 
    $username = 'root'; 
    $password = 'your_password'; 
    ```

2. **Create Tables**: Use the following SQL queries to create the necessary tables:

    ```sql
    CREATE TABLE blob_metadata (
        id VARCHAR(255) PRIMARY KEY,
        size INT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );

    CREATE TABLE blob_data (
        id VARCHAR(255),
        data BLOB,
        FOREIGN KEY (id) REFERENCES blob_metadata(id)
    );
    ```

3. **Run the Application**: Use a local server (e.g., WAMP, XAMPP) to run the PHP files.

## API Endpoints

### Store Data

- **Endpoint**: `/save_data.php`
- **Method**: POST
- **Input**: JSON

    ```json
    {
        "id": "unique_id",
        "data": "your_data"
    }
    ```

- **Output**: JSON

    ```json
    {
        "message": "Data stored successfully"
    }
    ```

### Retrieve Metadata

- **Endpoint**: `/retrieve.php`
- **Method**: GET
- **Input**: URL Parameter

    ```
    /retrieve.php?id=unique_id
    ```

- **Output**: JSON

    ```json
    {
        "id": "unique_id",
        "size": 1234,
        "created_at": "2023-07-16 12:34:56"
    }
    ```

## Error Handling

- Returns `400 Bad Request` for missing parameters.
- Returns `404 Not Found` for non-existing data IDs.

## Testing with Postman

1. **Store Data**:
    - Method: POST
    - URL: `http://yourdomain.com/save_data.php`
    - Headers: Content-Type: application/json
    - Body: JSON
      ```json
      {
          "id": "unique_id",
          "data": "your_data"
      }
      ```

2. **Retrieve Metadata**:
    - Method: GET
    - URL: `http://yourdomain.com/retrieve.php?id=unique_id`

---

By using Postman, you can easily test the API endpoints to ensure they are working as expected.

---

