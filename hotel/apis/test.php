<?php
session_start();
$sCheckInDate = $_SESSION["sCheckInDate"];
$sCheckOutDate = $_SESSION["sCheckOutDate"];
$sNumberOfGuests = $_SESSION["iNumberOfGuests"];
$nightsRequested = $_SESSION["iNightsRequested"];
$sRoomId =  $_SESSION["sRoomId"];


require_once __DIR__.'/../connect.php';

//  ini_set('display_errors',0);
// TODO: FRONTEND VALIDATION



$sFirstName = $_POST['txtFirstName'] ?? '';
if( empty($sFirstName) ){sendResponse(0,__LINE__,'enter a first name');}
if( strlen($sFirstName) < 2 ){sendResponse(0,__LINE__, 'first name is too short');}
if( strlen($sFirstName) > 20 ){sendResponse(0,__LINE__,'first name is too long');}

$sLastName = $_POST['txtLastName'] ?? '';
if( empty($sLastName) ){sendResponse(0,__LINE__,'enter a last name');}
if( strlen($sLastName) < 2 ){sendResponse(0,__LINE__,'last name is too short');}
if( strlen($sLastName) > 20 ){sendResponse(0,__LINE__,'last name is too long');}

$sEmail = $_POST['txtEmail'] ?? '';
if( empty($sEmail) ){sendResponse(0,__LINE__,'enter an email');}
if( !filter_var($sEmail, FILTER_VALIDATE_EMAIL) ){sendResponse(0,__LINE__, 'enter a valid email');}

$sPhone = $_POST['txtPhone'] ?? '';
if( empty($sPhone) ){sendResponse(0,__LINE__,'enter a phone number');}
if( strlen($sPhone) > 15 ){sendResponse(0,__LINE__, 'phone number is too short');}
if( intval($sPhone) < 100000 ){sendResponse(0,__LINE__,'phone number is invalid');}
if( intval($sPhone) > 999999999999999 ){sendResponse(0,__LINE__,'phone is invalid');}

$sAddressLine1 = $_POST['txtAddressLine1'] ?? '';
if( empty($sAddressLine1 ) ){sendResponse(0,__LINE__,'enter a the first line of your address');}

$sCity = $_POST['txtCity'] ?? '';
if( empty($sCity ) ){sendResponse(0,__LINE__,'enter a city');}

$sCountry = $_POST['txtCountry'] ?? '';
if( empty($sCountry ) ){sendResponse(0,__LINE__,'enter a country');}

// $sCardNumber = $_POST['txtCardNumber'] ?? '';
// if( empty($sCardNumber ) ){sendResponse(0,__LINE__,'enter a card number');}

// $sExpiryMonth = $_POST['txtExpiryMonth'] ?? '';
// if( empty($sFirstName ) ){sendResponse(0,__LINE__,'enter a credit card expiry month');}

// $sExpiryYear = $_POST['txtExpiryYear'] ?? '';
// if( empty($sFirstName ) ){sendResponse(0,__LINE__,'enter a credit card expiry year');}

// $sSecurityCode = $_POST['txtSecurityCode'] ?? '';
// if( empty($sSecurityCode ) ){sendResponse(0,__LINE__,'enter a security code');}



