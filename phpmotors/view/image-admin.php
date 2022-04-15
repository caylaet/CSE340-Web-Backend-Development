<?php
    if (isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
    }
    if(!isset($_SESSION['loggedin']) or ($_SESSION['clientData']['clientLevel']  < 2)){
    header('Location: /phpmotors/index.php');
    }

?><!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="/phpmotors/css/main.css" media="screen">
  <title>Image Managment | PHP Motors</title>
</head>
<body>

    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>
     
    <nav id="page_nav">
        <?php //require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/nav.php';
         echo $navList;?> 
    </nav>
    <main>
        <h1 class="imgManagment_header">Image Managment</h1>
        <p class="info_header">Welcome <?php echo $_SESSION['clientData']['clientFirstname']." ". $_SESSION['clientData']['clientLastname'];?> please choose an option bellow</p>
        <h2 class="form_subHeader">Add New Vehicle Image</h2>
        <?php
        if (isset($message)) {
        echo $message;
        } ?>

        <form action="/phpmotors/uploads/index.php" method="post" enctype="multipart/form-data">
        <label  for="invItem">Vehicle</label>
            <?php echo $prodSelect; ?>
            <fieldset class="space">
                <label>Is this the main image for the vehicle?</label>
                <label for="priYes" class="pImage">Yes</label>
                <input type="radio" name="imgPrimary" id="priYes" class="pImage" value="1">
                <label for="priNo" class="pImage">No</label>
                <input type="radio" name="imgPrimary" id="priNo" class="pImage" checked value="0">
            </fieldset>
        <label>Upload Image:</label>
        <input class="space" type="file" name="file1"><br>
        <input type="submit" class="regbtn" value="Upload">
        <input type="hidden" name="action" value="upload">
        </form>
        <h2 class="form_subHeader">Existing Images</h2>
        <p class="info">If deleting an image, delete the thumbnail too and vice versa.</p>
        <?php
        if (isset($imageDisplay)) {
        echo $imageDisplay;
        } ?>
    </main>
    <footer>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    </footer>
</body>
</html>
<?php unset($_SESSION['message']); ?>