<?php 
if (isset($_POST["YourName"]) && $_POST["YourName"] != ""){
  $YourName = $_POST["YourName"];
  $YourEmail = $_POST["YourEmail"];
  $YourSubject = $_POST["ContactSubject"];
  $YourComment = $_POST["YourComment"];
  
  $to = "kun@siemreapangkortaxi.com";
  $subject = $YourSubject;
  
  $mailbody = "
	<table width='540' border='0' cellspacing='0' cellpadding='0' align='center'>
		<tr>
		  <td width='82' valign='top' style='font-family: Arial; font-size: 12px;'><strong>Name</strong></td>
		  <td width='458' valign='top' style='font-family: Arial; font-size: 12px;'>".$YourName."</td>
		</tr>
		<tr><td colspan='2'><hr style='height: 1px; color: #000000;'></td></tr>
		<tr>
		  <td valign='top' style='font-family: Arial; font-size: 12px;'><strong>Email</strong></td>
		  <td valign='top' style='font-family: Arial; font-size: 12px;'>".$YourEmail."</td>
		</tr>
		<tr><td colspan='2'><hr style='height: 1px; color: #000000;'></td></tr>
		<tr>
		  <td valign='top' style='font-family: Arial; font-size: 12px;'><strong>Message</strong></td>
		  <td valign='top' style='font-family: Arial; font-size: 12px;'>".$YourComment."</td>
		</tr>
	</table>
	";
	
  $headers = 'From: kun@siemreapangkortaxi.com' . "\r\n" .
  'Reply-To: kun@siemreapangkortaxi.com' . "\r\n" .
  'MIME-Version: 1.0' . "\r\n" .
  'Content-type: text/html; charset=iso-8859-1' . "\r\n" .
  'X-Mailer: PHP/' . phpversion();
	  
  mail($to,$subject,$mailbody,$headers);
  
  header("Location: /contact-me.php?s=1"); 
}
?>
<!DOCTYPE html>
<html lang="en"><!-- InstanceBegin template="/Templates/FrontEnd.dwt.php" codeOutsideHTMLIsLocked="false" -->
  <head>
  <!-- InstanceBeginEditable name="doctitle" -->
  <title>Contact Siem Reap Angkor Taxi</title>
  <!-- InstanceEndEditable -->
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Andy Jacko / http://andyjacko.com">
    <!-- InstanceBeginEditable name="head" -->
    <meta name="description" content="Please complete the form provided or phone numbers provided to contact me about taxi services in Siem Reap">
    <!-- InstanceEndEditable -->
    <link href="/scripts/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="/scripts/bootstrap/css/font-awesome.min.css" rel="stylesheet">
    <link href="/scripts/bootstrap/css/navbar.css" rel="stylesheet">
    <!-- InstanceBeginEditable name="styles" -->
    <!-- InstanceEndEditable -->
    <link href="/scripts/bootstrap/css/style.css" rel="stylesheet">
  </head>
  <body>
    <?php include ("scripts/template/header.php");?>
    <?php include ("scripts/template/nav.php");?>
    <div class="container-fluid text-center">    
      <div class="row content">
        <?php include ("scripts/template/colleft3.php");?>
        <div class="col-lg-6 text-left"> 
          <div class="row">
            <div class="container-fluid">
              <div class="spacer"></div>
              <div>
				<!-- InstanceBeginEditable name="content" -->
                <h1>Contact Me: Kun +885 17889917</h1>
                <div id="contactwrap">
                  <iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d52220.79811426275!2d103.8559281958017!3d13.391630698525022!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sus!4v1453236181333"></iframe>
                </div>
                <div class="spacer"></div>
                <?php if ($_GET["s"] == "1") { echo "<h3 class='text-success'>Your Email Has Been Sent</h3>"; } ?>
                <h3>Location</h3>
                <p>Krong, Siem Reap, Cambodia.</p>
                <p>
                  <strong>Email:</strong> kun@siemreapangkortaxi.com<br/>
                  <strong>Tel:</strong> +885 178 899 17<br/>
                  <strong>Tel:</strong> +885 819 927 27<br/>
                  <strong>Tel:</strong> +885 883 213 999
                </p>
                <div class="spacer"></div>
                <h4>Please complete the form below if you wsh to send an email message.</h4>
                <form method="post" name="form" id="form" novalidate>
                  <div class="form-group">
                    <label for="ContactSubject"><strong>Subject Of Email:</strong></label>
                    <select class="form-control" name="ContactSubject" id="ContactSubject">
                      <option value="Taxi Booking" selected="selected">Taxi Booking</option>
                      <option value="General Enquiry">General Enquiry</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="YourName"><strong>Your Full Name:</strong></label>
                    <input type="text" class="form-control" name="YourName" id="YourName">
                  </div>
                  <div class="form-group">
                    <label for="YourEmail"><strong>Your Contact Email address:</strong></label>
                    <input type="email" class="form-control" name="YourEmail" id="YourEmail">
                  </div>
                  <div class="form-group">
                    <label for="YourComment"><strong>Your Message:</strong></label>
                    <textarea rows="5" class="form-control" name="YourComment" id="YourComment"></textarea>
                  </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <p>&nbsp;</p>
                  <p class="small">* All genuine emails replied to within 24 hours.</p>
                </form>
                <!-- InstanceEndEditable -->
              </div>
            </div>
          </div>
        </div>
        <?php include ("scripts/template/colright3.php");?>
      </div>
    </div>
    <?php include ("scripts/template/footer.php");?>
    <script src="/scripts/bootstrap/js/jquery-1.11.3.min.js" type="text/javascript"></script>
    <script src="/scripts/bootstrap/js/bootstrap.min.js"></script>
    <script>$(document).ready(function(){ $('[data-toggle="tooltip"]').tooltip(); });</script>
    <!-- InstanceBeginEditable name="footerscripts" -->
    <script src="/scripts/bootstrap/js/jquery.validate.js"></script>
    <script src="/scripts/bootstrap/js/custom.js"></script>
    <!-- InstanceEndEditable -->
  </body>
<!-- InstanceEnd --></html>
