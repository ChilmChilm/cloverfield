<?php
/*************************************************
 Copyright : (C) 2021 - Cloverfield
 Mail: chilm@planet.nl
 Change date : 06 - 10 - 2021
**************************************************/
	session_start();
	include "includes/globals.php";
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

	<body>

		<?php include "header.php"; ?>

    <div align="center" class="row">
    
      <div class="evo_page">
  
		    <h1>Oops...</h1>
		    <p>
			    <img src="layout/404.jpg" alt="Onze excuses" width="50%"><br>
			    <br>
			    Oops wrong page or page does not exist anymore.<br>
          Click&nbsp;&nbsp;&nbsp;<a href="index.php" title="Naar onze homepage...">here <i class="fa fa-arrow-right text-black-opacity"></i></a>&nbsp;&nbsp;&nbsp;to jump to the homepage.<br />
		    </p>

    </div> <!-- end evo_page  -->    
    
	</div> <!-- end row  -->

		<?php include "footer.php"; ?>

	</body>

</html>