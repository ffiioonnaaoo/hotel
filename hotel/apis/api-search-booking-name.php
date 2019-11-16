<?php
session_start();
if( !isset($_SESSION['sUserId'] ) ){
  sendResponse(0, __LINE__, 'You must login to use this api');
}
//ini_set('display_errors',0);
require_once __DIR__.'/../connect.php';


$sName = $_GET['txtSearchName'] ?? '';


try{
$stmt = $db->prepare('SELECT * FROM full_reservation_data WHERE full_reservation_data.last_name 
LIKE :sName OR full_reservation_data.first_name LIKE :sName');

$stmt->bindValue(':sName', "%$sName%" );
$stmt->execute(); 
$aRows = $stmt->fetchAll();
if(count($aRows) == 0){sendResponse(0,__LINE__,'No booking with that name');} 
else{
  //sendResponse(1,__LINE__,'success');
echo json_encode($aRows);
}
 

}catch(PDOException $ex){
echo $ex;
}



//***********************//
function sendResponse($Status, $iLineNumber,$sMessage){
  echo '{"status":'.$Status.',"code":'.$iLineNumber.', "message":'.$sMessage.'}';
  exit;
}
