<?php
try{
  // $sUserName = 'root';
  // $sPassword = '';
  // $sConnection = "mysql:host=localhost; dbname=hotel; charset=utf8mb4";

  $sUserName = 'okafor_dk';
  $sPassword = 'raphael11111';
  $sConnection = "mysql:host=mysql42.unoeuro.com; dbname=okafor_dk_db; charset=utf8mb4";

  // PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
  $aOptions = array(
  //PDO::ATTR_ERRMODE=> PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
  );
  $db = new PDO( $sConnection, $sUserName, $sPassword, $aOptions );
  

}catch( PDOException $e){
  echo $e;
  // echo '{"status":0,"message":"cannot connect to database"}';
  exit();
}









