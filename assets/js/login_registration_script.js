var loginSubmitButton = document.querySelector(".submit-login");
var loginForm = document.querySelector('.login-form');

function login() {
    var xhr = new XMLHttpRequest();
    var loginFormData = new FormData(loginForm);

    xhr.addEventListener('load', (e) => {
        let response = xhr.responseText.split("|")[0];

        if (response.includes("True")) {
            window.location.href = "<?php echo site_url('frontoffice/acceuil'); ?>"
        } else {
            document.querySelector('.error-message').classList.toggle('active', true);
        }
    })

    xhr.open("post", "./loginRegister/login");
    xhr.send(loginFormData);
}

loginSubmitButton.addEventListener('click', (e) => {
    e.preventDefault();

    login();
})