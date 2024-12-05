document.addEventListener("DOMContentLoaded", function () {

    const passwordInput = document.getElementById("password");
    const confirmPasswordInput = document.getElementById("password-confirm");
    const errorMessage = document.createElement("small");

    errorMessage.style.color = "red";
    errorMessage.style.display = "none";
    errorMessage.textContent = "Le password non corrispondono.";

    confirmPasswordInput.parentElement.appendChild(errorMessage);

    function validatePasswords() {
        if (
            passwordInput.value &&
            confirmPasswordInput.value &&
            passwordInput.value !== confirmPasswordInput.value
        ) {
            errorMessage.style.display = "block";
        } else {
            errorMessage.style.display = "none";
        }
    }

    confirmPasswordInput.addEventListener("blur", validatePasswords);

    confirmPasswordInput.addEventListener("input", function () {
        errorMessage.style.display = "none";
    });
    passwordInput.addEventListener("input", function () {
        errorMessage.style.display = "none";
    });
});
