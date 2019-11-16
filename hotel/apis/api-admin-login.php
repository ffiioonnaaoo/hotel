<?php
require_once __DIR__.'/../connect.php';

ini_set('display_errors',0);
// I would add some frontend validation to check if the user is the admin before it gets checked in the backend.



$sUsername = $_POST['txtUsername'] ?? '';
if( empty($sUsername) ){sendResponse(0,__LINE__,'enter a username');}
if( strlen($sUsername) < 2 ){sendResponse(0,__LINE__, 'username is too short');}
if( strlen($sUsername) > 20 ){sendResponse(0,__LINE__,'username is too long');}

$sUserPassword = $_POST['txtUserPassword' ?? ''];
if( empty($sUserPassword) ){ sendResponse(0,__LINE__, 'enter a password');}
if( strlen($sUserPassword) < 4 ){sendResponse(0,__LINE__,'password is too short');}
if( strlen($sUserPassword) > 50 ){ sendResponse(0,__LINE__,'password is too long');}
  



try{
$stmt = $db->prepare('SELECT * FROM hotel_administrators WHERE username = :sUsername');
$stmt->bindValue(':sUsername', $sUsername);
$stmt->execute();
$aRow = $stmt->fetch();

if(count($aRow) == 0){sendResponse (0,__LINE__,'NO USERS MATCH YOUR QUERY');} 
 $dbPassword =  json_encode ($aRow->user_password);

 //I had some issues with getting the unhashed password from the database. There seemed to be an added space in the password.
 //I tried a few things and this worked but I would have liked to have figured out the reason and a better solution.
$PasswordTrimmed = trim($dbPassword, '"'); 
//echo $PasswordTrimmed;



 //echo $dbPassword.'is the same as'.$sUserPassword;
// echo password_verify($sUserPassword, $dbPassword);


if(!password_verify($sUserPassword, $PasswordTrimmed) ){
    sendResponse(0,__LINE__, 'wrong password');
    
}
 

}catch(PDOException $ex){
echo $ex;
}
//header('Location: ../admin-page');
session_start();
$_SESSION['sUserId'] = $sUsername;
//sendResponse(1,__LINE__,'success');

header('location: ../admin-page'); 



//****************************************//
function sendResponse($iStatus, $iLineNumber, $sMessage){
  echo '{"status":'.$iStatus.', "code":'.$iLineNumber.',"message":"'.$sMessage.'"}';
  exit;
}