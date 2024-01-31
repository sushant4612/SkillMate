// reset_password.js

document.getElementById('reset-password-form').addEventListener('submit', function(event) {
    event.preventDefault();

    const newPassword = document.getElementById('new-password').value;
    const confirmPassword = document.getElementById('confirm-password').value;

    // Make an AJAX request to the reset_password.php API endpoint
    fetch('../api/reset_password.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ newPassword, confirmPassword }),
    })
    .then(response => response.json())
    .then(data => {
        // Handle the response from the server
        if (data.status === 'success') {
            alert(data.message); // You can redirect the user or show a success message
        } else {
            alert(data.message); // Show an error message
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred. Please try again.');
    });
});
