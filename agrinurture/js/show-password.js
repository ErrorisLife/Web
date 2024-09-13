// JavaScript for toggling the password visibility
const showPassCheckbox = document.getElementById('showpass');
const passwordInput = document.getElementById('password');

showPassCheckbox.addEventListener('change', function() {
    if (this.checked) {
        passwordInput.type = 'text';
    } else {
        passwordInput.type = 'password';
    }
});


