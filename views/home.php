<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <!-- Stylesheet -->
    <link rel="stylesheet" href="../assets/css/home.css">
</head>
<body>
    <nav>
        <div class="container">
            <h2 class="logo">
                SkillMate
            </h2>
            <div class="search-bar">
               <img id="icon" src="../assets/images/icons/icons8-search-50.png"  alt="">
               <input type="search" placeholder="Search for connection">
            </div>
            <div class="create">
                <button id="logout-button" class="btn btn-primary">Logout</button>
            </div>
        </div>
    </nav>

    <!-- Form for creating a new post -->
    <div class="modal-overlay" id="modal-overlay">
        <div class="modal-content">
            <!-- Form for creating a new post -->
                <form id="post-form" action="../controllers/.php" method="post" enctype="multipart/form-data">
                    <label for="post-image">Choose an image to post</label>
                    <input type="file" name="post_image" id="post-image" accept="image/*" required>
                    <div id="image-error" class="error-message" style="display: none; color: red;"></div>
                    <textarea name="post_content" id="post-content" cols="30" rows="5" placeholder="Write your caption here" required></textarea>
                    <button id="add-post-btn">Add Post</button>
                </form>
                <!-- Close button for modal -->
                <span class="modal-close" id="modal-close">&times;</span>

        </div>
    </div>
    <!-------------------------------- MAIN ----------------------------------->
    <main>
        <div class="container">
            <!----------------- LEFT -------------------->
            <div class="left">
                <a class="profile">
                    <div class="profile-photo">
                        <!-- <img src="/> -->
                        <img src="" alt="">
                    </div>
                    <div class="handle">
                        <h4></h4>
                        <p class="text-muted">
                            <?php echo $_SESSION['username']; ?>
                        </p>
                    </div>
                </a>

                <!----------------- SIDEBAR -------------------->
                <div class="sidebar">
                    <a class="menu-item active">
                        <img src="../assets/images/icons/icons8-home-50.png" id="icon" style="padding-left: 20px;" alt="">
                        <!-- <span><i class="uil uil-home"></i></span> -->
                        <h3>Home</h3>   
                    </a>
                    <a class="menu-item"  id="notifications">
                        <img src="../assets/images/icons/icons8-notification-50.png" id="icon" style="padding-left: 20px;" alt="">
                        <h3>Notification</h3>
                        <!--------------- NOTIFICATION POPUP --------------->
                        <div class="notifications-popup">
                            <div>
                                <div class="profile-photo">
                                    <img src="">
                                </div>
                                <div class="notification-body">
                                    <b>Sushant</b> accepted your friend request
                                    <small class="text-muted">2 Days Ago</small>
                                </div>
                            </div>
                            <div>
                                <div class="profile-photo">
                                    <img src="">
                                </div>
                                <div class="notification-body">
                                    <b>Chetana</b> commented on your post
                                    <small class="text-muted">1 Hour Ago</small>
                                </div>
                            </div>
                            <div>
                                <div class="profile-photo">
                                    <img src="">
                                </div>
                                <div class="notification-body">
                                    <b>Vaibhavi</b> and <b>283 Others</b> liked your post
                                    <small class="text-muted">4 Minutes Ago</small>
                                </div>
                            </div>
                            <div>
                                <div class="profile-photo">
                                    <img src="">
                                </div>
                                <div class="notification-body">
                                    <b>Nishidha</b> commented on a post you are tagged in
                                    <small class="text-muted">2 Days Ago</small>
                                </div>
                            </div>
                            <div>
                                <div class="profile-photo">
                                    <img src="">
                                </div>
                                <div class="notification-body">
                                    <b>Vaishali</b> commented on a post you are tagged in
                                    <small class="text-muted">1 Hour Ago</small>
                                </div>
                            </div>
                            <div>
                                <div class="profile-photo">
                                    <img src="">
                                </div>
                                <div class="notification-body">
                                    <b>Rohit</b> commented on your post
                                    <small class="text-muted">1 Hour Ago</small>
                                </div>
                            </div>
                        </div>
                        <!--------------- END NOTIFICATION POPUP --------------->
                    </a>
                    <a class="menu-item" id="messages-notifications">
                        <img src="../assets/images/icons/icons8-messages-50.png" id="icon" style="padding-left: 20px;" alt="">
                        <h3>Messages</h3>
                    </a>
                    <a class="menu-item">
                        <img src="../assets/images/icons/icons8-safety-collection-place-50.png"  id="icon" style="padding-left: 20px;" alt="">
                        <h3>Network</h3>
                    </a>
                    <a class="menu-item" id="theme">
                        <img src="../assets/images/icons/icons8-theme-50.png" id="icon" style="padding-left: 20px;" alt="">
                        <h3>Theme</h3>
                    </a>
                </div>

                

                <!-- Button to toggle the visibility of the post creation form -->
                <label class="btn btn-primary" for="create-post" id="create-post-btn">Create Post</label>
            </div>

            <!----------------- MIDDLE -------------------->
            <div class="middle">
                
                <!----------------- FEEDS -------------------->

                

                <div class="feeds">
                    <!----------------- FEED 1 -------------------->
                </div>
            </div>
             <!----------------- END OF MIDDLE -------------------->

            <!----------------- RIGHT -------------------->
            <div class="right">
                <!------- MESSAGES ------->
                <div class="messages">
                    <div class="heading">
                        <h4></h4>
                        <i class="uil uil-edit"></i>
                    </div>
                    <!------- SEARCH BAR ------->
                    <div class="search-bar">
                        <i class="uil uil-search"></i>
                        <input type="search" placeholder="Search messages" id="message-search">
                    </div>
                    <!------- MESSAGES CATEGORY ------->
                    <div class="category">
                        <h6 class="active">Primary</h6>
                        <h6>General</h6>
                        <h6 class="message-requests">Requests (7)</h6>
                    </div>
                    <!------- MESSAGES ------->
                    <div class="message">
                        <div class="profile-photo">
                            <img src="">
                        </div>
                        <div class="message-body">
                            <h5>Vaishali Chavan</h5>
                            <p class="text-muted">Done with yesterday works</p>
                        </div>
                    </div>
                    <!------- MESSAGES ------->
                    <div class="message">
                        <div class="profile-photo">
                            <img src="">
                        </div>
                        <div class="message-body">
                            <h5>Vaibhavi Bondre</h5>
                            <p class="text-bold">2 new messages</p>
                        </div>
                    </div>
                    <!------- MESSAGES ------->
                    <div class="message">
                        <div class="profile-photo">
                            <img src="">
                            <div class="active"></div>
                        </div>
                        <div class="message-body">
                            <h5>Shreeram</h5>
                            <p class="text-muted">lol u right</p>
                        </div>
                    </div>
                    <!------- MESSAGES ------->
                    <div class="message">
                        <div class="profile-photo">
                            <img src="">
                        </div>
                        <div class="message-body">
                            <h5>Sahasi</h5>
                            <p class="text-muted">Birtday Tomorrow</p>
                        </div>
                    </div>
                    <!------- MESSAGES ------->
                    <div class="message">
                        <div class="profile-photo">
                            <img src="">
                            <div class="active"></div>
                        </div>
                        <div class="message-body">
                            <h5>Chetana Rane</h5>
                            <p class="text-bold">5 new messages</p>
                        </div>
                    </div>
                    <!------- MESSAGES ------->
                    <div class="message">
                        <div class="profile-photo">
                            <img src="">
                        </div>
                        <div class="message-body">
                            <h5>Aditya </h5>
                            <p class="text-muted">haha got that!</p>
                        </div>
                    </div>
                </div>
                <!------- END OF MESSAGES ------->

                <!------- FRIEND REQUEST ------->
                <div class="friend-requests">
                    <h4>Requests</h4>
                    <div class="request">
                        <div class="info">
                            <div class="profile-photo">
                                <img src="">
                            </div>
                            <div>
                                <h5>Amey</h5>
                                <p class="text-muted">8 mutual friends</p>
                            </div>
                        </div>
                        <div class="action">
                            <button class="btn btn-primary">
                                Accept
                            </button>
                            <button class="btn">
                                Decline
                            </button>
                        </div>
                    </div>
                    <div class="request">
                        <div class="info">
                            <div class="profile-photo">
                                <img src="">
                            </div>
                            <div>
                                <h5>Ruturaj</h5>
                                <p class="text-muted">2 mutual friends</p>
                            </div>
                        </div>
                        <div class="action">
                            <button class="btn btn-primary">
                                Accept
                            </button>
                            <button class="btn">
                                Decline
                            </button>
                        </div>
                    </div>
                    <div class="request">
                        <div class="info">
                            <div class="profile-photo">
                                <img src="">
                            </div>
                            <div>
                                <h5>Snehal</h5>
                                <p class="text-muted">5 mutual friends</p>
                            </div>
                        </div>
                        <div class="action">
                            <button class="btn btn-primary">
                                Accept
                            </button>
                            <button class="btn">
                                Decline
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!----------------- END OF RIGHT -------------------->
        </div>
    </main>

    <!----------------- THEME CUSTOMIZATION -------------------->
    <div class="customize-theme">
        <div class="card">
            <h2>Customize your view</h2>
            <p class="text-muted">Manage your font size, color, and background</p>

            <!----------- FONT SIZE ----------->
            <div class="font-size">
                <h4>Font Size</h4>
                <div>
                    <h6>Aa</h6>
                    <div class="choose-size">
                        <span class="font-size-1"></span>
                        <span class="font-size-2 active"></span>
                        <span class="font-size-3"></span>
                        <span class="font-size-4"></span>
                        <span class="font-size-5"></span>
                    </div>
                    <h3>Aa</h3>
                </div>
            </div>

            <!----------- PRIMARY COLORS ----------->
            <div class="color">
                <h4>Color</h4>
                <div class="choose-color">
                    <span class="color-1 active"></span>
                    <span class="color-2"></span>
                    <span class="color-3"></span>
                    <span class="color-4"></span>
                    <span class="color-5"></span>
                </div>
            </div>

            <!----------- BACKGROUND COLORS ----------->
            <div class="background">
                <h4>Background</h4>
                <div class="choose-bg">
                    <div class="bg-1 active">
                        <span></span>
                        <h5 for="bg-1">Light</h5>
                    </div>
                    <div class="bg-2">
                        <span></span>
                        <h5 for="bg-2">Dim</h5>
                    </div>
                    <div class="bg-3">
                        <span></span>
                        <h5 for="bg-3">Dark</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../assets/js/home.js"></script>
</body>
</html>