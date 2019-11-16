<?php
session_start();

require_once __DIR__.'/top.php';

?>

<main>
    <h1>Booking Confirmation</h1>
<div class="notification notification-green">
<p>Success! You have booked your stay at The Grand Budapest Hotel</p>
</div>



</main>


<?php
 $sLinktoScript = '<script src="js/search-rooms.js"></script>';
require_once __DIR__.'/bottom.php';
?>