document.addEventListener("DOMContentLoaded", function () {

    const passwordInput = document.getElementById("password");
    const confirmPasswordInput = document.getElementById("password-confirm");
    const errorMessagePassword = document.createElement("small");
    const errorMessageNumber = document.createElement("small");
    const validateNumberMessage = document.getElementById("vat_number")

    errorMessageNumber.style.color = "red";
    errorMessageNumber.style.display = "none";
    errorMessageNumber.textContent = "La P.IVA non può contenere lettere";

    validateNumberMessage.parentElement.appendChild(errorMessageNumber);


    errorMessagePassword.style.color = "red";
    errorMessagePassword.style.display = "none";
    errorMessagePassword.textContent = "Le password non corrispondono.";

    confirmPasswordInput.parentElement.appendChild(errorMessagePassword);

    function validatePasswords() {
        if (
            passwordInput.value &&
            confirmPasswordInput.value &&
            passwordInput.value !== confirmPasswordInput.value
        ) {
            errorMessagePassword.style.display = "block";
        }
        // else {
        //     errorMessage.style.display = "none";
        // }
    }

    confirmPasswordInput.addEventListener("blur", validatePasswords);

    confirmPasswordInput.addEventListener("input", function () {
        errorMessagePassword.style.display = "none";
    });
    passwordInput.addEventListener("input", function () {
        errorMessagePassword.style.display = "none";
    });

    function validateNumber(){
        if (isNaN(validateNumberMessage)) {
            errorMessageNumber.style.display = "block";
        }
    }

    validateNumberMessage.addEventListener("blur" , validateNumber);

    validateNumberMessage.addEventListener("input", function () {
        errorMessageNumber.style.display = "none";
    });
});
