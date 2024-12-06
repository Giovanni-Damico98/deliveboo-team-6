document.addEventListener("DOMContentLoaded", function () {

    const passwordInput = document.getElementById("password");
    const confirmPasswordInput = document.getElementById("password-confirm");
    const errorMessagePassword = document.createElement("small");
    const errorMessageNumber = document.createElement("small");
    const validateNumberMessage = document.getElementById("vat_number")

    //messaggio di errore per le password
    errorMessagePassword.style.color = "red";
    errorMessagePassword.style.display = "none";
    errorMessagePassword.textContent = "Le password non corrispondono.";

    confirmPasswordInput.parentElement.appendChild(errorMessagePassword);

    //messaggio di errore per la P.IVA
    errorMessageNumber.style.color = "red";
    errorMessageNumber.style.display = "none";
    errorMessageNumber.textContent = "La P.IVA non può contenere lettere";

    validateNumberMessage.parentElement.appendChild(errorMessageNumber);


    //fuction Password
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




    //fuction P.IVA
    function validateNumber(){
        if (isNaN(validateNumberMessage.value)) {
            errorMessageNumber.style.display = "block";
        }
    }

    validateNumberMessage.addEventListener("blur" , validateNumber);

    validateNumberMessage.addEventListener("input", function () {
        errorMessageNumber.style.display = "none";
    });


    const button = document.getElementById("show-categories-btn");
    const categoriesContainer = document.getElementById("categories-container");

    button.addEventListener("click", function () {
        categoriesContainer.classList.toggle("d-none");
    });
});
