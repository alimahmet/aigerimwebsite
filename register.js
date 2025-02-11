document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("registerForm");
    const password = document.getElementById("password");
    const confirmPassword = document.getElementById("confirm_password");
    const errorText = document.getElementById("passwordError");

    form.addEventListener("submit", function(event) {
        if (password.value !== confirmPassword.value) {
            event.preventDefault();
            errorText.style.display = "block";
        } else {
            errorText.style.display = "none";
        }
    });
});
