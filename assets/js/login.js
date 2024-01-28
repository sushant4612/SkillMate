function performLogin() {
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    // Perform AJAX request
    fetch('../api/login.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ username, password }),
    })
    .then(response => response.text())  // Use text() instead of json()
    .then(data => {
        console.log(data);  // Log the response
        // Handle the response from the server
        if (data.includes('success')) {
            alert('Login successful!');
        } else {
            alert('Invalid username or password.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred. Please try again.');
    });    
}

// Toggle password visibility when the "Show Password" checkbox is clicked
document.getElementById('show-password').addEventListener('change', function() {
    const passwordInput = document.getElementById('password');
    passwordInput.type = this.checked ? 'text' : 'password';
});