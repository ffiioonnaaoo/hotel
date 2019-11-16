<?php

session_start();

    //echo 'Signed in as '.$_SESSION['sUserId'];

require_once __DIR__.'/top.php';
?>

<h1>Search for a Booking</h1>
<form id="frmSearchName" action= "apis/api-search-booking-name.php" method="GET">
  <input name ="txtSearchName" id="txtSearchName" placeholder="search">
<button class="search-button">SEARCH </button>
</form>


    <div id="searchPlaceHolder"></div>
    <table class="responsive">
  <tr>
						    <th>Guest Name</th>
						    <th>Check-in Date</th>
						    <th>Check-out Date</th>
						    <th>Room Type</th>
						    <th>Total Price</th>
						    <th>Status</th>
                  <th>Booking Id</th>
						    <th></th>
						    <th></th>
					   </tr>
				 <tbody id="lblSearch">
						
					  </tbody>
  				
  				
</table>

    <?php 
    $sLinktoScript = '<script src="js/admin.js"></script>';
    require_once 'bottom.php'; ?>