<?php
    if(!isset($_SESSION['loggedin']) or ($_SESSION['clientData']['clientLevel']  < 2)){
        header('Location: /phpmotors/index.php');
    }
?><!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="/phpmotors/css/main.css" media="screen">
  <title>Add Classification | PHP Motors</title>
</head>
<body>

    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?> 

    <nav id="page_nav">
        <?php //require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/nav.php';
         echo $navList;?> 
    </nav>
    <main class="form_view">
        <h1 class="form_header">Add Car Classification</h1>
        <?php
            if (isset($message)) {
                echo $message;
            }
        ?>
        <form action="/phpmotors/vehicles/index.php" method="post">
            <label for="classificationName" class="formLabel">Classification Name:</label><br>
            <div class="span"><span>Can be no longer than 30 characters</span></div>
            <input name="classificationName" class="formInput" id="classificationName" type="text"  autofocus maxlength="30" required><br><br>
            <input type="submit" name="submit" class="button" id="addClassbtn" value="Add Classification">
            <input type="hidden" name="action" value="addClassification">
        </form>
    </main>
    <footer>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    </footer>
</body>
</html>