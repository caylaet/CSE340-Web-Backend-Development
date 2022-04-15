<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="/phpmotors/css/main.css" media="screen">
  <title><?php echo $vehicle['invMake']." ".$vehicle['invModel']?> | PHP Motors</title>
</head>
<body>

    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>
     
    <nav id="page_nav">
        <?php //require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/nav.php';
         echo $navList;?> 
    </nav>
    <main>
        <h1 class="detail_header"><?php echo $vehicle['invMake']." ".$vehicle['invModel']?></h1>
        <p class="note"> *See reviews below</p>
        <div class="twoParts">
            <?php if(isset($vehicleDisplay)){
                echo $vehicleDisplay;
            } ?>
            <h2 class="thumbnail_header">Vechicle Thumbnails</h2>
            <?php if(isset($thumbnailDisplay)){
                echo $thumbnailDisplay;
            } ?>
        </div>
        <div>
            <h2 class="detail_reviews_header">Reviews</h2>
            <?php if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
            }
            else if (isset($message)) {
                echo $message;
            }
            ?>
            <?php if(!isset($_SESSION['loggedin'])){
                echo "<h3 class='write_review'>You must <a href='/phpmotors/accounts/?action=login'>login</a> to write a review</h3>";
            } 
            else {
                echo "<h2 class='detail_review_vehicle_name'>Review the ".$vehicle['invMake'].' '.$vehicle['invModel']."</h2>";
                echo "<form class='reviewForm' action='/phpmotors/reviews/index.php' method='post'>";
                echo "<label for='screenName'>Screen Name:</label><br>";
                echo "<input class='reviewScreenName' name='screenName' value =". substr($_SESSION['clientData']['clientFirstname'],0,1).$_SESSION['clientData']['clientLastname'] ." readonly><br>";
                echo "<label for='review'>Write a Review:</label><br>";
                echo "<textarea class='reviewTextarea' name='review' required></textarea><br>";
                echo "<input class='reviewButton' type='submit' name='submit' class='button' value='Submit Review'>";
                echo "<input type='hidden' name='action' value='addReview'>";
                echo "<input type='hidden' name='invId' value=".$vehicle['invId'].">";
                echo "<input type='hidden' name='clientId' value=".$_SESSION['clientData']['clientId'].">";
                echo "</form>";
            }
  
            ?>
        
        <?php if(isset($reviewDisplay)){
            echo $reviewDisplay;
        }else{
            echo "<h3 class='write_review'>Be the frist to write a review</h3>";
        } ?>
        </div>

    </main>
    <footer>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    </footer>
</body>
</html>
<?php unset($_SESSION['message']); ?>