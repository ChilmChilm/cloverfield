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

  $page       = 'page-contact.php';
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


    <div class="row max">
    
    <?php include "menu-left.php"; ?>
    
      <div class="twothird container">
         
        <h1><i class="fa fa-envelope-o"></i> <?php echo $LANG['CONTACT'] ?></h1> 
        
        <hr>
           
        <form method="post" action="forms/send-contact.php" id="contact-form" name="contact-form" novalidate="novalidate">
        	
				<table>
					<tbody>
				
           <tr>
            <td width="30%"><?php echo $LANG['CONTACT_METHOD'] ?>:</td>
            <td width="5%">&nbsp;</td>
            <td width="65%">
	            <select name="contactmethode">
	              <option value="Niet gekozen"><?php echo $LANG['MAKE_CHOICE'] ?></option>
	              <option value="<?php echo $LANG['PHONE'] ?>"><?php echo $LANG['PHONE'] ?></option>
	              <option value="<?php echo $LANG['EMAIL'] ?>"><?php echo $LANG['EMAIL'] ?></option>
	              <option value="<?php echo $LANG['CONTACT_METHOD_TXT'] ?>"><?php echo $LANG['CONTACT_METHOD_TXT'] ?></option>
	            </select>	                	
            </td>
          </tr>	
          
           <tr>
            <td><?php echo $LANG['SALUATION'] ?>:</td>
            <td></td>
            <td>
	            <select name="aanhef">
	              <option value="Man"><?php echo $LANG['MR'] ?>.</option>
	              <option value="Vrouw"><?php echo $LANG['MS'] ?>.</option>
	            </select>	                	
            	
            </td>
          </tr>	
          
           <tr>
            <td><?php echo $LANG['NAME'] ?>:*</td>
            <td></td>
            <td><input type="text" name="naam"></td>
          </tr>
          
           <tr>
            <td><?php echo $LANG['PHONE'] ?>:</td>
            <td></td>
            <td><input type="text" name="telefoon"></td>
          </tr>
          
           <tr>
            <td><?php echo $LANG['EMAIL'] ?>:*</td>
            <td></td>
            <td><input type="text" name="email"></td>
          </tr>
          
           <tr>
            <td valign="top"><?php echo $LANG['REMARKS'] ?>:</td>
            <td></td>
            <td><textarea name="opmerkingen"></textarea></td>
          </tr>

           <tr>
             <td valign="top"><?php echo $LANG['THE_ANSWER'] ?>:</td>
             <td></td>
             <td><?php echo $first; ?> + <?php echo $last; ?> = <input type="text" name="verify" id="verify" style="width: 155px" placeholder=" <?php echo $LANG['THE_ANSWER'] ?>"/></td>
           </tr>
          
           <tr>
            <td></td>
            <td></td>
            <td><br><button type="submit" class="btn"> <?php echo $LANG['SEND'] ?> </button></td>
          </tr>                                                                       	                                    	
    	
					</tbody>
				</table>        	
					
        </form>
        <br>  
        <br>
        <div class="container border-bottom margin">&nbsp;</div>
        <br>
			  <h1><i class="fa fa-hand-o-right"></i> Gegevens</h1>
			  <br>
			  <div class="half left">
					<b><?php echo $config['shop_name']; ?></b><br>
					<?php echo $config['shop_address']; ?><br>
					<?php echo $config['shop_zip'].' '.$config['shop_city']; ?><br>
					<?php echo $config['shop_country']; ?><br>
					<br>
					M: <?php echo $config['shop_mobile']; ?><br>
			  </div>
			  
			  <div class="half padding right">
					<?php echo $config['shop_bank_name']; ?><br>
					<?php echo $config['shop_bank_bic']; ?><br>
					<?php echo $config['shop_bank_iban']; ?><br>
					<br>
					E: <?php echo '<a href="mailto:'.$config['site_email_info'].'">'.$config['site_email_info'].'</a>'; ?><br>
					<br>
					Zie verder onze: <a href="Algemene-Voorwaarden-T-35" target="_blank"><i class="fa fa-arrow-right fa-fw"></i> Algemene voorwaarden</a><br>
					Zie verder onze: <a href="Disclaimer-T-36" target="_blank"><i class="fa fa-arrow-right fa-fw"></i> Disclaimer</a><br>                    		  	
			  </div>			  
						
      </div>
    
    </div> <!-- EOF row  -->  

    <?php include 'footer.php'; ?>

  </body>

</html>