<?php
namespace controller;

use model\LogoutModel;

class LogoutController {
    private $logoutModel;

    /**
     * Constructor for LogoutController.
     *
     * @param LogoutModel $logoutModel The LogoutModel instance to be used by the controller.
     */
    public function __construct(LogoutModel $logoutModel) {
        $this->logoutModel = $logoutModel;
    }

    /**
     * Performs the logout process.
     *
     * @return void This method does not return a value.
     */
    public function performLogout() {
        // Delegate the logout functionality to the LogoutModel
        $this->logoutModel->logout();
    }
}
?>
