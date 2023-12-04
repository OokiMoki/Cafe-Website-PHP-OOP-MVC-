<?php

namespace model;

use core\Database;

class AdminDashboardModel
{
    private $db;

    /**
     * AdminDashboardModel constructor.
     *
     * @param Database $db An instance of the Database class for database operations.
     */
    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    /**
     * Get the role of a user based on the username.
     *
     * @param string $username The username of the user.
     *
     * @return string The role of the user or "default_role" if user not found or role not specified.
     */
    public function getUserRole($username)
    {
        // Establish a database connection
        $conn = $this->db->connect();

        // Use prepared statement to avoid SQL injection
        $query = "SELECT role FROM employees WHERE username = ?";

        // Prepare the statement
        $stmt = $conn->prepare($query);

        // Bind parameters
        $stmt->bind_param("s", $username);

        // Execute the statement
        if ($stmt->execute()) {
            // Get the result
            $result = $stmt->get_result();

            // Check if there is a result
            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return $row['role'];
            } else {
                // Default role if user not found or role not specified
                return "default_role";
            }
        } else {
            // Return an error message if the statement execution fails
            return "Error executing the statement: " . $stmt->error;
        }
    }
}
