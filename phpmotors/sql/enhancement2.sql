
-- Part 1
SELECT * FROM clients;

INSERT INTO clients(clientFirstname,clientLastname,clientEmail,clientPassword,coment)
VALUES ("Tony","Stark","tony@starkent.com","Iam1ronM@n","I am the real Ironman");

-- Part 1 check
SELECT * FROM clients;


-- Part 2
UPDATE clients
SET clientLevel = 3
WHERE clientId = 1;

-- Part 2 check
SELECT * FROM clients;


-- Part 3
SELECT * FROM inventory WHERE invId = 12;

UPDATE inventory
SET invDescription = REPLACE ("Do you have 6 kids and like to go off-roading? The Hummer gives you the small interiors with an engine to get you out of any muddy or rocky situation.", "small interior", "spacious interior")
WHERE invId = 12;

-- Part 3 check
SELECT * FROM inventory WHERE invId = 12;


-- Part 4
SELECT invModel, classificationName
FROM inventory
INNER JOIN carclassification
ON inventory.classificationId = carclassification.classificationId
WHERE inventory.classificationId = 1;


-- Part 5
SELECT * FROM inventory;

DELETE FROM inventory WHERE invId = 1;

-- Part 5 check
SELECT * FROM inventory;


-- Part 6
SELECT invImage, invThumbnail FROM inventory;

UPDATE inventory
SET invImage = CONCAT ("/phpmotors",invImage), invThumbnail = CONCAT("/phpmotors",invThumbnail);

-- Part 6 CHECK
SELECT invImage, invThumbnail FROM inventory;