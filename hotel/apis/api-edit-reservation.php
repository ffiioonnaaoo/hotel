<?php
require_once __DIR__.'/../connect.php';
session_start();
ini_set('display_errors',0);

$iReservationId = $_SESSION['iReservationId'];
echo $iReservationId;
//one form shows guest info
//select info on page
//update here based on guest id =  resrvation fk
$sFirstName = $_POST['txtFirstName'] ?? '';
$sLastName = $_POST['txtLastName'] ?? '';
echo $sFirstName;
try{
$stmt = $db->prepare('UPDATE guests SET guests.first_name = :sFirstName, guests.last_name = :sLastName WHERE guests.reservation_fk = :iReservationId');
$stmt->bindValue(':sFirstName', $sFirstName);
$stmt->bindValue(':sLastName', $sLastName);
$stmt->bindValue(':iReservationId', $iReservationId);
$stmt->execute();
$aRows = $stmt->fetchAll();

if(count($aRows) == 0){sendResponse (0,__LINE__,'no edit');} 
echo json_encode($aRows);





}catch(PDOException $ex){
echo $ex;
}




//****************************************//
function sendResponse($iStatus, $iLineNumber, $sMessage){
  echo '{"status":'.$iStatus.', "code":'.$iLineNumber.',"message":"'.$sMessage.'"}';
  exit;
}