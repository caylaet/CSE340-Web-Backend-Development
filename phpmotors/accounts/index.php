<?php
// this is the accunts controller

// Create or access a Session
session_start();

// Get the database connection file
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/connections.php';
// Get the PHP Motors model for use as needed
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/main-model.php';
// Get the accounts model
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/accounts-model.php';
// Get the reviews model
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/reviews-model.php';
// Get the functions library
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/functions.php';

ini_set('display_errors', 1);

// Get the array of classifications
$classifications = getClassifications();


// Build a navigation bar using the $classifications array
$navList = nav ($classifications);


$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
   $action = filter_input(INPUT_GET, 'action');
}
switch ($action){
   case 'registration':
      include '../view/registration.php';
      break;

   case 'login':
      include '../view/login.php';
      break;

   case 'register':
      // Filter and store the data
      $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname',  FILTER_SANITIZE_STRING));
      $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname',  FILTER_SANITIZE_STRING));
      $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
      $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING));

      $clientEmail = checkEmail($clientEmail);
      $checkPassword = checkPassword($clientPassword);
      
      $existingEmail = checkExistingEmail($clientEmail);


      // Check for existing email address in the table
      if($existingEmail){
         $message = '<p class="messageFormTop">That email address already exists. Do you want to login instead?</p>';
         $_SESSION['message'] = $message;
         include '../view/login.php';
         exit;
      }

      // Check for missing data
      if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)){
         $message = '<p class="messageFormTop">Please provide information for all empty form fields.</p>';
         include '../view/registration.php';
         exit; 
      }

      // Hash the checked password
      $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

      // Send the data to the model
      $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

      // Check and report the result
      if($regOutcome === 1){
         setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
         $message = "<p class='messageFormTop'> Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
         $_SESSION['message'] = $message;
         header('Location: /phpmotors/accounts/?action=login');
         exit;
      } else {
         $message = "<p class='messageFormTop'>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
         $_SESSION['message'] = $message;
         include '../view/registration.php';
         exit;
      }
      break;

   case 'Login':
      $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
      $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING));
      
      $clientEmail = checkEmail($clientEmail);
      $checkPassword = checkPassword($clientPassword);

      // Check for missing data
      if(empty($clientEmail) || empty($checkPassword)){
         $message = '<p class="messageFormTop">Please provide information for all empty form fields.</p>';
         include '../view/login.php';
         exit; 
      }
      // A valid password exists, proceed with the login process
      // Query the client data based on the email address
      $clientData = getClient($clientEmail);

      if(empty($clientData)){
         $message = '<p class="messageFormTop">That email is not in our database. Try creating an account instead.</p>';
         $_SESSION['message'] = $message;
         header('Location: /phpmotors/accounts/?action=login');
         // include '../view/login.php';
         exit; 
      }
      // Compare the password just submitted against
      // the hashed password for the matching client
      $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
      // If the hashes don't match create an error
      // and return to the login view
      if(!$hashCheck) {
      $message = '<p class="messageFormTop">Please check your password and try again.</p>';
      include '../view/login.php';
      exit;
      }
      // A valid user exists, log them in
      $_SESSION['loggedin'] = TRUE;
      // Remove the password from the array
      // the array_pop function removes the last
      // element from an array
      array_pop($clientData);
      // Store the array into the session
      $_SESSION['clientData'] = $clientData;
      // Send them to the admin view
      header('Location: /phpmotors/accounts/index.php');
      exit;
      break;

   case 'logout':
      unset($_SESSION['clientData']);
      unset($_SESSION['loggedIn']);
      session_destroy();
      header('Location: /phpmotors/index.php');
      break;

   case 'updateAccount':
      include '../view/client-update.php';
      break;

   case 'updateInfo':

      // Filter and store the data
      $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname',  FILTER_SANITIZE_STRING));
      $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname',  FILTER_SANITIZE_STRING));
      $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
      $clientId = trim(filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT));
      
      
      if( !$clientEmail == $_SESSION['clientData']['clientEmail']){
         $existingEmail = checkExistingEmail($clientEmail);
         // Check for existing email address in the table
         if($existingEmail){
            $messageInfo = '<p class="messageForm">An account with that email already exists. </p>';
            include '../view/client-update.php';
            exit;
         }
      }
      
      $clientEmail = checkEmail($clientEmail);

      // Check for missing data
      if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)){
         $messageInfo = '<p class="messageForm">Please provide information for all empty form fields.</p>';
         include '../view/client-update.php';
         exit; 
      }
      
      
      // Send the data to the model
      $updateOutcome = updateClient($clientFirstname, $clientLastname, $clientEmail, $clientId);

      
      // Check and report the result
      if($updateOutcome === 1){
         // Query the client data based on the client Id 
         $clientData = getClientById($clientId);
         // Remove the password from the array
         // the array_pop function removes the last
         // element from an array
         array_pop($clientData);
         //remove the current info from the session
         unset($_SESSION['clientData']);
         // Store the array of update info into the session
         $_SESSION['clientData'] = $clientData;
         //Set the session message
         $_SESSION['message'] = "<p class='message'>Updates to your account were successful</p>";
         header('Location: /phpmotors/accounts/index.php');
         exit;
      } 
      else {
         $messageInfo = "<p class='messageForm'>Sorry, but the update failed. Please try again.</p>";
         include '../view/client-update.php';
         exit;
      }
      break;

   case 'updatePassword':
      $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING));
      $clientId = trim(filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT));

      $checkPassword = checkPassword($clientPassword);
      
      if(empty($checkPassword)){
         $messagePassword = '<p class="messageForm">Please provide information for all empty form fields.</p>';
         include '../view/client-update.php';
         exit; 
      }
      // Hash the checked password
      $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);


      // Send the data to the model
      $reSetPasswordOutcome = reSetPassword($hashedPassword, $clientId);


      // Check and report the result
      if($reSetPasswordOutcome === 1){
         $_SESSION['message'] = "<p class='message'>Password changed successfully</p>";
         header('Location: /phpmotors/accounts/index.php');
         exit;
      } else {
         $messagePassword = "<p class='messageForm'>Sorry $clientFirstname, but changing the password failed. Please try again.</p>";
         include '../view/client-update.php';
         exit;
      }
      break;

   default:
      
      //If they are not logged in send them to the main page, this is caught here so the rest of the code can run smoothly.
      if(!isset($_SESSION['loggedin'])){
         header('Location: /phpmotors/index.php');
      }
      //Get the Client Id from the session.
      $clientId = $_SESSION['clientData']['clientId'];

      //Get the reviews of the client logged in by their id.
      $data = getReviewsByClientId($clientId);

      //If their are no reviews sends them to the view, if there are reviews builds the review display than sends them to the view.
      if(empty($data)){
         include '../view/admin.php';
         exit;
      }else{
         $clientReviewDisplay = buildClientReviewsDisplay($data);
         include '../view/admin.php';
         exit;
      }

   }
?>