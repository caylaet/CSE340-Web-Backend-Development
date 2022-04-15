<?php
    if(!isset($_SESSION['loggedin']) or ($_SESSION['clientData']['clientLevel']  < 2)){
        header('Location: /phpmotors/index.php');
    }
?><?php
//Build a drop down of classifications
$classList ='<label for="classificationId" class="formLabel">Choose a Classification:</label><br>';
$classList .='<select id="classificationId" name="classificationId" class="formInput" required disabled>';
foreach ($classifications as $classification) {
   $classList .="<option value='$classification[classificationId]'";
   if (isset($classificationId)){
       if($classification['classificationId'] === $classificationId){
           $classList .= ' selected ';
    }}
    elseif(isset($invInfo['classificationId'])){
        if($classification['classificationId'] === $invInfo['classificationId']){
         $classList .= ' selected ';
        }
    }
   $classList .= ">$classification[classificationName]</option>";
}
$classList .='</select>';

?><!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="/phpmotors/css/main.css" media="screen">
  <title><?php if(isset($invInfo['invMake'])){ 
	echo "Delete $invInfo[invMake] $invInfo[invModel]";} ?> Delete Vehicle | PHP Motors</title>
</head>
<body>

    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?> 

    <nav id="page_nav">
        <?php //require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/nav.php';
         echo $navList;?> 
    </nav>
    <main class="form_view">
        <h1 class="form_header"><?php if(isset($invInfo['invMake'])){ 
	echo "Delete $invInfo[invMake] $invInfo[invModel]";} ?></h1>
        <h2 class="form_subHeader">Confirm Vehicle Deletion. The delete is permanent.</h2>
        <?php
            if (isset($message)) {
                echo $message;
            }
        ?>
        <form action="/phpmotors/vehicles/index.php" method="post">
            <?php echo $classList;?><br>
            <label for="invMake" class="formLabel">Make:</label><br>
            <input name="invMake" class="formInput" id="invMake" type="text" autofocus readonly <?php if(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }?>><br>
            <label for="invModel" class="formLabel">Model:</label><br>
            <input name="invModel" class="formInput" id="invModel" type="text" readonly <?php if(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }?>><br>
            <label for="invDescription" class="formLabel">Description:</label><br>
            <textarea name="invDescription" class="formInput" id="invDescription" readonly> <?php if(isset($invInfo['invDescription'])) {echo $invInfo['invDescription']; }?> </textarea><br>
            <input type="submit" name="submit" class="button" id="regbtn" value="Delete Vehicle">
            <input type="hidden" name="action" value="deleteVehicle">
            <input type="hidden" name="invId" value="<?php if(isset($invInfo['invId'])){ echo $invInfo['invId'];} ?>">
        </form>
    </main>
    <footer>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    </footer>
</body>
</html>