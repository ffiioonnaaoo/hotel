<?php
session_start();
require_once __DIR__.'/top.php';

?>  
    <h1>Book your room</h1>
<main id="booking-main">

<section class="form">
<div class="booking-form">
        <h3>Guest Details</h3>
            <form id="frmBookRoom" action="apis/api-insert-guest-info.php" method="POST">
            <p>First Name</p><input name="txtFirstName" type="text" 
            data-validate="yes" data-min="2" data-max="20" data-type="string">
            <p>Last Name</p><input name="txtLastName" type="text" 
            data-validate="yes" data-min="2" data-max="20" data-type="string">
            <p>Email</p><input id="txtEmail" name="txtEmail" type="text" >
            <p>Phone</p><input name="txtPhone" type="text" 
            data-validate="yes" data-min="6" data-max="15" data-type="integer">
            <p>Street</p> <input id="txtAddressLine1" name="txtAddressLine1" type="text" 
            data-validate="yes" data-min="5" data-max="30" data-type="string">
            <p>City</p><input id="txtCity" name="txtCity"  type="text" 
            data-validate="yes" data-min="3" data-max="30" data-type="string">
            <p>Country</p><select id="txtCountry" name="txtCountry" form="frmBookRoom">
  <option value="1">Denmark</option>
  <option value="2">Sweden</option>
  <option value="3">Norway</option>
  <option value="4">Italy</option>
  <option value="5">Poland</option>
  <option value="6">Portugal</option>
  <option value="7">South Africa</option>
  <option value="8">Brazil</option>
</select>

</div>
<div class="booking-form">

    <h3>Payment Details</h3>
        <p>Card Number</p><input id="txtCardNumber" name="txtCardNumber" type="text">
        <p>Name on Card</p><input id="txtCardholderName" name="txtCardholderName" type="text">
        <p>Expiry Date</p><input id="txtExpiryMonth" name="txtExpiryMonth" type="text"placeholder="MM">
        <input id="txtExpiryYear" name="txtExpiryYear" type="text"placeholder="YY">
        <p>Security Code</p><input id="txtSecurityCode" name="txtSecurityCode" type="text" 
        data-validate="yes" data-min="3" data-max="3" data-type="integer"><br>
        <button class="book-btn2">Finish your booking</button>
</div>


</form>
</section>
<section class="details">
<?php


$_SESSION["sRoomId"]= $_GET['room-id'] ?? '';
require_once __DIR__.'/connect.php';
$stmt = $db->prepare('SELECT * FROM rooms INNER JOIN room_types 
ON rooms.room_type_fk = room_types.room_type_id 
INNER JOIN photos ON rooms.room_id = photos.room_fk
WHERE rooms.room_id = :sRoomId');
$stmt->bindValue(':sRoomId', $_SESSION["sRoomId"]);
$stmt->execute();
$aRow = $stmt->fetch();
echo '
<div class="your-room-detail">
<h3>Your Room Details</h3>
<img class="book-room-img" src ="images/'.$aRow->photo_url.'">


<h3 id="">'.$aRow->room_type.'</h3>
    <p class="">'.$aRow->description.'</p>
      <p id="">Check in: '.date ("d-m-y", strtotime($_SESSION["sCheckInDate"])).'</p>
        <p id="">Check in: '.date ("d-m-y", strtotime($_SESSION["sCheckOutDate"])).'</p>
         <p id="">Nights: '.$_SESSION["iNightsRequested"].'</p>
         <p id="">Guests: '.$_SESSION["iNumberOfGuests"].'</p></div>';
 
  
?>
</section>

</main>


<?php

 $sLinktoScript = '<script src="js/book-room.js"></script>';
require_once __DIR__.'/bottom.php';
?>