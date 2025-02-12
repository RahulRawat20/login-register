$(document).ready(function() {
    // Fetch Logged-in User Details
    $("#getLoggedInUser").click(function() {
        $.ajax({
            type: "POST",
            url: "ajax_handler.php",
            data: { action: "get_logged_in_user" },
            dataType: "json",
            success: function(response) {
                if (response.error) {
                    $("#dataDisplay").html(`<div class="alert alert-danger">${response.error}</div>`);
                } else {
                    $("#dataDisplay").html(`
                        <h4>Logged-in User Details</h4>
                        <p><strong>ID:</strong> ${response.id}</p>
                        <p><strong>Name:</strong> ${response.firstname} ${response.lastname}</p>
                        <p><strong>Email:</strong> ${response.email}</p>
                        <p><strong>DOB:</strong> ${response.dob}</p>
                        <p><strong>Gender:</strong> ${response.gender}</p>
                        <img src="${response.image}" alt="User Image" width="100">
                    `);
                }
            }
        });
    });

    // Fetch All Users
    $("#getAllUsers").click(function() {
        $.ajax({
            type: "POST",
            url: "ajax_handler.php",
            data: { action: "get_users" },
            dataType: "json",
            success: function(response) {
                let table = `<h4>All Users</h4>
                    <table class='table table-striped'>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>DOB</th>
                            <th>Gender</th>
                            <th>Image</th>
                        </tr>`;
                response.forEach(user => {
                    table += `<tr>
                        <td>${user.id}</td>
                        <td>${user.firstname} ${user.lastname}</td>
                        <td>${user.email}</td>
                        <td>${user.dob}</td>
                        <td>${user.gender}</td>
                        <td><img src="${user.image}" width="50"></td>
                    </tr>`;
                });
                table += `</table>`;
                $("#dataDisplay").html(table);
            }
        });
    });

    // Logout
    $("#logoutBtn").click(function() {
        $.ajax({
            type: "POST",
            url: "ajax_handler.php",
            data: { action: "logout" },
            dataType: "json",
            success: function(response) {
                alert(response.message);
                window.location.href = "login.php";
            }
        });
    });
});