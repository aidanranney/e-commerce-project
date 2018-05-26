<?php
$currentpage = 'home';
$title = 'Home Page';
include ('header.php');
include ('connection.php');
?>


<?php
print "<div class='container'>";
 $result = mysqli_query($link,'select * from RECORD');

 if ($result)   {
     while ($row = mysqli_fetch_array($result)) {
         echo "
         <div class='col-sm-3'>
            <article class='col-item'>
            	<div class='photo'>
        			<div class='options-cart-round'>
        			</div>
        			<a href=''#''> <img src='../images/records.jpg' class='img-responsive' alt='Product Image' /> </a>
        		</div>
        		<div class='info'>
        			<div class='row'>
        				<div class='price-details col-md-6'>
        					<p class='details'>"
        						. $row['quality'] . "
        					</p>
        					<h4>" . $row['albumTitle'] . "</h4>
                  <p class='details'><b>" . $row['artist'] . "</b></p>
        					<span class='price-new'>" . "$" . $row['PRICE'] . "</span>
        				</div>
        			</div>
        		</div>
        	</article>
        </div>";
        // $row['itemNumber'] . '. ' . $row['artist'] . ', ' . $row['albumTitle'] .', ' .
        // $row['genre'] .', ' . ' $'. $row['PRICE'] .', ' . $row['RELEASEDATE'] .', ' . $row['quality'] . ', ' . $row['EDITIONNUMBER'] . ', ' . $row['albumArtwork'] . '<br>';
     }

 }
 print "</div>";

 include ('footer.php');
?>
