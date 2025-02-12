<?php
require_once "layout/db_conn.php";

class User {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    #--Register User--#
    public function register($firstname, $lastname, $dob, $email, $gender, $password, $image) {
        $hashPass = password_hash($password, PASSWORD_BCRYPT);
        $imagePath = null;
    
        // Check if an image was uploaded
        if ($image && isset($image["name"]) && $image["error"] == 0) {
            $targetDir = "uploads/"; 
            $imagePath = $targetDir . time() . "_" . basename($image["name"]);
    
            // Move uploaded file to the target directory
            if (!move_uploaded_file($image["tmp_name"], $imagePath)) {
                return ["error" => "Failed to upload image"];
            }
        }
    
        // Prepare the SQL query to insert user data
        $stmt = $this->db->conn->prepare("INSERT INTO users (firstname, lastname, dob, email, gender, password, image) 
                                          VALUES (?, ?, ?, ?, ?, ?, ?)");
    
        // Bind parameters
        $stmt->bind_param("sssssss", $firstname, $lastname, $dob, $email, $gender, $hashPass, $imagePath);
    
        // Execute the query and return result
        if ($stmt->execute()) {
            return ["success" => true, "message" => "User registered successfully"];
        } else {
            return ["error" => "Failed to register user"];
        }
    }
    
    
    #--login function--#
    public function login($email, $password) {
        $stmt = $this->db->conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
    
        if ($user && password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user'] = $user;
    
            return [
                "status" => "success",
                "message" => "Login successful"
            ];
        }
        
        return [
            "status" => "danger",
            "message" => "Invalid email or password"
        ];
    }

    #--get all users--#
    public function getAllUsers() {
        $stmt = $this->db->conn->prepare("SELECT id, firstname, lastname, dob, email, gender, image FROM users ORDER BY created_at DESC");
        $stmt->execute();
        $result = $stmt->get_result();
        
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    #-- get user by id--#
    public function getLoggedInUser($userId) {
        $stmt = $this->db->conn->prepare("SELECT id, firstname, lastname, dob, email, gender, image FROM users WHERE id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        
        return $result->fetch_assoc();
    }






}
?>