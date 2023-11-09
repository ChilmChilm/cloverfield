<?php 
/*************************************************
 Copyright : (C) 2021 - Cloverfield
 Mail: chilm@planet.nl
 Change date : 06 - 10 - 2021
**************************************************/
	header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
	header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
	header("Cache-Control: post-check=0, pre-check=0",false);
	session_cache_limiter("must-revalidate");
			
	session_start();	
  
	include 'includes/globals.php';
  
  $page       = 'page-closed.php'; 
	$menu_right = 0;
	
	$query = mysqli_query($conn, "SELECT * FROM clo_text WHERE idx = 59");
	$content = mysqli_fetch_array($query);
?>
<!DOCTYPE HTML>

<html lang="en-NL">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width">
		<title><?php echo $config['site_title']; ?></title>
		<meta name="Description" content="<?php echo $config['site_description']; ?>" />
		<meta name="Keywords" content="<?php echo $config['site_keywords']; ?>" />
		<?php include "header-meta.php"; ?>
	</head>
	
	<body id="top">
	
    <div class="container center padding-64 max">
      
		  <img src="layout/logo.png"><br>
			<br>
      <?php echo $content['text_body_'.$_SESSION['language'].'']; ?><br>  
      <br>
      <a href="mailto:<?php echo $config['site_email_info'] ?>"><i class="fa fa-envelope-o fa-lg"></i> <?php echo $config['site_email_info'] ?></a>
      <br> 
      
    </div>
	
	</body>
	
</html>