<?php
    if(!isset($_SESSION['loggedin']) or ($_SESSION['clientData']['clientLevel']  < 2)){
        header('Location: /phpmotors/index.php');
    }
?><?php
//Build a drop down of classifications
$classList ='<label for="classificationId" class="formLabel">Choose a Classification:</label><br>';
$classList .='<select id="classificationId" name="classificationId" class="formInput" required>';
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
  <title><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
		echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
	elseif(isset($invMake) && isset($invModel)) { 
		echo "Modify $invMake $invModel"; }?>Update Vehicle | PHP Motors</title>
</head>
<body>

    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?> 

    <nav id="page_nav">
        <?php //require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/nav.php';
         echo $navList;?> 
    </nav>
    <main class="form_view">
        <h1 class="form_header"><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
	echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
elseif(isset($invMake) && isset($invModel)) { 
	echo "Modify$invMake $invModel"; }?></h1>
        <h2 class="form_subHeader">*Note all Fields are required</h2>
        <?php
            if (isset($message)) {
                echo $message;
            }
        ?>
        <form action="/phpmotors/vehicles/index.php" method="post">
            <?php echo $classList;?><br>
            <label for="invMake" class="formLabel">Make:</label><br>
            <input name="invMake" class="formInput" id="invMake" type="text" autofocus required <?php if(isset($invMake)){echo "value='$invMake'";} elseif(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }?>><br>
            <label for="invModel" class="formLabel">Model:</label><br>
            <input name="invModel" class="formInput" id="invModel" type="text" required <?php if(isset($invModel)){echo "value='$invModel'";} elseif(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }?>><br>
            <label for="invDescription" class="formLabel">Description:</label><br>
            <textarea name="invDescription" class="formInput" id="invDescription" required> <?php if(isset($invDescription)){echo $invDescription;} elseif(isset($invInfo['invDescription'])) {echo $invInfo['invDescription']; }?> </textarea><br>
            <label for="invImage" class="formLabel">Image Path:</label><br>
            <div class="span">Only png or jpg are accepted</span></div>
            <input name="invImage" class="formInput" id="invImage" type="text" required <?php if(isset($invImage)){echo "value='$invImage'";} elseif(isset($invInfo['invImage'])) {echo "value='$invInfo[invImage]'"; }?>><br>
            <label for="invThumbnail" class="formLabel">Thumbnail Path:</label><br>
            <div class="span">Only png or jpg are accepted</span></div>
            <input name="invThumbnail" class="formInput" id="invThumbnail" type="text" required <?php if(isset($invThumbnail)){echo "value='$invThumbnail'";} elseif(isset($invInfo['invThumbnail'])) {echo "value='$invInfo[invThumbnail]'"; }?>><br>
            <label for="invPrice" class="formLabel">Price:</label><br>
            <input name="invPrice" class="formInput" id="invPrice" type="number" step="0.01" min=0 required <?php if(isset($invPrice)){echo "value='$invPrice'";} elseif(isset($invInfo['invPrice'])) {echo "value='$invInfo[invPrice]'"; }?>><br>
            <label for="invStock" class="formLabel">Stock:</label><br>
            <input name="invStock" class="formInput" id="invStock" type="number" min=0 required <?php if(isset($invStock)){echo "value='$invStock'";} elseif(isset($invInfo['invStock'])) {echo "value='$invInfo[invStock]'"; }?>><br>
            <label for="invColor" class="formLabel">Color:</label><br>
            <input name="invColor" class="formInput" id="invColor" type="text" required <?php if(isset($invColor)){echo "value='$invColor'";} elseif(isset($invInfo['invColor'])) {echo "value='$invInfo[invColor]'"; }?>><br><br>
            <input type="submit" name="submit" class="button" id="regbtn" value="Update Vehicle">
            <input type="hidden" name="action" value="updateVehicle">
            <input type="hidden" name="invId" value="<?php if(isset($invInfo['invId'])){ echo $invInfo['invId'];} elseif(isset($invId)){ echo $invId; } ?>">
        </form>
    </main>
    <footer>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    </footer>
</body>
</html>