const togglePass = document.querySelector('#togglePass');
const togglePassword = document.querySelector('#togglePassword');
const inputPassword = document.querySelector('#inputPassword');

togglePass.addEventListener("click", () => {
    let type = inputPassword
        .getAttribute('type') === 'password' ? 'text' : 'password';
    inputPassword.setAttribute('type', type);
    togglePassword.classList.toggle('bi-eye');
})