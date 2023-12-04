<?php
namespace controller;

use models\UserModel;

class UserController {
    private $model;

    /**
     * Constructor for UserController.
     *
     * @param UserModel $model The UserModel instance to be used by the controller.
     */
    public function __construct(UserModel $model) {
        $this->model = $model;
    }

    /**
     * Creates a new employee.
     *
     * @param string $first_name The first name of the employee.
     * @param string $last_name  The last name of the employee.
     * @param string $username   The username chosen by the employee.
     * @param string $password   The password chosen by the employee.
     * @param string $role       The role of the employee (e.g., 'admin', 'user').
     *
     * @return bool True if employee creation is successful, false otherwise.
     */
    public function createEmployee($first_name, $last_name, $username, $password, $role): bool { // Adjust the return type here
        return $this->model->createEmployee($first_name, $last_name, $username, $password, $role);
    }

    /**
     * Retrieves all employees.
     *
     * @return mixed The result of the readEmployees operation.
     */
    public function getEmployees() { // Adjust the return type here
        return $this->model->readEmployees();
    }

    /**
     * Retrieves an employee by their ID.
     *
     * @param int $id The ID of the employee to retrieve.
     *
     * @return mixed The result of the readEmployeeById operation.
     */
    public function getEmployeeById($id) { // Adjust the return type here
        return $this->model->readEmployeeById($id);
    }

    /**
     * Updates an employee.
     *
     * @param int    $id          The ID of the employee to update.
     * @param string $first_name  The new first name for the employee.
     * @param string $last_name   The new last name for the employee.
     * @param string $username    The new username for the employee.
     * @param string $role        The new role for the employee (e.g., 'admin', 'user').
     *
     * @return bool True if employee update is successful, false otherwise.
     */
    public function updateEmployee($id, $first_name, $last_name, $username, $role): bool { // Adjust the return type here
        return $this->model->updateEmployee($id, $first_name, $last_name, $username, $role);
    }

    /**
     * Updates an employee's password.
     *
     * @param int    $id       The ID of the employee to update.
     * @param string $password The new password for the employee.
     *
     * @return bool True if password update is successful, false otherwise.
     */
    public function updateEmployeePassword($id, $password): bool { // Adjust the return type here
        return $this->model->updateEmployeePassword($id, $password);
    }

    /**
     * Deletes an employee by their ID.
     *
     * @param int $id The ID of the employee to delete.
     *
     * @return bool True if employee deletion is successful, false otherwise.
     */
    public function deleteEmployee($id): bool { // Adjust the return type here
        return $this->model->deleteEmployee($id);
    }

    /**
     * Retrieves the authenticated user.
     *
     * @return mixed The result of the readEmployeeByUsername operation.
     */
    public function getAuthUser() { // Adjust the return type here
        return $this->model->readEmployeeByUsername($_SESSION['username']);
    }
}
?>
