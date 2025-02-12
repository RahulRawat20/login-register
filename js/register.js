$(document).ready(function() {
    // Password toggle
    $("#togglePassword").click(function() {
        let passwordField = $("#password");
        let type = passwordField.attr("type") === "password" ? "text" : "password";
        passwordField.attr("type", type);
        $(this).find("i").toggleClass("bi-eye bi-eye-slash");
    });

    // Image preview
    $("#image").change(function(event) {
        let reader = new FileReader();
        reader.onload = function(e) {
            $("#imageContainer").html(`<img src="${e.target.result}" class="img-thumbnail" width="150">`);
        };
        reader.readAsDataURL(event.target.files[0]);
    });

    // Form Submission with AJAX
    $("#registerForm").submit(function(e) {
        e.preventDefault();
        $(".form-control").removeClass("invalid");
        $(".error-message").remove(); // Remove previous error messages

        let isValid = true;
        let name = $("#name");
        let lastName = $("#last-name");
        let dob = $("#dob");
        let email = $("#email");
        let password = $("#password");
        let gender = $("input[name='gender']:checked");
        let image = $("#image")[0].files[0];
        
        let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        function validateField(field, errorMessage) {
            if (!field.val().trim()) {
                isValid = false;
                field.addClass("invalid");
                field.after(`<small class="text-danger error-message">${errorMessage}</small>`);
            }
        }

        validateField(name, "Full Name is required");
        validateField(lastName, "Last Name is required");
        validateField(dob, "Date of Birth is required");
        validateField(email, "Email is required");
        validateField(password, "Password is required");

        if (email.val().trim() && !emailRegex.test(email.val())) {
            isValid = false;
            email.addClass("invalid");
            email.after(`<small class="text-danger error-message">Invalid Email</small>`);
        }

        if (password.val().trim() && password.val().length < 6) {
            isValid = false;
            password.addClass("invalid");
            password.after(`<small class="text-danger error-message">Password must be at least 6 characters</small>`);
        }

        if (!gender.length) {
            isValid = false;
            $("#male").parent().after(`<small class="text-danger error-message">Please select a gender</small>`);
        }

        if (!image) {
            isValid = false;
            $("#image").after(`<small class="text-danger error-message">Profile image is required</small>`);
        }

        if (!isValid) {
            return;
        }

        let formData = new FormData(this);

        $.ajax({
            type: "POST",
            url: "ajax_handler.php",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        title: "Registration Successful!",
                        text: response.message,
                        icon: "success",
                        confirmButtonText: "OK"
                    }).then(() => {
                        window.location.href = "login.php";
                    });

                    $("#registerForm")[0].reset();
                    $("#imageContainer").html("");
                } else {
                    Swal.fire({
                        title: "Error!",
                        text: response.message,
                        icon: "error",
                        confirmButtonText: "OK"
                    });
                }
            }
        });
    });
});
