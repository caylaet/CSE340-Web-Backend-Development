<?php
// this is the vehicles controller

// Create or access a Session
session_start();

// Get the database connection file
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/connections.php';
// Get the PHP Motors model for use as needed
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/main-model.php';
// Get the Vehicles model
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/vehicles-model.php';
// Get the Image upload model
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/uploads-model.php';
// Get the functions library
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/functions.php';
//Get the reviews model
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/reviews-model.php';

ini_set('display_errors', 1);

// Get the array of classifications
$classifications = getClassifications();


// Build a navigation bar using the $classifications array
$navList = nav ($classifications);

// //Build a drop down of classifications
// $classList ='<label for="classificationId" class="formLabel">Choose a Classification:</label><br>';
// $classList .='<select id="classificationId" name="classificationId" class="formInput" required>';
// foreach ($classifications as $classification) {
//    $classList .='<option value='.$classification["classificationId"].'>'.$classification["classificationName"].'</option>';
// }
// $classList .='</select>';

// echo $navList;
// exit;

$action = trim (filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING));
 if ($action == NULL){
  $action = trim (filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING));
 }

switch ($action){
   
   case 'Addclassification':
      include "../view/add-classification.php";
      break;

   case 'vehicle':
      include "../view/add-vehicle.php";
      break;

   case 'addClassification':
      // Filter and store the data
      $classificationName = trim (filter_input(INPUT_POST, 'classificationName', FILTER_SANITIZE_STRING));

      $checkClassification = checkClassification($classificationName);
      // echo $checkClassification;
      // exit;

      // Check for missing data
      if(empty($checkClassification)){
         $message = "<p class='message'>*Please provide a classification name.</p>";
         include '../view/add-classification.php';
         exit; 
      }
      // Send the data to the model
      $classOutcome = addClass($classificationName);

      // Check and report the result
      if($classOutcome === 1){
         // header("Location: /phpmotors/vehicles/index.php");
         // include '../view/vehicle-management.php';
         include '../view/vehicle-management.php';
         exit;
      } else {

         $message = "<p class='message'>*Sorry adding $classificationName failed. Please try again.</p>";
         include '../view/add-classification.php';
         exit;
      }
      break;

   case 'addVehicle':
      // Filter and store the data
      $invMake = trim (filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING));
      $invModel = trim (filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING));
      $invDescription = trim (filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING));
      $invImage = trim (filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING));
      $invThumbnail = trim (filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING));
      $invPrice = trim (filter_input(INPUT_POST, 'invPrice', FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
      $invStock = trim (filter_input(INPUT_POST, 'invStock', FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
      $invColor = trim (filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING));
      $classificationId = trim (filter_input(INPUT_POST, 'classificationId',  FILTER_SANITIZE_STRING));
      
      // echo "$invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId";
      // exit;

      $checkStock = checkInt($invStock);
      $checkPrice = checkFloat($invPrice);
      $checkImage = checkImage($invImage);
      $checkThumbnail = checkImage($invThumbnail);
      // echo $checkStock;
      // echo $checkPrice;
      // echo $checkImage;
      // echo $checkThumbnail;
      // exit;
      
      // Check for missing data
      if(empty($invMake) || empty($invModel) || empty($invDescription) || empty($checkImage) || empty($checkThumbnail) || empty($checkPrice) || empty($checkStock) || empty($invColor) || empty($classificationId)){
         $message = "<p class='message'>*Please provide information for all empty form fields.</p>";
         include '../view/add-vehicle.php';
         exit; 
      }
      // Send the data to the model
      $vehicleOutcome = addVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId);

      // Check and report the result
      if($vehicleOutcome === 1){
         // $message = urlencode("Successfully added $invMake $invModel");
         // header("Location: /phpmotors/vehicles/index.php?Message=$message");

         $message = "<p class='message'>*Successfully added $invMake $invModel</p>";
         include '../view/add-vehicle.php';
         exit;

      } else {
         $message = "<p class='message'>*Sorry adding $invMake $invModel failed. Please try again.</p>";
         include '../view/add-vehicles.php';
         exit;
      }
      break;
   
   case 'updateVehicle':
      // Filter and store the data
      $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
      $invMake = trim (filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING));
      $invModel = trim (filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING));
      $invDescription = trim (filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING));
      $invImage = trim (filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING));
      $invThumbnail = trim (filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING));
      $invPrice = trim (filter_input(INPUT_POST, 'invPrice', FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
      $invStock = trim (filter_input(INPUT_POST, 'invStock', FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
      $invColor = trim (filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING));
      $classificationId = trim (filter_input(INPUT_POST, 'classificationId',  FILTER_SANITIZE_STRING));
      
      // echo "$invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId";
      // exit;

      $checkStock = checkInt($invStock);
      $checkPrice = checkFloat($invPrice);
      $checkImage = checkImage($invImage);
      $checkThumbnail = checkImage($invThumbnail);
      // echo $checkStock;
      // echo $checkPrice;
      // echo $checkImage;
      // echo $checkThumbnail;
      // exit;
      
      // Check for missing data
      if(empty($invMake) || empty($invModel) || empty($invDescription) || empty($checkImage) || empty($checkThumbnail) || empty($checkPrice) || empty($checkStock) || empty($invColor) || empty($classificationId)){
         $message = "<p class='message'>*Please provide information for all empty form fields.</p>";
         include '../view/vehicle-update.php';
         exit; 
      }
      // Send the data to the model
      $updateResult = updateVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId,$invId);

      // Check and report the result
      if($updateResult === 1){
         // $message = urlencode("Successfully added $invMake $invModel");
         // header("Location: /phpmotors/vehicles/index.php?Message=$message");

         $message = "<p class='message'>*Successfully updated $invMake $invModel</p>";
         $_SESSION['message'] = $message;
         header('location: /phpmotors/vehicles/');
         exit;

      } else {
         $message = "<p class='message'>*Sorry updated $invMake $invModel failed. Please try again.</p>";
         include '../view/vehicle-update.php';
         exit;
      }
      break;

   case 'getInventoryItems': 
      // Get the classificationId 
      $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT); 
      // Fetch the vehicles by classificationId from the DB 
      $inventoryArray = getInventoryByClassification($classificationId); 
      // Convert the array to a JSON object and send it back 
      echo json_encode($inventoryArray); 
      break;

   case 'mod':
      $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
      $invInfo = getInvItemInfo($invId);
      // print_r($invInfo);
      // exit;
      if(count($invInfo)<1){
         $message = 'Sorry, no vehicle information could be found.';
      }
      include '../view/vehicle-update.php';
      exit;
      break;

   case 'del':
      $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
      $invInfo = getInvItemInfo($invId);
      if (count($invInfo) < 1) {
            $message = 'Sorry, no vehicle information could be found.';
      }
      include '../view/vehicle-delete.php';
      exit;
      break;

   case 'deleteVehicle':
      // Filter and store the data
      $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
      $invMake = trim (filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING));
      $invModel = trim (filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING));
      

      // Send the data to the model
      $deleteResult = deleteVehicle($invId);

      // Check and report the result
      if($deleteResult === 1){
         // $message = urlencode("Successfully added $invMake $invModel");
         // header("Location: /phpmotors/vehicles/index.php?Message=$message");

         $message = "<p class='message'>*Successfully deleted $invMake $invModel</p>";
         $_SESSION['message'] = $message;
         header('location: /phpmotors/vehicles/');
         exit;

      } else {
         $message = "<p class='message'>*Sorry updated $invMake $invModel failed. Please try again.</p>";
         $_SESSION['message'] = $message;
         header('location: /phpmotors/vehicles/');
         exit;
      }
      break;

   case "classification":
      $classificationName = filter_input(INPUT_GET, 'classificationName', FILTER_SANITIZE_STRING);
      $vehicles = getVehiclesByClassification($classificationName);
      
      // print_r($vehicles) ;
      // exit;
      if(!count($vehicles)){
       $message = "<p class='notice'>Sorry, no $classificationName could be found.</p>";
      } else {
       $vehicleDisplay = buildVehiclesDisplay($vehicles);
      };
      // echo $vehicleDisplay;
      // exit;
      include '../view/classification.php';
      break;
      
   case 'fullView':
      
      $invId = trim(filter_input(INPUT_GET, 'vehicleId', FILTER_VALIDATE_INT));
      $vehicle = getInvItemDetails($invId);
      $thumbnails = getThumbnails($invId);
      // print_r($thumbnails);
      // exit;
      $reviews = getReviewsByInventoryId($invId);
      
      if(!count($vehicle)){
         $message = "<p class='message'>Sorry, no information could be found.</p>";
      } else {
         $vehicleDisplay = buildVehicleDisplay($vehicle);
      }
      if($reviews){
         $reviewDisplay = buildReviewsDisplay($reviews);
      }
      if($thumbnails){
         $thumbnailDisplay = buildThumbnailDisplay($thumbnails);
      }
      include '../view/vehicle-detail.php';
      break;
   
   default:
         $classificationList = buildClassificationList($classifications);
         include '../view/vehicle-management.php';
         break;

   }
?>