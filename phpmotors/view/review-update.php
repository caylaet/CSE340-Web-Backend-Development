
<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="/phpmotors/css/main.css" media="screen">
  <title>Update Review | PHP Motors</title>
</head>
<body>

    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>
     
    <nav id="page_nav">
        <?php //require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/nav.php';
         echo $navList;?> 
    </nav>
    <main>
        <?php
            if (isset($message)) {
                echo $message;
            }
            elseif (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
            }
        ?>
        <h1 class="form_header"> <?php if(isset($review['invMake']) && isset($review['invModel'])){echo $review['invMake'] ." ". $review['invModel']." Review";}?></h1>

        <h2 class="form_subHeader">Reviewed on <?php  echo $date;?></h2>
        <form  class="reviewForm" action='/phpmotors/reviews/index.php' method='post'>
            <label for='reviewText'>Edit Review Text:</label><br>
            <textarea class="reviewTextarea" name='reviewText' id='reviewText' required> <?php if(isset($review['reviewText'])) {echo $review['reviewText'];}?> </textarea><br>
            <input type='submit' name='submit' class='reviewButton' value='Edit Review'>
            <input type='hidden' name='action' value='editReview'>
            <input type='hidden' name='reviewId' value=<?php echo $review['reviewId']?>>
            <input type='hidden' name='invMake' value=<?php echo $review['invMake']?>>
            <input type='hidden' name='invModel' value=<?php echo $review['invModel']?>>

        </form>

    </main>
    <footer>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    </footer>
</body>
</html>
<?php unset($_SESSION['message']);?>
