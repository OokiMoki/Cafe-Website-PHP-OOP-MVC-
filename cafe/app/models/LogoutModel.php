<?php
namespace model;

class LogoutModel {
    public function logout() {
        // Unset all session variables
        $_SESSION = [];

        // Destroy the session
        session_destroy();
    }
}
?>
