// assets/js/signup.js

document.getElementById('signup-form').addEventListener('submit', async function (event) {
    // Reset previous error messages
    resetErrorMessages();
    event.preventDefault();
    // Validate username (letters only)
    const username = document.getElementById('username').value;

    const name = document.getElementById('name').value;

    if (!validateUsernameForNumber(name)) {
        showError('name', "Name shouldn't start with number.");
        event.preventDefault();
        return;
    }

    if (!validateUsernameForSymbol(name)) {
        showError('name', "Name shouldn't contain symbol in it.");
        event.preventDefault();
        return;
    }

    if (!validateUsernameForSymbol(username)) {
        showError('username', "Username shouldn't contain symbol in it.");
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

    if (!validatePassword(password)) {
        showError('password', 'Password must be at least 8 characters long and contain at least one capital letter and one digit.');
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

    const formData = new FormData(this);

    try {
        const response = await fetch('../api/signup.php', {
            method: 'POST',
            body: formData
        });

        const data = await response.json();

        if (data.status === 'success') {
            // Redirect to success.html after successful registration
            window.location.href = 'intrest.html';
        } else {
            // Display error message on the form
            if(data.message.includes("Email")){
                showError('email', data.message);
            }else{
                showError('username', data.message);
            }
            
        }
    } catch (error) {
        console.error('Error:', error);
    }
});

function validatePassword(password) {
    // Password should be at least 8 characters long
    // Should contain at least one capital letter
    // Should contain at least one digit

    const minLength = 8;
    const hasCapitalLetter = /[A-Z]/.test(password);
    const hasDigit = /\d/.test(password);

    return password.length >= minLength && hasCapitalLetter && hasDigit;
}

function validateUsernameForNumber(username) {
    const regex = /^[a-zA-Z][a-zA-Z]/;
    return regex.test(username);
}

function validateUsernameForSymbol(username) {
    const regex = /^[a-zA-Z0-9\s]+$/;
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

// Toggle password visibility when the "Show Password" checkbox is clicked
document.getElementById('show-password').addEventListener('change', function() {
    const passwordInput = document.getElementById('password');
    passwordInput.type = this.checked ? 'text' : 'password';
});

// Toggle confirm password visibility when the "Show Confirm Password" checkbox is clicked
document.getElementById('show-confirm-password').addEventListener('change', function() {
    const confirmPasswordInput = document.getElementById('confirm_password');
    confirmPasswordInput.type = this.checked ? 'text' : 'password';
});