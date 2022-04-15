<?php
//Reviews Controller
session_start();

// Get the database connection file
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/connections.php';
// Get the PHP Motors model for use as needed
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/main-model.php';
// Get the functions library
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/functions.php';
//Get the reviews model
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/reviews-model.php';

ini_set('display_errors', 1);

// Get the array of classifications
$classifications = getClassifications();

// Build a navigation bar using the $classifications array
$navList = nav ($classifications);

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if ($action == NULL) {
 $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
}
switch ($action){
    case 'addReview':
        $invId = trim(filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT));
        $clientId = trim(filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT));
        $review = trim(filter_input(INPUT_POST, 'review', FILTER_SANITIZE_STRING));


        $result = addReview($review,$invId,$clientId);

        // Check and report the result
        if($result === 1){
            $message = "<p class='message'>Thank you for the review, it is displayed below.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/?action=fullView&vehicleId='.urlencode($invId));
            exit;

        } else {
            $message = "<p class='message'>Sorry adding the review failed. Please try again.</p>";
            include "../view/vehicle-detail.php";
            exit;
        }
        break;


    case 'viewEditReview':
        $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_VALIDATE_INT);
        $review = getReviewByReviewId($reviewId);

        if(empty($review)){
            $message = 'Sorry, no information on that review could be found.';
            $_SESSION['message'] = $message;
            header('location: /phpmotors/reviews/');
            exit;
        }
        $timestamp = strtotime($review['reviewDate']); 
        $date = date("d F\, Y",$timestamp);
        include "../view/review-update.php";
        break;

    case 'editReview':
        $reviewId = trim(filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT));
        $reviewText = trim(filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING));
        $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING));
        $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING));


        if(empty($reviewText)){
            $message = "<p class='message'>*Please fill out the review before submitting.</p>";
            $_SESSION['message'] = $message;
            header("Refresh:0 url=?action=viewEditReview&reviewId=".urlencode($reviewId));
            exit; 
        }
        
         $updateResult = updateReview($reviewText, $reviewId);

        if($updateResult === 1){
            $message = "<p class='message'>*Successfully updated $invMake $invModel review</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/reviews/');
            exit;

        } else {
            $message = "<p class='message'>*Sorry updating $invMake $invModel review failed. Please try again.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/reviews/');
            exit;
        }
        break;

    case 'deleteReview':
        $reviewId = trim(filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT));
        $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING));
        $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING));

        $deleteResult = deleteReview($reviewId);


        if($deleteResult === 1){
            $message = "<p class='message'>*Successfully deleted $invMake $invModel</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/reviews/');
            exit;

        } else {
            $message = "<p class='message'>*Sorry deleting $invMake $invModel failed. Please try again.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/reviews/');
            exit;
        }
        break;

    case 'viewDeleteReview':
        $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_VALIDATE_INT);
        $review = getReviewByReviewId($reviewId);
        if(empty($review)){
           $message = 'Sorry, no information on that review could be found.';
           $_SESSION['message'] = $message;
           header('location: /phpmotors/reviews/');
           exit;
        }
        include "../view/review-delete.php";
        break;

    default:
        header('location: /phpmotors/accounts/');
        break;
}



?>