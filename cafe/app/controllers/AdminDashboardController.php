<?php

namespace controller;

use core\Database;
use model\AdminDashboardModel;

class AdminDashboardController
{
    public function showDashboard()
    {
        // Check if the user is logged in and has a role
        if (isset($_SESSION['username'])) {
            // Instantiate Database and AdminDashboardModel
            $db = new Database();
            $model = new AdminDashboardModel($db);

            // Assume $username is the currently logged-in user's username
            $username = $_SESSION['username'];

            // Get the user's role from the model
            $userRole = $model->getUserRole($username);
            
            header('Location: ../views/login/login.php');
            exit();
        }
    }

    public function userRole()
    {
        // Check if the user is logged in and has a role
        if (isset($_SESSION['username'])) {
            // Instantiate Database and AdminDashboardModel
            $db = new Database();
            $model = new AdminDashboardModel($db);

            // Assume $username is the currently logged-in user's username
            $username = $_SESSION['username'];
            // Get the user's role from the model
            $userRole = $model->getUserRole($username);
            
            return $userRole;
        }
    }

}

?>
