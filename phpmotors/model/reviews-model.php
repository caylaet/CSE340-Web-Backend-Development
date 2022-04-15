<?php
//Reviews Model


//Handles adding a new Review
function addReview($reviewText,$invId,$clientId){
    $db = phpmotorsConnect();
    $sql = 'INSERT INTO reviews (reviewText,invId,clientId)
        VALUES (:reviewText, :invId, :clientId)';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}

//Retrieves all the reviews associated with a car
function getReviewsByInventoryId($invId){
    $db = phpmotorsConnect(); 
    $sql = ' SELECT reviews.reviewId, reviews.reviewText, reviews.reviewDate, 
    reviews.clientId, reviews.invId, clients.clientFirstname, clients.clientLastname 
    FROM reviews INNER JOIN clients ON reviews.clientId = clients.clientId 
    WHERE invId = :invId ORDER BY reviews.reviewDate DESC'; 
    $stmt = $db->prepare($sql); 
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT); 
    $stmt->execute(); 
    $inventory = $stmt->fetchAll(PDO::FETCH_ASSOC); 
    $stmt->closeCursor(); 
    return $inventory;   
}

//Retrives all the reviews associated with a client
function getReviewsByClientId($clientId){
    $db = phpmotorsConnect(); 
    $sql = ' SELECT inventory.invMake, inventory.invModel, reviews.reviewId, 
    reviews.reviewText, reviews.reviewDate, reviews.clientId, reviews.invId 
    FROM reviews INNER JOIN inventory ON reviews.invId = inventory.invId 
    WHERE clientId = :clientId'; 
    $stmt = $db->prepare($sql); 
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT); 
    $stmt->execute(); 
    $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC); 
    $stmt->closeCursor(); 
    return $reviews;   
}

//Retrives one review from the database by its id
function getReviewByReviewId($reviewId){
    $db = phpmotorsConnect(); 
    $sql = ' SELECT inventory.invMake, inventory.invModel, reviews.reviewId, 
    reviews.reviewText, reviews.reviewDate, reviews.clientId, reviews.invId 
    FROM reviews INNER JOIN inventory ON reviews.invId = inventory.invId 
    WHERE reviewId = :reviewId'; 
    $stmt = $db->prepare($sql); 
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT); 
    $stmt->execute(); 
    $review = $stmt->fetch(PDO::FETCH_ASSOC); 
    $stmt->closeCursor(); 
    return $review;  
}

//Updates the text of a review using the id
function updateReview($reviewText, $reviewId){
    $db = phpmotorsConnect();
    $sql = 'UPDATE reviews SET reviewText = :reviewText WHERE reviewId = :reviewId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}

//Deletes a review given a review id
function deleteReview($reviewId){
    $db = phpmotorsConnect();
    $sql = 'DELETE FROM reviews WHERE reviewId = :reviewId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;

}

?>