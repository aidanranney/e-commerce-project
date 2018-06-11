<br><br>

<hr>

<br>

</body>

<footer class="navbar-inverse">
 <div class="container">
  <div class=”row”>
    <div class="col-sm-4 footer-section">
    <strong>Connect with Mick's Licks</strong>
    <p>Promotions, news, and information</p>
    <form class="form-inline" action="mailto:mick.lick.records@gmail.com">
        <div class="form-group">
            <label class="sr-only" for="inputEmail">Email</label>
            <input type="email" class="form-control" id="inputEmail" placeholder="address@example.com">
         </div>
         <button type="submit" class="btn btn-info">Subscribe</button>
     </form>
   </div>
   <div id='mid-footer' class="col-sm-4 footer-section">
     <ul style="list-style-type:none">
       <li>&copy JAAM</li>
       <li>Jesse Johnston</li>
       <li>Aidan Ranney</li>
       <li>Andrew Bishop</li>
       <li>Matthew Singleton</li>
     </ul>
   </div>
   <div id='right-footer' class="col-sm-4 footer-section">
     <p>Created for Camosun College ICS 199 Applied Computing Project, June 2018</p>
     <br>
     <p> Accessed: 
     <?php
     date_default_timezone_set('America/Los_Angeles');
     print date('Y-m-d H:i:s');
     ?>
    </p>
   </div>

  </div>
 </div><!-- end container -->
</footer>


</html>
