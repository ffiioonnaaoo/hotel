<?php
require_once __DIR__.'/top.php';
require_once __DIR__.'/connect.php';

?>
<main>
    <h1>See our rooms</h1>


<div id="resultPlaceHolder"></div>

<section id="all-rooms-list">
<div class="img-container">
<img src="">
</div class="hotel-info-container">

<div>
<p>room type</p>
<p>room description</p>
</div>
</section>


</main>




<?php
 $sLinktoScript = '<script src="js/search-rooms.js"></script>';
require_once __DIR__.'/bottom.php';
?>