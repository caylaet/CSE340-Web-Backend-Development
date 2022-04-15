<?php 
if(!isset($_SESSION['loggedin'])){
    header('Location: /phpmotors/index.php');
}
?><!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="/phpmotors/css/main.css" media="screen">
  <title>User Account | PHP Motors</title>
</head>
<body>

    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?> 

    <nav id="page_nav">
        <?php //require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/nav.php';
         echo $navList;?> 
    </nav>
    <main>
        <h1 class="admin_header"><?php echo $_SESSION['clientData']['clientFirstname']." ". $_SESSION['clientData']['clientLastname'];?></h1>
        <div class="admin_view">
            <p>You are logged in.</p>
            <?php
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
            }
            ?>
            <ul>
                <li>First Name: <?php echo $_SESSION['clientData']['clientFirstname']; ?></li>
                <li>Last Name: <?php echo $_SESSION['clientData']['clientLastname']; ?></li>
                <li>Email: <?php echo $_SESSION['clientData']['clientEmail']; ?></li>
            </ul>

            <h2>Account Management</h2>
            <p class="subHeading">Use this link to update account information</p>
            <a href="http://localhost//phpmotors/accounts/index.php?action=updateAccount" class="subHeading">Update Account Information</a>

            <?php
                if((isset($_SESSION['loggedin'])) && ($_SESSION['clientData']['clientLevel'] > 1)){
                echo "<h2>Inventory Management</h2><p class='subHeading'>Use this link to manage the inventory</p><a href='http://localhost//phpmotors/vehicles/index.php' class='subHeading'>Vehicle Management</a>";}
            ?>
            <?php
            if(isset($clientReviewDisplay)){
                echo $clientReviewDisplay;
            }
            ?>


        </div>

    </main>
    <footer>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    </footer>
</body>
</html>
<?php unset($_SESSION['message']);?>