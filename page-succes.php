<?php 
/*************************************************
 Copyright : (C) 2021 - Cloverfield
 Mail: chilm@planet.nl
 Change date : 06 - 10 - 2021
**************************************************/
  session_start();

  header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
	header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
	header("Cache-Control: post-check=0, pre-check=0",false);

	include 'includes/globals.php'; 
	$menu_right = 0;
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
	
		<?php include "header.php"; ?>
		
    <div align="center" class="row max">
    
      <div class="evo_page">
      
			  <h1><?php echo $LANG['YOUR_ORDER_AT'] ?> <?php echo $config['shop_name']; ?></h1>
				<br>
        <i class="fa fa-thumbs-o-up text-green fa-5x"></i><br>
        <br>
        <p>
          <b class="font_125"><?php echo $LANG['YOUR_ORDER_SUCCES'] ?>.</b><br>
          <?php echo $LANG['YOUR_ORDER_CONTROL'] ?><br>
				  <em><?php echo $LANG['YOUR_ORDER_NICE'] ?></em><br>
				  <br>
          <a title="Naar de homepage..." href="index.php"><i class="fa fa-home text-green fa-3x"></i></a>
        </p>
        
      </div>
    
    </div> <!-- EOF row  -->

		<?php include 'footer.php'; ?>	
	
	</body>
	
</html>