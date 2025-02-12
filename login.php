<?php include 'layout/header.php';?>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>

<div class="login-container">
    <h2>Login</h2>
    <div id="loginMsg"></div>
    <form id="loginForm">
        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email">
            <div class="error-text" id="emailError"></div>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password">
            <div class="error-text" id="passwordError"></div>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
        <p class="mt-3 text-center">Don't have an account? <a href="register.php" class="text-link">Sign up</a></p>
    </form>
</div>

<script src="js/login.js"></script>
</body>
</html>
