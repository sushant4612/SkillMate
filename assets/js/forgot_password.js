// forgot_password.js

document.getElementById('forgot-password-form').addEventListener('submit', function(event) {
    event.preventDefault();

    const username = document.getElementById('username').value;
    const email = document.getElementById('email').value;

    // Make an AJAX request to the forgot_password.php API endpoint
    fetch('../api/forgot_password.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ username, email }),
    })
    .then(response => response.text())
    .then(data => {
        // Handle the response from the server
        if (data.includes('success')) {
            window.location.href = '/views/reset_password.html';
            alert("hello");
        } else {
            alert(data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred. Please try again.');
    });
});