/* Begin a transaction, turning off autocommit */
$db->beginTransaction();
try{
/* Change the database schema and data */
 $stmt = $db->prepare('INSERT INTO guests 
VALUES (null, :sFirstName, :sLastName, :sEmail, :sPhone, :sAddressLine1, :sCity, :sCountry);
SELECT * FROM guests
INNER JOIN countries ON guests.country_fk = countries.country_id;');
$stmt->bindValue(':sFirstName', $sFirstName);
  echo $sFirstName;
$stmt->bindValue(':sLastName', $sLastName);
$stmt->bindValue(':sEmail', $sEmail);
$stmt->bindValue(':sPhone', $sPhone);
$stmt->bindValue(':sAddressLine1', $sAddressLine1);
$stmt->bindValue(':sCity', $sCity);
$stmt->bindValue(':sCountry', $sCountry);


$iUserId = $db->lastInsertId();//get the id for the user
echo "GUEST INSERTED WITH ID $iUserId";


 $stmt = $db->prepare('INSERT INTO reservations VALUES(null, :sRoomId, :sCheckInDate, 
 :sCheckOutDate, :nightsRequested, :iNumberOfGuests);
 SELECT *
 FROM reservations
 INNER JOIN rooms ON reservations.room_fk = rooms.room_id;');
 $stmt->bindValue(':sRoomId', $sRoomId);
$stmt->bindValue(':sCheckInDate', $sCheckInDate);
$stmt->bindValue(':sCheckOutDate', $sCheckOutDate);
$stmt->bindValue(':nightsRequested', $nightsRequested);
$stmt->bindValue(':iNumberOfGuests', $sNumberOfGuests);
if(  !$stmt->execute() ){ // only works because the line PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, in the connect.php has been commented out
  echo 'Cannot update reservation '.__LINE__;
  $db->rollBack();
  exit;
}
$ReservationId = $db->lastInsertId();//get the id for the user
echo "GUEST INSERTED WITH ID $ReservationId";
/* Recognize mistake and roll back changes */

$db->commit();
echo 'DONE';
}
catch( PDOException $ex){
  echo "SYSTEM UNDER MAN.";
  echo $ex;
  // Fatal error if you try to break the uniqueness in the table
  $db->rollBack(); // ***********************
}





/* Database connection is now back in autocommit mode */


// try{
 
//     //We start our transaction.
//     $db->beginTransaction();
 
 
//     //Query 1: Attempt to insert the payment record into our database.
//    $stmt = $db->prepare("INSERT INTO guests 
// VALUES (null, :sFirstName, :sLastName, :sEmail, :sPhone, :sAddressLine1, :sCity, :sCountry);
//  SELECT * FROM guests
//  INNER JOIN countries ON guests.country_fk = countries.country_id;");
  
//     $stmt->execute(array(
//             $userId, 
//             $paymentAmount,
//         )
//     );
    
//     //Query 2: Attempt to update the user's profile.
//     $sql = "UPDATE users SET credit = credit + ? WHERE id = ?";
//     $stmt = $pdo->prepare($sql);
//     $stmt->execute(array(
//             $paymentAmount, 
//             $userId
//         )
//     );
    
//     //We've got this far without an exception, so commit the changes.
//     $pdo->commit();
    
// } 
// //Our catch block will handle any exceptions that are thrown.
// catch(Exception $e){
//     //An exception has occured, which means that one of our database queries
//     //failed.
//     //Print out the error message.
//     echo $e->getMessage();
//     //Rollback the transaction.
//     $pdo->rollBack();
// }

// //create view
// CREATE VIEW full_reservation_data
// AS
// SELECT reservations.reservations_id,reservations.check_in_date,
//         reservations.check_out_date,reservations.number_of_guests,
//       	reservations.number_of_guests,reservations.status, reservations.room
//         guests.first_name,guests.last_name,
//         guests.email

        
// FROM    gift a
//         INNER JOIN users b
//             ON a.user_from = b.id
//         INNER JOIN users c
//             ON a.user_from = c.id
//         INNER JOIN items d
//             ON a.item = d.idCREATE VIEW full_reservation_data
// AS
// SELECT reservations.reservations_id,reservations.check_in_date,
//         reservations.check_out_date,reservations.number_of_guests,
//       	reservations.number_of_guests,reservations.status, reservations.room
//         guests.first_name,guests.last_name,
//         guests.email

        
// FROM    gift a
//         INNER JOIN users b
//             ON a.user_from = b.id
//         INNER JOIN users c
//             ON a.user_from = c.id
//         INNER JOIN items d
//             ON a.item = d.id