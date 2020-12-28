
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span id="menu">Menu</span>                        
          </button>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav">
            <li <?php if ($_SERVER['PHP_SELF'] == "/index.php") echo 'class="active"'; ?>><a href="http://siemreapangkortaxi.com">Home</a></li>
            <li <?php if ($_SERVER['PHP_SELF'] == "/about-me.php") echo 'class="active"'; ?>><a href="/about-me.php">About<span class="hidden-sm"> Me</span></a></li>
            <li <?php if ($_SERVER['PHP_SELF'] == "/my-services.php") echo 'class="active"'; ?>><a href="/my-services.php"><span class="hidden-sm">My </span>Services</a></li>
            <li <?php if ($_SERVER['PHP_SELF'] == "/taxi-prices.php") echo 'class="active"'; ?>><a href="/taxi-prices.php"><span class="hidden-sm">Taxi </span>Prices</a></li>
            <li <?php if ($_SERVER['PHP_SELF'] == "/photo-gallery.php") echo 'class="active"'; ?>><a href="photo-gallery.php"><span class="hidden-sm">Photo </span>Gallery</a></li>
            <li <?php if ($_SERVER['PHP_SELF'] == "/package-tours.php") echo 'class="active"'; ?>><a href="package-tours.php"><span class="hidden-sm">Package </span>Tours</a></li>
            <li <?php if ($_SERVER['PHP_SELF'] == "/links.php") echo 'class="active"'; ?>><a href="links.php">Links</a></li>
            <li <?php if ($_SERVER['PHP_SELF'] == "/testimonials.php") echo 'class="active"'; ?>><a href="testimonials.php">Testimonials</a></li>
            <li <?php if ($_SERVER['PHP_SELF'] == "/contact-me.php") echo 'class="active"'; ?>><a href="contact-me.php">Contact<span class="hidden-sm"> Me</span></a></li>
          </ul>
        </div>
      </div>
    </nav>
