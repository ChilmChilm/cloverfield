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

  $page       = 'page-retour.php';
  $menu_right = 0;
?>
<!DOCTYPE HTML>

<html lang="en-NL">

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width">
    <title><?php echo $config['site_title']; ?></title>
    <meta name="Description" content="<?php echo $config['site_description']; ?>">
    <meta name="Keywords" content="<?php echo $config['site_keywords']; ?>">
    <?php include "header-meta.php"; ?>
  </head>

  <body id="top">

  <?php include "header.php"; ?>


    <div align="center" class="row max">
    
      <div class="evo_page">
      	
			  <h1><?php echo $LANG['LOGIN_CUSTOMERS'] ?></h1>
			  
			  <div class="padding-48">
				<form method="post" action="login-action.php">
					
				<table class="padding" align="center">
				<tbody>
					<tr>
						<td><?php echo $LANG['USERNAME'] ?>:</td>
						<td>&nbsp;</td>
						<td><input type="text" name="username"></td>
					</tr>
					<tr>
						<td><?php echo $LANG['PASSWORD'] ?>:&nbsp;&nbsp;</td>
						<td></td>
						<td><input type="password" name="password"></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td><button type="submit" name="submit" class="btn"><?php echo $LANG['LOGIN'] ?></button></td>
					</tr>
					<tr>
						<td colspan="3">
						  <br>
              <br>
              <br>
              <br>
						  <?php echo $LANG['FORGOT_PASSWORD'] ?>: <a href="customer-reset.php"><i class="fa fa-arrow-right text-green fa-lg"></i></a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<?php echo $LANG['REGISTER'] ?>: <a href="customer-register.php"><i class="fa fa-arrow-right text-green fa-lg"></i></a><br>
						</td>
					</tr>					
				</tbody>
				</table>


				</form>	
				
				</div>
								
      </div>
    
    </div> <!-- EOF row  -->  

    <?php include 'footer.php'; ?>

  </body>

</html>