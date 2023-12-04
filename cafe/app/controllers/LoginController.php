<?php
namespace controller;

use model\LoginModel;

class LoginController {
    private $loginModel;

    /**
     * Constructor for LoginController.
     *
     * @param LoginModel $loginModel The LoginModel instance to be used by the controller.
     */
    public function __construct(LoginModel $loginModel) {
        $this->loginModel = $loginModel;
    }

    /**
     * Attempts to authenticate a user based on provided credentials.
     *
     * @param string $username The username entered by the user.
     * @param string $password The password entered by the user.
     *
     * @return bool True if authentication is successful, false otherwise.
     */
    public function login($username, $password) {
        // Retrieve user information from the model based on the provided username
        $user = $this->loginModel->getUserByUsername($username);

        // Check if the user exists and the provided password matches the stored hashed password
        if ($user !== null && password_verify($password, $user['password'])) {
            // Password is correct, login successful
            return true;
        } else {
            // Password is incorrect, login failed
            return false;
        }
    }
}
?>
