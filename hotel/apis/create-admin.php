<?php

require_once __DIR__.'/../connect.php';
ini_set('display_errors',0);

$password = 'admin';

$sSecurePassword = password_hash($password, PASSWORD_DEFAULT);
echo $sSecurePassword;

try{
$stmt = $db->prepare("INSERT INTO hotel_administrators VALUES (null, 'admin',:sSecurePassword)");
$stmt->bindValue(':sSecurePassword', $sSecurePassword);

$stmt->execute();

}catch(PDOException $ex){
echo $ex;
}

echo 'done';
