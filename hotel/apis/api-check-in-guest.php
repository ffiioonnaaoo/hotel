
<?php
require_once __DIR__.'/../connect.php';
session_start();
ini_set('display_errors',0);

//frontend validation needed
echo $iReservationId = $_GET['reservation-id'] ?? '';
echo $iReservationId;

try{
$stmt = $db->prepare('UPDATE reservations SET reservations.status = 0 WHERE reservations_id = :iReservationId');
$stmt->bindValue(':iReservationId', $iReservationId);
$stmt->execute();
$aRow = $stmt->fetch();
//echo json_encode($aRow);
if(count($aRow) == 0){sendResponse (0,__LINE__,'user not checked in');} 

}catch(PDOException $ex){
echo $ex;
}

//sendResponse(1,__LINE__,"Reservation with id '.$iReservationId.' was successfully deleted");
//sendResponse (1,__LINE__,'success');
//header("location: ../manage-booking?reservation-id=$iReservationId"); 
//echo 'recod has been deleted';




//****************************************//
function sendResponse($iStatus, $iLineNumber, $sMessage){
  echo '{"status":'.$iStatus.', "code":'.$iLineNumber.',"message":"'.$sMessage.'"}';
  exit;
}




if ($jCreditCard->creditCardNum == $_GET['card']){
      $jCreditCard->active  = !$jCreditCard->active  ;//true true gives true, false true is true
       $sData  = json_encode ($jData, JSON_PRETTY_PRINT);
        $sData = file_put_contents('../data/clients.json', $sData);
        header('location: ../profile'); 
    }