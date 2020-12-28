    <div id="header-carousel" class="carousel slide" data-ride="carousel" data-interval="9000">
      <div class="carousel-inner">
        <?php 
        $count = 1; 
        $numbers = range(1, 5); 
        shuffle($numbers); 
        foreach ($numbers as $number) { 
          if ($count == 1) { 
        ?>    
          <div id="cazza<?php echo $number; ?>" class="item active">
           <img class="img-responsive" src="/images/logo.png" alt="Siem Reap Angkor Taxi">
          </div>
        <?php 
          } else { ?>
          <div id="cazza<?php echo $number; ?>" class="item">
           <img class="img-responsive" src="/images/logo.png" alt="Siem Reap Angkor Taxi">
          </div>
        <?php 
          } $count++;
        } ?>        
      </div>
    </div>
