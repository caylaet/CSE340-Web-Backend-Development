<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="/phpmotors/css/main.css" media="screen">
  <title>Register | PHP Motors</title>
</head>
<body>

    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?> 

    <nav id="page_nav">
        <?php echo $navList;?> 
    </nav>
    <main class="form_view">
        <?php
            if (isset($message)) {
                echo $message;
            }
        ?>
        <h2 class="form_subHeader add_top_padding">*Note all Fields are required</h2>
        <form action="/phpmotors/accounts/index.php" method="post" autocomplete="on" required>
            <label for="clientFirstname" class="formLabel">First name:</label><br>
            <input name="clientFirstname" class="formInput" id="clientFirstname" type="text" autofocus required <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";}  ?> ><br>
            <label for="clientLastname" class="formLabel">Last name:</label><br>
            <input name="clientLastname" class="formInput" id="clientLastname" type="text" required <?php if(isset($clientLastname)){echo "value='$clientLastname'";} ?>><br>
            <label for="clientEmail" class="formLabel">Email:</label><br>
            <input name="clientEmail" class="formInput" id="clientEmail" type="email" required <?php if(isset($clientEmail)){echo "value='$clientEmail'";} ?> ><br>
            <label for="clientPassword" class="formLabel">Password:</label><br>
            <div class="span"><span>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span></div>
            <input name="clientPassword" class="formInput" id="clientPassword" type="text" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"><br><br>
            <input type="submit" name="submit" class="button" id="regbtn" value="Register">
            <input type="hidden" name="action" value="register">
        </form>
    </main>
    <footer>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    </footer>
</body>
</html>