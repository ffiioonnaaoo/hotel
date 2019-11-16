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

$sCardNumber = $_POST['txtCardNumber'] ?? '';
if( empty($sCardNumber ) ){sendResponse(0,__LINE__,'enter a card number');}

$sExpiryMonth = $_POST['txtExpiryMonth'] ?? '';
if( empty($sFirstName ) ){sendResponse(0,__LINE__,'enter a credit card expiry month');}

$sExpiryYear = $_POST['txtExpiryYear'] ?? '';
if( empty($sFirstName ) ){sendResponse(0,__LINE__,'enter a credit card expiry year');}

$sSecurityCode = $_POST['txtSecurityCode'] ?? '';
if( empty($sSecurityCode ) ){sendResponse(0,__LINE__,'enter a security code');}


try {  
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$db->beginTransaction();
  


$stmt = $db->prepare('INSERT INTO guests 
VALUES (null, :sFirstName, :sLastName, :sEmail, :sPhone, :sAddressLine1, :sCity, :sCountry)');
$stmt->bindValue(':sFirstName', $sFirstName);
$stmt->bindValue(':sLastName', $sLastName);
$stmt->bindValue(':sEmail', $sEmail);
$stmt->bindValue(':sPhone', $sPhone);
$stmt->bindValue(':sAddressLine1', $sAddressLine1);
$stmt->bindValue(':sCity', $sCity);
$stmt->bindValue(':sCountry', $sCountry);
    $stmt->execute();
 


$stmt = $db->prepare('INSERT INTO reservations VALUES(null, :sRoomId, :sCheckInDate, 
 :sCheckOutDate, :nightsRequested, :iNumberOfGuests)');
$stmt->bindValue(':sRoomId', $sRoomId);
$stmt->bindValue(':sCheckInDate', $sCheckInDate);
$stmt->bindValue(':sCheckOutDate', $sCheckOutDate);
$stmt->bindValue(':nightsRequested', $nightsRequested);
$stmt->bindValue(':iNumberOfGuests', $sNumberOfGuests);
    $stmt->execute();
  $db->commit();
  
} catch (Exception $e) {
  $db->rollBack();
  echo "Failed: " . $e->getMessage();
}
