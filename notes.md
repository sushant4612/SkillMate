## File Structure for our project

```lua
project-root/
|-- assets/
|   |-- css/
|   |-- js/
|   |-- images/
|
|-- includes/
|   |-- db_connection.php
|
|-- models/
|   |-- UserModel.php
|
|-- views/
|   |-- signup.html
|
|-- controllers/
|   |-- SignupController.php
|
|-- api/
|   |-- signup.php
|
|-- index.php
|-- README.md
```

### Database Connection (includes/db_connection.php)

- Contains the PHP code to connect to the database using pg_connect

### User Model (models/UserModel.php)

- Represents the model for the users table, encapsulating database interactions related to users.
- Contains methods for checking if a username is taken and creating a new user in the database.

### Signup Controller (controllers/SignupController.php)

- Handles the logic for user signup, including input validation, checking for duplicate usernames, hashing passwords, and inserting user data into the database.

### Signup Form (views/signup.html)

- Provides the HTML structure for the signup form that users interact with on the frontend
- HTML form elements for capturing user input (username, password, etc.)

### Signup JavaScript (assets/js/signup.js)

- Implements client-side validation using JavaScript before submitting the signup form.
