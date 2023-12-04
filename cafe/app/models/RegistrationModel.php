<?php
namespace model;

use core\Database;

class RegistrationModel {
    private $conn;

    /**
     * RegistrationModel constructor.
     *
     * @param Database $database An instance of the Database class for database operations.
     */
    public function __construct(Database $database) {
        $this->conn = $database->connect();
    }

    /**
     * Register a new user.
     *
     * @param string $first_name The first name of the user.
     * @param string $last_name  The last name of the user.
     * @param string $username   The username for the new user.
     * @param string $password   The password for the new user.
     * @param string $role       The role of the new user.
     *
     * @return bool True if the registration is successful, otherwise false.
     */
    public function registerUser($first_name, $last_name, $username, $password, $role) {
        // Check if the username is already taken
        $checkUsernameQuery = "SELECT * FROM employees WHERE username = '$username'";
        $result = $this->conn->query($checkUsernameQuery);

        if ($result->num_rows > 0) {
            // Username already exists
            return false;
        }

        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Insert the new user into the database
        $insertQuery = "INSERT INTO employees (first_name, last_name, username, password, role) VALUES ('$first_name', '$last_name', '$username', '$hashed_password', '$role')";
        $result = $this->conn->query($insertQuery);

        return $result;
    }
}
