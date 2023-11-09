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

  $first = random_int(1, 12);
  $last  = random_int(10, 15);
  $_SESSION['answer'] = ($first + $last);
   	
	include 'includes/globals.php';

	$page       = 'customer-reset.php'; 
	$menu_right = 0;
  $ip_address = $_SERVER['REMOTE_ADDR'];
?>

<!DOCTYPE HTML>

<html lang="en-NL">

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf8">
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
        
        <h2>Wachtwoord vergeten.</h2>
        Vul onderstaand het emailadres in waarmee u bij ons registreerde, u ontvangt dan per omgaande de activeringscode in uw mailbox.<br>
        <br>
        U kunt daarna activeren, inloggen en eventueel uw wachtwoord weer veranderen (aangeraden).<br>
        Heeft u nog vragen bel met ons team:&nbsp;&nbsp;<b><i class="fa fa-phone fa-lg"></i>&nbsp;&nbsp;<?php echo $config['shop_phone']; ?></b><br>
        <br>
        <hr>
        <br>
        
        <form action="forms/send-customer-reset.php" method="post"  id="reset-form" name="reset-form" novalidate="novalidate">
        <input type="hidden" name="ip_address" value="<?php echo $ip_address; ?>" />

        <table>
          <tbody>
            <tr>
              <td>Uw emailadres:</td>
              <td width="20">&nbsp;</td>
              <td><input type="text" name="email" class="input250" value="" /></td>
            </tr>
            <tr>
              <td>Nieuwe wachtwoord:</td>
              <td></td>
              <td><input type="password" name="new_password" class="input250" value="" /></td>
            </tr>
           <tr>
             <td valign="top"><?php echo $LANG['THE_ANSWER'] ?>:</td>
             <td></td>
             <td><?php echo $first; ?> + <?php echo $last; ?> = <input type="text" name="verify" id="verify" style="width: 155px" placeholder=" <?php echo $LANG['THE_ANSWER'] ?>"/></td>
           </tr>
            <tr>
              <td></td>
              <td></td>
              <td><br><button type="submit" name="inloggen" class="btn">Versturen</button></td>
            </tr>
          </tbody>
        </table>

        </form>
        
      </div>
    
    </div> <!-- EOF row  -->  

  <?php include 'footer.php'; ?>

  </body>
  
</html>