<?php 
if(isset($_SESSION['loggedin'])){
    echo '<header class="logout"><img src="/phpmotors/images/site/logo.png" class="logo" alt="PHP logo, a cricle with lines following it">';
    echo "<a href='/phpmotors/accounts/index.php' class='user_name'>" . $_SESSION['clientData']['clientFirstname'] . " | </a><a href='http://localhost//phpmotors/accounts/index.php?action=logout' class='myAccount_logout'> &nbsp; Logout</a></header>";
}
if(!isset($_SESSION['loggedin'])){
  echo  '<header class="my_account"><img src="/phpmotors/images/site/logo.png" class="logo" alt="PHP logo, a cricle with lines following it"><a href="http://localhost//phpmotors/accounts/index.php?action=login" class="myAccount_logout">My Account</a></header>';
}
?>
