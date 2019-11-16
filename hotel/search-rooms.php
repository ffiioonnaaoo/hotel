<?php
session_start();

require_once __DIR__.'/top.php';

?>

<main>
    <h1>Search for a room</h1>
<form id="frmSearchRooms" action="apis/api-show-available-rooms.php" method="GET">


<div class="search-container">
<p>Check in: <input id="txtCheckInDate" name="txtCheckInDate" type="text" class="datepicker datepicker1" autocomplete="off"></p>
<p>Check out: <input id="txtCheckOutDate" name="txtCheckOutDate" type="text" class="datepicker datepicker2" autocomplete="off"></p>

<p>Number of Guests:<select id="slctNumberOfGuests" name="slctNumberOfGuests" form="frmSearchRooms">
  <option value="1">1 Adult</option>
  <option value="2">2 Adults</option>
  <option value="3">3 Adults</option>
  <option value="4">4 Adults</option>
</select></p>

</div>


<button class="book-btn" >SEARCH ROOMS</button>

</form>


<div class="room-img">

<div id="roomPlaceHolder"></div>


<div id="descriptionPlaceHolder"></div>







</div>


</main>


<?php
 $sLinktoScript = '<script src="js/search-rooms.js"></script>';
require_once __DIR__.'/bottom.php';
?>