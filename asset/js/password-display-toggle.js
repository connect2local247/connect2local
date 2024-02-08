$(document).ready(function() {
    // Toggle password visibility
    $("#togglePassword").click(function() {
        var passwordField = $("#password");
        var fieldType = passwordField.attr("type");

        // Toggle between 'text' and 'password' types
        passwordField.attr("type", fieldType === "password" ? "text" : "password");

        // Toggle eye icon based on password visibility
        $(this).toggleClass("fa-eye fa-eye-slash");
    });
});