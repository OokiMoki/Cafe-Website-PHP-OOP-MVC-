<?php
namespace controller;

use model\RegistrationModel;

class RegistrationController {
    private $registrationModel;

    /**
     * Constructor for RegistrationController.
     *
     * @param RegistrationModel $registrationModel The RegistrationModel instance to be used by the controller.
     */
    public function __construct(RegistrationModel $registrationModel) {
        $this->registrationModel = $registrationModel;
    }

    /**
     * Registers a new user.
     *
     * @param string $first_name The first name of the user.
     * @param string $last_name  The last name of the user.
     * @param string $username   The username chosen by the user.
     * @param string $password   The password chosen by the user.
     * @param string $role       The role of the user (e.g., 'admin', 'user').
     *
     * @return mixed The result of the registerUser operation.
     */
    public function registerUser($first_name, $last_name, $username, $password, $role) {
        // Additional validation can be added here if needed

        // Register the user
        return $this->registrationModel->registerUser($first_name, $last_name, $username, $password, $role);
    }
}
?>
