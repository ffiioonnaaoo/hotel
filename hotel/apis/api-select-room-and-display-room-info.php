<?php
session_start();

require_once __DIR__.'/../connect.php';
ini_set('display_errors',0);

$sRoomId = $_GET['room-id'] ?? '';
//get room info to display
 
  header("location: ../book-room?room-id=$sRoomId");  

try{
$stmt = $db->prepare('SELECT * FROM rooms INNER JOIN room_types 
ON rooms.room_type_fk = room_types.room_type_id WHERE rooms.room_id = :sRoomId');
$stmt->bindValue('sRoomId', $sRoomId);

$stmt->execute();
$aRows = $stmt->fetch();
if(count($aRows) == 0){echo 'no rooms exist';} 

 
echo json_encode($aRows);
  

}catch(PDOException $ex){
echo $ex;
}
