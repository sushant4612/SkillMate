<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/index.css">
    <title>SkillMate</title>
</head>
<body>
    <?php
        // Include the database connection script
        include('./includes/db_connection.php');
        // Rest of your signup.php code goes here
    ?>


    <header>
        <h1>SkillMate</h1>
        <section class="menu">

            <label class="switch">
                <input type="checkbox" id="theme-toggle">
                <span class="slider"></span>
            </label>

            <ul class="menu-list">
                <a id="login-button" href="views/login.html">Login</a>
            </ul>
            
            <button>
                <i class="fas fa-times"></i>
                <i class="fas fa-bars"></i>
            </button>
        </section>
    </header>    

    <section class="main">

            <section class="left">
                <p class="title">Match Learn Trive</p>
                <p class="msg">SkillMate is a user-friendly platform where individuals can explore and enhance various skills. Offering diverse learning opportunities, it connects learners with expert-driven content for a personalized skill development journey.</p>
                <button class="cta">Create Account</button>
            </section>

            <section class="right">
                <img src="/assets/images/img.svg" alt="Landing Image">
            </section>

    </section>
    <script src="/assets/js/index.js"></script>
</body>
</html>