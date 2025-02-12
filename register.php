<?php include 'layout/header.php';?>

<link rel="stylesheet" href="css/register.css">
</head>
<body>
<div class="container">
    <h2 align=center>Register</h2><hr>
    <form id="registerForm" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input type="hidden" class="form-control" name="action" value="register">
            <input type="text" class="form-control" name="firstname" id="name" placeholder="Enter your name" >
        </div>
        <div class="mb-3">
            <label for="last-name" class="form-label">Last Name</label>
            <input type="text" class="form-control" name="lastname" id="last-name" placeholder="Enter your last name" >
        </div>
        <div class="mb-3">
            <label for="dob" class="form-label">Date of Birth</label>
            <input type="date" class="form-control" name="dob" id="dob" >
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email" >
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Profile Image</label>
            <input type="file" class="form-control" name="image" id="image">
        </div>
        <div id="imageContainer" class="image-container"></div>
        <div class="mb-3">
            <label class="form-label">Gender</label><br>
            <input type="radio" id="male" name="gender" value="male" >
            <label for="male">Male</label>
            <input type="radio" id="female" name="gender" value="female">
            <label for="female">Female</label>
            <input type="radio" id="other" name="gender" value="other">
            <label for="other">Other</label>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <div class="input-group">
                <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password" >
                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                    <i class="bi bi-eye"></i>
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
            <button type="submit" class="btn btn-success">Register</button>
            <a href="login.php" class="btn btn-danger" > Already have an account? Login</a>
            </div>
        </div>
        
    </form>
</div>

<script src="js/register.js"></script>


</body>
</html>
