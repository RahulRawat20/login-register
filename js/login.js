$(document).ready(function() {
    $("#loginForm").submit(function(e) {
        e.preventDefault();
        
        var isValid = true;

        // Email validation
        if ($("#email").val().trim() === "") {
            $("#email").addClass("error");
            $("#emailError").text("Email is required.");
            isValid = false;
        } else {
            $("#email").removeClass("error");
            $("#emailError").text("");
        }

        // Password validation
        if ($("#password").val().trim() === "") {
            $("#password").addClass("error");
            $("#passwordError").text("Password is required.");
            isValid = false;
        } else {
            $("#password").removeClass("error");
            $("#passwordError").text("");
        }

        if (!isValid) return; // Stop form submission if validation fails

        $.ajax({
            type: "POST",
            url: "ajax_handler.php",
            data: $(this).serialize() + "&action=login",
            dataType: "json",
            success: function(response) {
                // Check the response status and show SweetAlert accordingly
                if (response.status === "success") {
                    // Success message with SweetAlert
                    Swal.fire({
                        icon: 'success',
                        title: 'Login Successful',
                        text: response.message,
                        
                    }).then(() => {
                        // Redirect to dashboard after success
                        window.location.href = "dashboard.php";
                    });
                } else {
                    // Error message with SweetAlert
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response.message,
                        showConfirmButton: true
                    });
                }
            }

        });
    });

    // Remove error on input
    $("#email, #password").on("input", function() {
        if ($(this).val().trim() !== "") {
            $(this).removeClass("error");
            $(this).next(".error-text").text("");
        }
    });
});