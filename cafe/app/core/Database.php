<?php

namespace core;

class Database {
    private $host = 'localhost';
    private $user = 'root';
    private $password = '';
    private $database = 'cafe';

    /**
     * Establishes a database connection.
     *
     * @return \mysqli|false A MySQLi database connection object or false if the connection fails.
     */
    public function connect() {
        $conn = new \mysqli($this->host, $this->user, $this->password, $this->database);

        // Check for connection errors
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        return $conn;
    }
}
