<?php
if (!isset($_SESSION)) {
  session_start();
}
$upload_dir = "images/temp/";
$upload_path = $upload_dir."/";	
$large_image_name = "resized_pic.jpg";
$thumb_image_name = "thumbnail_pic.jpg";
$max_file = "5242880";
$max_width = "1000";
$thumb_width = "80";
$thumb_height = "80";

function resizeImage($image,$width,$height,$scale) {
  $newImageWidth = ceil($width * $scale);
  $newImageHeight = ceil($height * $scale);
  $newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
  $source = imagecreatefromjpeg($image);
  imagecopyresampled($newImage,$source,0,0,0,0,$newImageWidth,$newImageHeight,$width,$height);
  imagejpeg($newImage,$image,90);
  chmod($image, 0777);
  return $image;
}

function resizeThumbnailImage($thumb_image_name, $image, $width, $height, $start_width, $start_height, $scale){
  $newImageWidth = ceil($width * $scale);
  $newImageHeight = ceil($height * $scale);
  $newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
  $source = imagecreatefromjpeg($image);
  imagecopyresampled($newImage,$source,0,0,$start_width,$start_height,$newImageWidth,$newImageHeight,$width,$height);
  imagejpeg($newImage,$thumb_image_name,90);
  chmod($thumb_image_name, 0777);
  return $thumb_image_name;
}

function getHeight($image) {
  $sizes = getimagesize($image);
  $height = $sizes[1];
  return $height;
}

function getWidth($image) {
  $sizes = getimagesize($image);
  $width = $sizes[0];
  return $width;
}

$large_image_location = $upload_path.$large_image_name;
$thumb_image_location = $upload_path.$thumb_image_name;

if(!is_dir($upload_dir)){
  mkdir($upload_dir, 0777);
  chmod($upload_dir, 0777);
}

if (file_exists($large_image_location)){
  if(file_exists($thumb_image_location)){
	$thumb_photo_exists = "<img src=\"".$upload_path.$thumb_image_name."\" alt=\"Thumbnail Image\"/>";
  }else{
	$thumb_photo_exists = "";
  }
  $large_photo_exists = "<img src=\"".$upload_path.$large_image_name."\" alt=\"Large Image\"/>";
} else {
  $large_photo_exists = "";
  $thumb_photo_exists = "";
}

if (isset($_POST["upload"])) { 
  $userfile_name = $_FILES['image']['name'];
  $userfile_tmp = $_FILES['image']['tmp_name'];
  $userfile_size = $_FILES['image']['size'];
  $filename = basename($_FILES['image']['name']);
  $file_ext = substr($filename, strrpos($filename, '.') + 1);
  if((!empty($_FILES["image"])) && ($_FILES['image']['error'] == 0)) {
		if (($file_ext!="jpg") && ($userfile_size > $max_file)) {
			$error= "ONLY jpeg images under 1MB are accepted for upload";
		}
  }else{
	$error= "Select a jpeg image for upload";
  }
  if (strlen($error)==0){
	if (isset($_FILES['image']['name'])){
	  move_uploaded_file($userfile_tmp, $large_image_location);
	  chmod($large_image_location, 0777);
	  
	  $width = getWidth($large_image_location);
	  $height = getHeight($large_image_location);
	  if ($width > $max_width){
		$scale = $max_width/$width;
		$uploaded = resizeImage($large_image_location,$width,$height,$scale);
	  }else{
		$scale = 1;
		$uploaded = resizeImage($large_image_location,$width,$height,$scale);
	  }
	  if (file_exists($thumb_image_location)) {
		unlink($thumb_image_location);
	  }
	}
	$_SESSION["popo"] = 2;
	header("location:".$_SERVER["PHP_SELF"]);
	exit();
  }
}

if (isset($_POST["upload_thumbnail"]) && strlen($large_photo_exists)>0) {
  $x1 = $_POST["x1"];
  $y1 = $_POST["y1"];
  $x2 = $_POST["x2"];
  $y2 = $_POST["y2"];
  $w = $_POST["w"];
  $h = $_POST["h"];
  $scale = $thumb_width/$w;
  $cropped = resizeThumbnailImage($thumb_image_location, $large_image_location,$w,$h,$x1,$y1,$scale);
	header("location:".$_SERVER["PHP_SELF"]);
  exit();
}

