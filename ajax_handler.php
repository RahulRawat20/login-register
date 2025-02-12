<?php
// Class
require_once "User.php";

// Object
$user = new User();

// register function
    if ($_POST['action'] == "register") {
        $response = $user->register(
            $_POST["firstname"],
            $_POST["lastname"],
            $_POST["dob"],
            $_POST["email"],
            $_POST["gender"],
            $_POST["password"],
            isset($_FILES["image"]["name"]) ? $_FILES["image"] : null
        );
        echo json_encode($response);
    }

// login function 
    if ($_POST['action'] == "login") {
        $response = $user->login($_POST["email"], $_POST["password"]);
        echo json_encode($response);
        exit;
    }

// Get all users
    if ($_POST['action'] == "get_users") {
        $users = $user->getAllUsers();
        echo json_encode($users);
    }

// Get logged-in user details
    if ($_POST['action'] == "get_logged_in_user") {
        session_start();
        if (isset($_SESSION['user']['id'])) {
            $userData = $user->getLoggedInUser($_SESSION['user']['id']);
            echo json_encode($userData);
        } else {
            echo json_encode(["error" => "User not logged in"]);
        }
    }

// Logout
    if ($_POST['action'] == "logout") {
        session_start();
        session_destroy();
        echo json_encode(["status" => "success", "message" => "Logged out successfully"]);
    }
?>