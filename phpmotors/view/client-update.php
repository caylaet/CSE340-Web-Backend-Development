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
  <title>Manage Account | PHP Motors</title>
</head>
<body>

    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?> 

    <nav id="page_nav">
        <?php echo $navList;?> 
    </nav>
    <main class="form_view">
        <h1 class="form_manageAccount_h1">Manage Account</h1>
        <h2 class="form_manageAccount_h2">Update Account</h2>
        <?php
            if (isset($messageInfo)) {
                echo $messageInfo;
            }
        ?>
        <form action="/phpmotors/accounts/index.php" method="post" autocomplete="on">
            <label for="clientFirstname" class="formLabel">First name:</label><br>
            <input name="clientFirstname" class="formInput" id="clientFirstname" type="text" autofocus required <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";} elseif(isset($_SESSION['clientData']['clientFirstname'])){echo "value=".$_SESSION['clientData']['clientFirstname'];}  ?> ><br>
            <label for="clientLastname" class="formLabel">Last name:</label><br>
            <input name="clientLastname" class="formInput" id="clientLastname" type="text" required <?php if(isset($clientLastname)){echo "value='$clientLastname'";} elseif(isset($_SESSION['clientData']['clientLastname'])){echo "value=".$_SESSION['clientData']['clientLastname'];} ?>><br>
            <label for="clientEmail" class="formLabel">Email:</label><br>
            <input name="clientEmail" class="formInput" id="clientEmail" type="email" required <?php if(isset($clientEmail)){echo "value='$clientEmail'";} elseif(isset($_SESSION['clientData']['clientEmail'])){echo "value=".$_SESSION['clientData']['clientEmail'];} ?> ><br><br>
            <input type="submit" name="submit" class="button" id="updatebtn" value="Update Info">
            <input type="hidden" name="action" value="updateInfo">
            <input type="hidden" name="clientId" value="<?php if(isset($_SESSION['clientData']['clientId'])){echo $_SESSION['clientData']['clientId'];}?>">
        </form>
        <h2 class="form_manageAccount_h2">Update Password</h2>
        <?php
            if (isset($messagePassword)) {
                echo $messagePassword;
            }
        ?>
        <div class="span"><span>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span></div>
        <p class="passwordNote">*note your original password will be changed</p>
        <form action="/phpmotors/accounts/index.php" method="post" autocomplete="on">
            <label for="clientPassword" class="formLabel">Password:</label><br>
            <input name="clientPassword" class="formInput" id="clientPassword" type="text" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"><br><br>
            <input type="submit" name="submit" class="button" id="newPassbtn" value="Update Password">
            <input type="hidden" name="action" value="updatePassword">
            <input type="hidden" name="clientId" value="<?php if(isset($_SESSION['clientData']['clientId'])){echo $_SESSION['clientData']['clientId'];}?>">
        </form>
    </main>
    <footer>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    </footer>
</body>
</html>