if(strlen($large_photo_exists)>0 && strlen($thumb_photo_exists)>0){
  $usrCode = date("YmdHis");
  $file = 'images/temp/resized_pic.jpg';
  $newfile = 'images/gallery/main/'.$usrCode.'.jpg';
  
  if (!copy($file, $newfile)) {
	echo "failed to copy $file...\n";
  }
  $file = 'images/temp/thumbnail_pic.jpg';
  $newfile = 'images/gallery/thumb/'.$usrCode.'.jpg';
  
  if (!copy($file, $newfile)) {
	echo "failed to copy $file...\n";
  }
  unlink("images/temp/resized_pic.jpg");
  unlink("images/temp/thumbnail_pic.jpg");
  
	$stamp = imagecreatefrompng('images/watermark.png');
	$im = imagecreatefromjpeg('images/gallery/main/'.$usrCode.'.jpg');
	
	$marge_right = 6;
	$marge_bottom = 6;
	$sx = imagesx($stamp);
	$sy = imagesy($stamp);
	
	imagecopy($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));
  imagejpeg($im,'images/gallery/main/'.$usrCode.'.jpg',90);
	unset($_SESSION['popo']);
  header("location: add-gallery-image.php");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <title>Add Gallery Image</title>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex,nofollow">
    <meta name="description" content="">
    <link href="/scripts/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="/scripts/bootstrap/css/font-awesome.min.css" rel="stylesheet">
    <link href="/scripts/bootstrap/css/navbar.css" rel="stylesheet">
    <script src="/scripts/bootstrap/js/jquery-1.11.3.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="/scripts/bootstrap/js/jquery-pack.js"></script>
    <script type="text/javascript" src="/scripts/bootstrap/js/jquery.imgareaselect-0.3.min.js"></script>
    <link href="/scripts/bootstrap/css/style.css" rel="stylesheet">
  </head>
  <body>
    <?php include ("scripts/template/header.php");?>
    <?php include ("scripts/template/nav.php");?>
    <div class="container-fluid text-center">    
      <div class="row content">
        <div class="col-lg-12 text-left"> 
          <div class="row">
            <div class="container-fluid">
              <div class="spacer"></div>
              <div class="well">
              <div id="bodycontent">
              <?php
                  if(strlen($large_photo_exists)>0){
                  $current_large_image_width = getWidth($large_image_location);
                  $current_large_image_height = getHeight($large_image_location);?>
              <script type="text/javascript">
                  function preview(img, selection) { 
                  var scaleX = <?php echo $thumb_width;?> / selection.width; 
                  var scaleY = <?php echo $thumb_height;?> / selection.height; 
                  $('#thumbnail + div > img').css({ 
                    width: Math.round(scaleX * <?php echo $current_large_image_width;?>) + 'px', 
                    height: Math.round(scaleY * <?php echo $current_large_image_height;?>) + 'px',
                    marginLeft: '-' + Math.round(scaleX * selection.x1) + 'px', 
                    marginTop: '-' + Math.round(scaleY * selection.y1) + 'px' 
                  });
                  $('#x1').val(selection.x1);
                  $('#y1').val(selection.y1);
                  $('#x2').val(selection.x2);
                  $('#y2').val(selection.y2);
                  $('#w').val(selection.width);
                  $('#h').val(selection.height);
                  } 
                  $(document).ready(function () { 
                    $('#save_thumb').click(function() {
                    var x1 = $('#x1').val();
                    var y1 = $('#y1').val();
                    var x2 = $('#x2').val();
                    var y2 = $('#y2').val();
                    var w = $('#w').val();
                    var h = $('#h').val();
                    if(x1=="" || y1=="" || x2=="" || y2=="" || w=="" || h==""){
                      alert("You must make a selection first");
                      return false;
                    }else{
                      return true;
                    }
                    });
                  }); 
                  $(window).load(function () { 
                    $('#thumbnail').imgAreaSelect({ aspectRatio: '1:1', onSelectChange: preview }); 
                  });
                  </script>
              <?php }?>
              <h1>Add New Picture To Gallery</h1>
              <?php
                  if (strlen($error) > 0) {
                    echo "<ul><li><strong>Error!</strong></li><li>".$error."</li></ul>";
                  }
                  if(strlen($large_photo_exists) > 0 && strlen($thumb_photo_exists) > 0) {
                    echo "";
                  } else {
                  if (strlen($large_photo_exists )> 0) { ?>
              <h2>Create Thumbnail</h2>
              <br><br>
              <div align="center">
                <img src="<?php echo $upload_path.$large_image_name;?>" style="float: left; margin-right: 10px;" id="thumbnail" alt="Create Thumbnail">
                <div style="float:left; position:relative; overflow:hidden; width:<?php echo $thumb_width;?>px; height:<?php echo $thumb_height;?>px;">
                  <img src="<?php echo $upload_path.$large_image_name;?>" style="position: relative;" alt="Thumbnail Preview">
                </div>
                <br style="clear:both;"/>
                <form name="thumbnail" action="" method="post">
                  <input type="hidden" name="x1" value="" id="x1">
                  <input type="hidden" name="y1" value="" id="y1">
                  <input type="hidden" name="x2" value="" id="x2">
                  <input type="hidden" name="y2" value="" id="y2">
                  <input type="hidden" name="w" value="" id="w">
                  <input type="hidden" name="h" value="" id="h">
                  <br>
                  <input type="submit" name="upload_thumbnail" value="Save Thumbnail" id="save_thumb" class="btn btn-default">
                </form>
              </div>
              <hr />
              <?php } ?>
              <?php if (!isset($_SESSION["popo"])) { ?>
                <br><br>
                <h2>Upload Photo</h2>
                <br><br>
                <div class="cpform cpformstyle">
                  <form name="photo" enctype="multipart/form-data" action="" method="post">
                    <div class="form-group">
                      <label for="image">Photo</label>
                      <input class="form-control" name="image" id="image" type="file">
                    </div>                    
                    <br>
                    <button class="btn btn-default" type="submit" name="upload">UPLOAD</button>
                  </form>
                </div>
                <?php } ?>
              <?php } ?>
              </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php include ("scripts/template/footer.php");?>
    <script src="/scripts/bootstrap/js/bootstrap.min.js"></script>
    <script>$(document).ready(function(){ $('[data-toggle="tooltip"]').tooltip(); });</script>
</body>
</html>
