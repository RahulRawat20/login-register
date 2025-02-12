<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
else{
    $user = $_SESSION['user'];
  //print_r($user);
    
}
?>

<?php
    include 'layout/header.php';
?>
<link rel="stylesheet" href="css/dashboard.css">
</head>
<body>

<div class="container mt-5">
    <h2 align='center'>User Dashboard</h2>

    <div class="mt-3">
        <button id="getLoggedInUser" class="btn btn-primary">Login User Details</button>
        <button id="getAllUsers" class="btn btn-success">All User Details</button>
        <button id="logoutBtn" class="btn btn-danger">Log Out</button>
    </div>

    <div id="dataDisplay" class="mt-4">
        <h4>Welcome to the Dashboard Page</h4>
    </div>
</div>

<script src="js/dashboard.js"></script>

</body>
</html>
