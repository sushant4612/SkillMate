<?php
  session_start();

  if (!isset($_SESSION['uid']) || empty($_SESSION['uid'])) {
    // Session does not contain anything, redirect to 404 error page
    header("HTTP/1.0 404 Not Found");
    header("Location: /404-error-page.php");
    exit(); // Make sure to exit after redirecting
}


  include("../controllers/LoadRecommendation.php");
  include("../controllers/ChatMessageController.php");
  include("../api/friendRequest.php");
  include('../includes/db_connection.php');
  include("../api/Profile.php");

  $profile = new Profile();
  $chatMessageModel = new ChatMessageModel($db);
  $chatMessageController = new ChatMessageController($chatMessageModel);
  $friendChatMessages = $chatMessageController->getFriendChatMessages($userId);
  $profilePath = $profile->showProfile($userId);
  if($profilePath == ''){
    $profilePath = "../assets/images/icons/user.png";
  }
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
<body id = "body">
    <script>
        // Set a JavaScript variable with the user ID from PHP
        const userId = <?php echo $_SESSION['uid']; ?>;
    </script>

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

    <div id="chat-popup" class="chat-popup">
        
        <div class="chat-popup-header">
            <span id="popup-sender-name" class="sender-name"></span>
            <span class="close-popup" onclick="closePopup()">&times;</span>
        </div>
        <div id="popup-messages" class="chat-popup-messages"></div>
        <textarea id="popup-message-input" class="chat-popup-input" placeholder="Type a message..."></textarea>
        <button onclick="sendMessage(<?php echo $_SESSION['uid']; ?>)" class="send-button">Send</button>
    </div>

    <!-- Form for creating a new post -->
    <div class="modal-overlay" id="modal-overlay">
        <div class="modal-content">
            <!-- Form for creating a new post -->
                <form id="post-form" action="../api/add_post.php" method="post" enctype="multipart/form-data">
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

    <div id="profilePopup" class="popup">
        <div class="popup-content">
            <span class="close" id="closePopup">&times;</span>
            <!-- Profile photo upload form -->
            <form id="profileForm" action="../api/upload_profile_photo.php" method="post" enctype="multipart/form-data">
                <!-- Label with user image -->
                <label for="profilePhotoInput" class="file-upload-label">
                    <!-- User image placeholder -->
                    <img src="<?php echo  $profilePath; ?>" alt="User Image">
                    <!-- Text indicating to choose a profile photo -->
                    Choose a profile photo
                </label>
                <!-- File input -->
                <input type="file" name="profilePhoto" id="profilePhotoInput" class="file-upload-input" accept="image/*">
                <!-- Error message container -->
                <div id="profilePhotoError" class="error-message" style="display: none;"></div>
                <!-- Submit button -->
                <button type="submit">Upload Profile Photo</button>
            </form>
            <!-- Edit interests form -->
            <form action="edit_interests.php" method="post">
                <!-- Display user interests here -->
                <!-- Provide input fields or checkboxes for editing interests -->
                <button type="submit">Save Interests</button>
            </form>
        </div>
    </div>



    <!-- Overlay to dim the background -->
    <div class="popup-overlay" id="popupOverlay"></div>
    </div>
    <!-------------------------------- MAIN ----------------------------------->
    <main>
        <div class="container">
            <!----------------- LEFT -------------------->
            <div class="left">
                <a id = "editProfileBtn" class="profile">
                    <div class="profile-photo">
                        <!-- <img src="/> -->
                        <img src="<?php echo $profilePath?>" alt="">
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
                    <!-- Heading for the chat section -->
                    <div class="heading">
                        <h4>Chat Messages</h4>
                        <i class="uil uil-edit"></i>
                    </div>
                    
                    <!-- Search bar for filtering messages -->
                    <div class="search-bar">
                        <i class="uil uil-search"></i>
                        <input type="search" placeholder="Search messages" id="message-search">
                    </div>
                    
                    <!-- Category section for different types of messages -->
                    <div class="category">
                        <h6 class="active">General</h6>
                        <!-- Add more categories if needed -->
                    </div>
                    
                    <!-- Display chat messages here -->
                    <?php 
                        $displayedUsernames = array(); // Array to store displayed usernames
                        foreach ($friendChatMessages as $message): 
                            // Determine the username to display based on the sender's and receiver's IDs
                            $username = ($message['sender_id'] == $userId) ? $message['receiver_username'] : $message['sender_username'];
                            // Check if the username has already been displayed
                            if (!in_array($username, $displayedUsernames)):
                                // Add the username to the array of displayed usernames
                                $displayedUsernames[] = $username;
                        ?>
                        <script>
                            var receiver_id = $message['sender_id'];
                        </script>
                            <div class="message" onclick="openChatPopup(<?php echo $_SESSION['uid']; ?>, '<?php echo $message['sender_id']; ?>')">
                                <div class="profile-photo">
                                    <img src="<?php echo $friendChatMessages[0]['profile_photo']; ?>">
                                </div>
                                <div class="message-body">
                                    <!-- Display the username -->
                                    <h5><?php echo $username; ?></h5>
                                    <!-- Display the message content -->
                                    <p class="text-muted"><?php echo $message['content']; ?></p>
                                </div>
                            </div>
                        <?php 
                            endif;
                        endforeach; 
                        ?>
                </div>

                <!------- END OF MESSAGES ------->

                <!-- Friend Requests Section -->
                    <div class="friend-requests">
                        <h4>Requests</h4>
                        <?php 
                            // Initialize an empty array to store unique usernames
                            $uniqueUsernames = array(); 
                        ?>
                        <?php if (!empty($requests)): ?>
                            <?php foreach ($requests as $request): ?>
                                <?php 
                                    // Check if the username is already present in the uniqueUsernames array
                                    if (!in_array($request['username'], $uniqueUsernames)): 
                                        // If not, add it to the array and display the request
                                        $uniqueUsernames[] = $request['username']; 
                                        $uniqueUsernames[] = $request['profile_photo']; 
                                ?>
                                <div class="request">
                                    <div class="info">
                                        <div class="profile-photo">
                                            <img src="<?php echo $request['profile_photo']; ?>">
                                        </div>
                                        <div>
                                            <h5><?php echo $request['username']; ?></h5>
                                            <p class="text-muted">8 mutual friends</p>
                                        </div>
                                    </div>
                                    <div class="action">
                                        <form action="" method="post">
                                            <input type="hidden" name="request_id" value="<?php echo $request['request_id']; ?>">
                                            <button type="submit" class="btn btn-primary" name="accept_request">Accept</button>
                                            <button type="submit" class="btn" id = "decline" name="decline_request">Decline</button>
                                        </form>
                                    </div>
                                </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>No friend requests</p>
                        <?php endif; ?>
                    </div>
                <?php
                    if (!empty($recommendations)) {
                        // Initialize an empty array to store unique user IDs with their counts
                        $uniqueRecommendations = array();

                        // Iterate through recommendations to count unique occurrences
                        foreach ($recommendations as $recommendation) {
                            $userId = $recommendation['user_id'];
                            
                            // Check if the user ID exists in the uniqueRecommendations array
                            if (isset($uniqueRecommendations[$userId])) {
                                // If it exists, increment the count
                                $uniqueRecommendations[$userId]['count']++;
                            } else {
                                // If it doesn't exist, add it to the array with count 1
                                $uniqueRecommendations[$userId] = array(
                                    'user_id' => $userId,
                                    'username' => $recommendation['username'],
                                    'count' => 1,
                                    'profile_photo' => $recommendation["profile_photo"]
                                );
                            }
                        }

                        // Print the unique recommendations
                        ?>
                        <div class="recommendation">
                            <h4>Recommendations</h4>
                            <?php foreach ($uniqueRecommendations as $recommendation): ?>
                                <div class="recommend">
                                    <div class="info">
                                        <div class="profile-photo">
                                            <img src="<?php echo $recommendation["profile_photo"]?>">
                                        </div>
                                        <div>
                                            <h5><?php echo $recommendation['username']; ?></h5>
                                            <br>
                                            <p class="text-muted">You have  <?php echo $recommendation['count']; ?> similar intrests</p>
                                        </div>
                                    </div>
                                    <div class="action">
                                        <form action="" method="post">
                                            <input type="hidden" name="receiver_id" value="<?php echo $recommendation['user_id']; ?>">
                                            <button type="submit" id = "sendrequest" class="btn btn-primary" name="send_request">Send Request</button>
                                        </form>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php
                    } 
                    ?>
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
    <script src ="../assets/js/request.js"></script>
    <script src="../assets/js/home.js"></script>
</body>
</html>