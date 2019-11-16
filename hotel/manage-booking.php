<?php
session_start();
require_once __DIR__.'/top.php';
require_once __DIR__.'/connect.php';
//ini_set('display_errors',0);
$iReservationId = $_GET['reservation-id'] ?? '';
$_SESSION['iReservationId'] = $_GET['reservation-id'];

try{
$stmt = $db->prepare('SELECT * FROM guests 
INNER JOIN countries ON guests.country_fk = countries.country_id
INNER JOIN reservations ON guests.reservation_fk = reservations.reservations_id
WHERE guests.reservation_fk  = :iReservationId');
$stmt->bindValue(':iReservationId', $iReservationId);
$stmt->execute();
$aRows = $stmt->fetch();

if(count($aRows) == 0){sendResponse (0,__LINE__,'reservation was not deleted, system error');} 


$firstName = $aRows->first_name;
$lastName = $aRows->last_name;
$email = $aRows->email;
$phone = $aRows->phone;
$sAdressLine1 = $aRows->address_line_1;
$sCity= $aRows->city;
$CheckInDate= $aRows->check_in_date;
$CheckOutDate= $aRows->check_out_date;
$iNumberOfNights= $aRows->number_of_nights;
$iNumberOfGuests= $aRows->cnumber_of_guests;
$sStatus= $aRows->status;
$sWord = ($sStatus == 0) ? 'NOT CKECKED IN': 'CHECKED IN';
}catch(PDOException $ex){
echo $ex;
}
?>

<h1>Manage Booking</h1>

<div class="details">

<div class="guest-info-container">
<h2>Guest Information</h2>
<p>First Name: <?php echo $firstName;?></p>
<p>Last Name: <?php echo $lastName;?></p>
<p>Email: <?php echo $email;?></p>
<p>Phone: <?php echo $phone;?></p>
<p>Street: <?php echo $sAdressLine1;?></p>
<p>City: <?php echo $sCity;?></p>
<p>Country: <?php echo $sCountry;?></p>
</div>


<div class="reservation-info-container">
<h2>Reservation</h2>
<p>Check In: <?php echo $CheckInDate;?></p>
<p>Check Out: <?php echo $CheckOutDate;?></p>
<p>Number of Nights: <?php echo $iNumberOfNights;?></p>
<p>Number of Guests: <?php echo $iNumberOfGuests?></p>
<p>Reservation Status: <?php echo $sStatus;?></p>
</div>

<a href="apis/api-checkin?reservation-id=<?php echo $_GET['reservation-id'] ?>"><button class="book-btn"><?php echo $sWord ?></button></a>
<a href="apis/api-delete-booking?reservation-id=<?php echo $_GET['reservation-id'] ?>"><button class="cancel-btn">Cancel Reservation</button></a>

</div>




    <?php 
    $sLinktoScript = '<script src="js/admin.js"></script>';
    require_once 'bottom.php';?>


