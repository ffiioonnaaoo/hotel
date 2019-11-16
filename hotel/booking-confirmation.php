<?php
session_start();

require_once __DIR__.'/top.php';
$_SESSION["sRoomId"]= $_GET['reservation-id'] ?? '';
//echo $_SESSION["sRoomId"];

?>

<main>


    <h1>Booking Confirmation</h1>

<div class="notification notification-green">
<p>Success! You have booked your stay at The Grand Budapest Hotel</p>
</div>

<?php
require_once __DIR__.'/connect.php';

$stmt = $db->prepare('SELECT * FROM reservations 
INNER JOIN room_types ON reservations.room_type_fk = room_types.room_type_id
WHERE reservations.reservations_id = :sRoomId');
$stmt->bindValue(':sRoomId', $_SESSION["sRoomId"]);
//echo $_SESSION["sRoomId"];
$stmt->execute();
$aRow = $stmt->fetch();
//echo json_encode($aRow);
echo '
<section class="confirmation-detail ">
<div class="your-room-detail">
<h3>Your Room Details</h3>



<h3 id="">'.$aRow->room_type.'</h3>
    <p class="">'.$aRow->description.'</p>
      <p id="">Check in: '.date ("d-m-y", strtotime($_SESSION["sCheckInDate"])).'</p>
        <p id="">Check in: '.date ("d-m-y", strtotime($_SESSION["sCheckOutDate"])).'</p>
         <p id="">Nights: '.$_SESSION["iNightsRequested"].'</p>
         <p id="">Guests: '.$_SESSION["iNumberOfGuests"].'</p></div>';


?>

</main>


<?php
 $sLinktoScript = '<script src="js/search-rooms.js"></script>';
require_once __DIR__.'/bottom.php';
?>