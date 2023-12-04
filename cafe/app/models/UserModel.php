<?php

namespace models;

use core\Database;

/**
 * UserModel class.
 *
 * This class handles user-related operations such as fetching user details by username,
 * hashing passwords, checking username uniqueness, creating, reading, updating, and deleting employees,
 * and more.
 */
class UserModel
{
    /** @var \mysqli Database connection object. */
    private $conn;

    /**
     * Constructor.
     *
     * Initializes the UserModel with a database connection.
     *
     * @param Database $database The database connection.
     */
    public function __construct(Database $database)
    {
        $this->conn = $database->connect();
    }

    /**
     * Get user details by username.
     *
     * @param string $username The username to fetch details for.
     *
     * @return array|null Fetched user details or null if not found.
     */
    public function getUserByUsername($username)
    {
        $result = $this->conn->query("SELECT * FROM employees WHERE username = '$username'");
        return $result->fetch_assoc();
    }

    /**
     * Hash a password using the default algorithm.
     *
     * @param string $password The password to hash.
     *
     * @return string The hashed password.
     */
    public function hashPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * Check if a username is unique.
     *
     * @param string $username The username to check for uniqueness.
     *
     * @return bool True if the username is unique, false otherwise.
     */
    public function isUsernameUnique($username)
    {
        $con = $this->conn;

        $sql = "SELECT employee_id FROM employees WHERE username=?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        return $stmt->num_rows == 0;
    }

    /**
     * Check if a username is unique, excluding the current user.
     *
     * @param string $username      The username to check for uniqueness.
     * @param int    $currentUserId The ID of the current user to exclude from the check.
     *
     * @return bool True if the username is unique, false otherwise.
     */
    public function isUsernameUniqueExceptCurrent($username, $currentUserId)
    {
        $con = $this->conn;

        $sql = "SELECT employee_id FROM employees WHERE username=? AND employee_id != ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("si", $username, $currentUserId);
        $stmt->execute();
        $stmt->store_result();

        return $stmt->num_rows == 0;
    }

    /**
     * Create a new employee.
     *
     * @param string $first_name First name of the employee.
     * @param string $last_name  Last name of the employee.
     * @param string $username   Username of the employee.
     * @param string $password   Password of the employee.
     * @param string $role       Role of the employee.
     *
     * @return bool|string True if creation is successful, an error message otherwise.
     */
    public function createEmployee($first_name, $last_name, $username, $password, $role)
    {
        if (!$this->isUsernameUnique($username)) {
            return false;
        }

        $con = $this->conn;
        $hashed_password = $this->hashPassword($password);

        $sql = "INSERT INTO employees (first_name, last_name, username, password, role) VALUES (?, ?, ?, ?, ?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("sssss", $first_name, $last_name, $username, $hashed_password, $role);

        if ($stmt->execute()) {
            return true;
        } else {
            return "Error creating employee: " . $stmt->error;
        }
    }

    /**
     * Read details of all employees.
     *
     * @return array|string Array of all employees' details or an error message if none found.
     */
    public function readEmployees()
    {
        $con = $this->conn;

        $sql = "SELECT * FROM employees ORDER BY employee_id DESC";
        $result = $con->query($sql);

        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return "No employees found";
        }
    }

    /**
     * Read details of an employee by ID.
     *
     * @param int $id The ID of the employee.
     *
     * @return array|string Fetched employee details or an error message if not found.
     */
    public function readEmployeeById($id)
    {
        $con = $this->conn;

        $sql = "SELECT * FROM employees WHERE employee_id = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return $row;
            } else {
                return "No employees found";
            }
        } else {
            return "Error executing the statement: " . $stmt->error;
        }
    }

    /**
     * Update employee information.
     *
     * @param int    $employee_id Employee ID.
     * @param string $first_name  First name of the employee.
     * @param string $last_name   Last name of the employee.
     * @param string $username    Username of the employee.
     * @param string $role        Role of the employee.
     *
     * @return bool True if the update is successful, false otherwise.
     */
    public function updateEmployee($employee_id, $first_name, $last_name, $username, $role)
    {
        if (!$this->isUsernameUniqueExceptCurrent($username, $employee_id)) {
            return false;
        }

        $con = $this->conn;

        $sql = "UPDATE employees SET first_name=?, last_name=?, username=?, role=? WHERE employee_id=?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ssssi", $first_name, $last_name, $username, $role, $employee_id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Update employee password.
     *
     * @param int    $employee_id Employee ID.
     * @param string $password    New password for the employee.
     *
     * @return bool True if the update is successful, false otherwise.
     */
    public function updateEmployeePassword($employee_id, $password)
    {
        $con = $this->conn;
        $hashed_password = $this->hashPassword($password);

        $sql = "UPDATE employees SET password=? WHERE employee_id=?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("si", $hashed_password, $employee_id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Delete an employee.
     *
     * @param int $employee_id Employee ID.
     *
     * @return bool True if the deletion is successful, false otherwise.
     */
    public function deleteEmployee($employee_id)
    {
        $con = $this->conn;

        $sql = "DELETE FROM employees WHERE employee_id=?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("i", $employee_id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Read details of an employee by username.
     *
     * @param string $username Username of the employee.
     *
     * @return array|string Fetched employee details or an error message if not found.
     */
    public function readEmployeeByUsername($username)
    {
        $con = $this->conn;

        $sql = "SELECT * FROM employees WHERE username = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("s", $username);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return $row;
            } else {
                return "No employees found";
            }
        } else {
            return "Error executing the statement: " . $stmt->error;
        }
    }
}
