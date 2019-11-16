<?php
session_start();
require_once __DIR__.'/../connect.php';
ini_set('display_errors',0);
// FRONTEND VALIDATION



// echo $iReservationId = $_GET['reservation-id'] ?? '';
// echo $iReservationId;

try{
$stmt = $db->prepare('DELETE FROM reservations WHERE reservations.reservations_id = :iReservationId');
$stmt->bindValue(':iReservationId', $iReservationId);
$stmt->execute();
$aRow = $stmt->fetch();
//echo json_encode($aRow);
if(count($aRow) == 0){sendResponse (0,__LINE__,'reservation was not deleted, system error');} 

}catch(PDOException $ex){
echo $ex;
}

//sendResponse(1,__LINE__,"Reservation with id '.$iReservationId.' was successfully deleted");
//sendResponse (1,__LINE__,'success');
header("location: ../cancellation-confirmation?reservation-id=$iReservationId"); 
//echo 'recod has been deleted';




//****************************************//
function sendResponse($iStatus, $iLineNumber, $sMessage){
  echo '{"status":'.$iStatus.', "code":'.$iLineNumber.',"message":"'.$sMessage.'"}';
  exit;
}