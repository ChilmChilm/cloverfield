<?php 
/***********************************************
 Copyright : (C) 2021 - Cloverfield
 Mail: chilm@planet.nl
 Change date : 06 - 10 - 2021
 ***********************************************/
	header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
	header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
	header("Cache-Control: post-check=0, pre-check=0",false);
	session_cache_limiter("must-revalidate");		
	
	session_start();	
  
	include 'includes/globals.php';
  
  $page       = 'text.php'; 
	$menu_right = 0;
	
	isset($_REQUEST['id']) ? $idx = mysqli_real_escape_string($conn, $_REQUEST['id']) : $idx = '';

	$query   = mysqli_query($conn, "SELECT * FROM clo_text WHERE idx = '".$idx."'");
	$content = mysqli_fetch_array($query);

?>
<!DOCTYPE HTML>

<html lang="en-NL">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf8">
		<meta name="viewport" content="width=device-width">
		<title><?php $content['text_title_'.$_SESSION['language'].''] ?> - <?php echo $config['shop_name'] ?></title>
		<meta name="Description" content="<?php echo $config['site_description'] ?>" />
		<meta name="Keywords" content="<?php echo $config['site_keywords'] ?>" />
		<?php include "header-meta.php" ?>
	</head>
	
	<body id="top">

    <?php include "header.php"; ?>

    <div class="row max">
    
    <?php include "menu-left.php"; ?>
    
      <div class="twothird container text">
      
        <h1><?php echo $content['text_title_'.$_SESSION['language'].''] ?></h1>

        <?php echo $content['text_body_'.$_SESSION['language'].''] ?>
        
      </div>
    
    </div>

		<?php include 'footer.php'; ?>
	
	</body>
	
</html>