<?php
session_start();
require_once __DIR__.'/../connect.php';
ini_set('display_errors',0);

// TODO: FRONTEND VALIDATION

//get the check in date and convert to php format
//$sCheckInDate = $_GET['txtCheckInDate'];

$sCheckInDate = $_GET['txtCheckInDate'] ?? '';
if( empty($sCheckInDate ) ){sendResponse(0,__LINE__,'enter a check in');}
//convert to php format
$sCheckInDate  = date ("Y-m-d", strtotime($sCheckInDate));
//validate that date is in the future
if($sCheckInDate < date('Y-m-d')){sendResponse (0,__LINE__,'enter a date after todays date');}


$sCheckOutDate = $_GET['txtCheckOutDate'] ?? '';
$sCheckOutDate  = date ("Y-m-d", strtotime($sCheckOutDate));

//check check out date is after the check in date
if($sCheckOutDate <= $sCheckInDate){sendResponse (0,__LINE__,'enter a date after the check in date');}
//calculate the nights requested in search
$nightsRequested = strtotime($sCheckOutDate) - strtotime($sCheckInDate);
//convert seconds to days
$nightsRequested = (int) $nightsRequested/60/60/24;
// echo 'the difference is'.$nightsRequested.'days';
if($nightsRequested >=31 ){sendResponse (0,__LINE__,'you can book maximum 30 days');}

$sNumberOfGuests= $_GET['slctNumberOfGuests'] ?? '';
if(!isset ($sNumberOfGuests)){sendResponse (0,__LINE__,'enter number of guests');}

//search for free rooms in database
try{
$stmt = $db->prepare('SELECT * FROM rooms INNER JOIN room_types ON rooms.room_type_fk = room_types.room_type_id 
INNER JOIN photos ON rooms.room_id = photos.room_fk
WHERE rooms.capacity >= :iNumberOfGuests AND rooms.room_id NOT IN
(SELECT room_fk FROM reservations WHERE :sCheckInDate >= reservations.check_in_date 
AND :sCheckOutDate  <= reservations.check_out_date )');
$stmt->bindValue(':sCheckInDate', $sCheckInDate);
$stmt->bindValue(':sCheckOutDate', $sCheckOutDate);
$stmt->bindValue(':iNumberOfGuests', $sNumberOfGuests);
$stmt->execute();
$aRows = $stmt->fetchAll();
if(count($aRows) == 0){sendResponse (0,__LINE__,'NO ROOMS MATCH YOUR QUERY');} 

  foreach($aRows as $aRow){
  
      $_SESSION["sRoomTypeId"] = $aRow->room_type_id;

}

  $_SESSION["sCheckInDate"] = $sCheckInDate;
  $_SESSION["sCheckOutDate"] = $sCheckOutDate;
  $_SESSION["iNumberOfGuests"] = $sNumberOfGuests;
  $_SESSION["iNightsRequested"] = $nightsRequested;

echo json_encode($aRows);

  


}catch(PDOException $ex){
echo $ex;
}


//****************************************//
function sendResponse($iStatus, $iLineNumber, $sMessage){
  echo '{"status":'.$iStatus.', "code":'.$iLineNumber.',"message":"'.$sMessage.'"}';
  exit;
}