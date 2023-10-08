document.addEventListener("DOMContentLoaded", function () {
    const loginForm = document.getElementById("login-form");
    const usernameInput = document.getElementById("username");
    const passwordInput = document.getElementById("password");
    const usernameError = document.getElementById("username-error");
    const passwordError = document.getElementById("password-error");

    usernameInput.addEventListener("input", validateUsername);
    passwordInput.addEventListener("input", validatePassword);

    function validateUsername() {
        const username = usernameInput.value.trim();
        if (username.length < 3) {
            usernameError.textContent = "Username must be at least 3 characters long.";
        } else {
            usernameError.textContent = "";
        }
    }

    function validatePassword() {
        const password = passwordInput.value.trim();
        if (password.length < 8) {
            passwordError.textContent = "Password must be at least 8 characters long.";
        } else {
            passwordError.textContent = "";
        }
    }

    loginForm.addEventListener("submit", function (event) {
        const username = usernameInput.value.trim();
        const password = passwordInput.value.trim();

        if (username.length < 3 || password.length < 8) {
            event.preventDefault(); // Prevent form submission if there are validation errors
            alert("Please fix the validation errors before submitting.");
        }
    });
});
