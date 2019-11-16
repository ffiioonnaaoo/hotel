<?php
require_once __DIR__.'/connect.php';
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet"> 
  <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="css/index.css">
      <title>GB Hotel</title>
    </head>
<body>
  <nav>
  <div>
   <a href="index.php"><img id="logo" src="images/grand-bud-logo.png"></a>
  </div>

  <div>
    
    <a href='rooms'>Rooms</a>
  <a href= 'login'>Manage Booking</a>
  </div>


  </nav>

  <?= $sInjectCss ?? '' ?>
  



