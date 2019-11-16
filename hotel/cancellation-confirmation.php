<?php
session_start();

require_once __DIR__.'/top.php';
$iReservationId = $_GET['reservation-id'] ?? '';

?>

<main>
    <h1>Cancellation Confirmation</h1>

<div class="notification notification-green">
<p>Reservation Nr. <?php echo $iReservationId?> has been cancelled. <a href= "admin-page">Back to admin page<a></p>
</div>





</main>


<?php
 $sLinktoScript = '<script src="js/search-rooms.js"></script>';
require_once __DIR__.'/bottom.php';
?>

