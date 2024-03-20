<?php
// LoadRecommendation.php
include('../includes/db_connection.php');
include('../models/UserModel.php');

$userModel = new UserModel($db);
$userId = $_SESSION['uid']; // Assuming you have the user ID in the session

$requests = $userModel->getFriendRequests($userId);
$recommendations = $userModel->getRecommendations($userId);
// Pass data to the view
?>