<?php
namespace model;

use core\Database;

class LoginModel {
    private $conn;

    /**
     * LoginModel constructor.
     *
     * @param Database $database An instance of the Database class for database operations.
     */
    public function __construct(Database $database) {
        $this->conn = $database->connect();
    }

    /**
     * Get user details by username.
     *
     * @param string $username The username of the user.
     *
     * @return array|null An array containing user details if the user is found, otherwise null.
     */
    public function getUserByUsername($username) {
        // Use prepared statement to avoid SQL injection
        $stmt = $this->conn->prepare("SELECT * FROM employees WHERE username = ?");
        $stmt->bind_param("s", $username);

        // Execute the statement
        if ($stmt->execute()) {
            // Get the result
            $result = $stmt->get_result();
            
            // Check if there is a result
            if ($result && $result->num_rows > 0) {
                return $result->fetch_assoc();
            } else {
                return null; // User not found
            }
        } else {
            return null; // Error executing the statement
        }
    }
}
