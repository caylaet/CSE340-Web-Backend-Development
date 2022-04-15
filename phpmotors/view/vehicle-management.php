<?php
    if(!isset($_SESSION['loggedin']) or ($_SESSION['clientData']['clientLevel']  < 2)){
        header('Location: /phpmotors/index.php');
        exit;
    }
    if (isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
    }
?><!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="/phpmotors/css/main.css" media="screen">
  <title>Vehicle Management | PHP Motors</title>

</head>
<body>
    
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?> 
    
    <nav id="page_nav">
        <?php //require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/nav.php';
         echo $navList;?> 
    </nav>
    <main>
        <h1>Vehicle Management</h1>
        <div class="vehicleManagementView">
            <ul>
                <li><a class="largeLink" href="http://localhost//phpmotors/vehicles/index.php?action=Addclassification">Add Classification</a></li>
                <li><a class="largeLink" href="http://localhost//phpmotors/vehicles/index.php?action=vehicle">Add Vehicle</a></li>
            </ul>
            <?php
                if (isset($message)) { 
                echo $message; 
                } 
                if (isset($classificationList)) { 
                echo '<h2>Vehicles By Classification</h2>'; 
                echo '<p class="subHeading">Choose a classification to see those vehicles</p>'; 
                echo $classificationList; 
                }
            ?>
            <noscript>
            <p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
            </noscript>
            <table id="inventoryDisplay"></table>
        </div>
    </main>
    <footer>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    </footer>
    
    <script src="../js/inventory.js"></script>

</body>
</html>
<?php unset($_SESSION['message']); ?>
