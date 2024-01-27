// assets/js/signup.js

document.getElementById('signup-form').addEventListener('submit', function (event) {
    // Reset previous error messages
    resetErrorMessages();

    // Validate username (letters only)
    const username = document.getElementById('username').value;
    if (!validateUsername(username)) {
        showError('username', 'Username must contain only letters.');
        event.preventDefault();
        return;
    }

    // Validate password match
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm_password').value;
    if (password !== confirmPassword) {
        showError('password', 'Passwords do not match.');
        event.preventDefault();
        return;
    }

    // Validate email format
    const email = document.getElementById('email').value;
    if (!validateEmail(email)) {
        showError('email', 'Invalid email format.');
        event.preventDefault();
        return;
    }

    // Validate age (numeric)
    const age = document.getElementById('age').value;
    if (!validateAge(age)) {
        showError('age', 'Age must be a number.');
        event.preventDefault();
        return;
    }
});

function validateUsername(username) {
    const regex = /^[a-zA-Z]+$/;
    return regex.test(username);
}

function validateEmail(email) {
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regex.test(email);
}

function validateAge(age) {
    return !isNaN(age) && parseInt(age) > 0;
}

function showError(fieldId, errorMessage) {
    document.getElementById(`${fieldId}-error`).innerText = errorMessage;
}

function resetErrorMessages() {
    const errorMessages = document.querySelectorAll('.error-message');
    errorMessages.forEach(message => message.innerText = '');
}
