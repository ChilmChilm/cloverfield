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

	$page       = 'customer-register.php';
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
      
		      <h1><?php echo $LANG['REGISTER'] ?></h1>
		      <hr>

          <h1><?php echo $LANG['REGISTER_WHY'] ?> <?php echo $config['shop_name']; ?></h1>
          
					<?php echo $LANG['REGISTER_WHY_2'] ?>
          <br>
		      <hr>
		      <b><?php echo $LANG['ADDRESS_INFO'] ?>:</b><br>
		      <?php echo $LANG['FIELDS_REQUIRED'] ?>.<br>
          <hr>
		      <br>
          
          <form method="post" action="forms/send-customer-register.php" id="register-form" name="register-form" novalidate="novalidate">
          <input type="hidden" name="action" value="register">
          
          <table>
          <tbody>
            <tr>
              <td width="30%"><?php echo $LANG['SALUATION'] ?>:</td>
              <td width="5%">&nbsp;</td>
              <td width="65%"><i class="fa fa-male text-black-opacity fa-2x"></i> <input type="radio" name="saluation" value="Hr." class="input_short" checked> <i class="fa fa-female text-black-opacity fa-2x"></i> <input type="radio" name="saluation" value="Mw." class="input_short"></td>
            </tr>
            
            <tr>
              <td><?php echo $LANG['COMPANYNAME'] ?>:<br><sup><?php echo $LANG['EVENTUAL'] ?></sup></td>
              <td></td>
              <td><input type="text" name="companyname" value=""></td>
            </tr>             
            
            <tr>
              <td><?php echo $LANG['FIRSTNAME'] ?>:*</td>
              <td></td>
              <td><input type="text" name="firstname" value=""></td>
            </tr>                     

            <tr>
              <td><?php echo $LANG['LASTNAME'] ?>:*</td>
              <td></td>
              <td><input type="text" name="surname" value=""></td>
            </tr>

            <tr>
              <td><?php echo $LANG['STREET'] ?>:*</td>
              <td></td>
              <td><input type="text" name="invoice_street" value="">&nbsp;&nbsp;Nr:&nbsp;&nbsp;<input type="text" name="invoice_street_nr" value="" style="width: 7% !important;"></td>
            </tr>           

            <tr>
              <td><?php echo $LANG['ZIP'] ?>:*</td>
              <td></td>
              <td><input type="text" name="invoice_zip" value=""></td>
            </tr>

            <tr>
              <td><?php echo $LANG['CITY'] ?>:*</td>
              <td></td>
              <td><input type="text" name="invoice_city" value=""></td>
            </tr>

            <tr>
              <td><?php echo $LANG['COUNTRY'] ?>:*</td>
              <td></td>
              <td>
                <select name="invoice_country" class="input250_drop">
                  <option value="Nederland">      Nederland</option>
                  <option value="Belgie">         Belgie</option>
                  <option value="Canada">         Canada</option>
                  <option value="Denmark">        Denmark</option>
                  <option value="Deutschland">    Deutschland</option>
                  <option value="Espagna">        Espagna</option>
                  <option value="Finland">        Finland</option>
                  <option value="France">         France</option>
                  <option value="Iceland">        Iceland</option>
                  <option value="Ireland">        Ireland</option>
                  <option value="Italia">         Italia</option>
                  <option value="Norway">         Norway</option>
                  <option value="Poland">         Poland</option>
                  <option value="Portugal">       Portugal</option>
                  <option value="Sweden">         Sweden</option>
                  <option value="United Kingdom"> United Kingdom</option>
                  <option value="United States">  United States</option>
                </select>
              </td>
            </tr>

            <tr>
              <td><?php echo $LANG['PHONE'] ?>:*</td>
              <td></td>
              <td><input type="text" name="phone" value=""></td>
            </tr>

            <tr>
              <td>E-mail:*</td>
              <td></td>
              <td><input type="text" name="email" value=""></td>
            </tr>

            <tr>
              <td><?php echo $LANG['USERNAME'] ?>:</td>
              <td></td>
              <td class="td_height">*<sup><?php echo $LANG['ACTIVATE_SUCCESS_TXT_2'] ?>.</sup></td>
            </tr>
            
            <tr>
              <td><?php echo $LANG['PASSWORD'] ?>:*</td>
              <td></td>
              <td><input type="text" name="password" value=""></td>
            </tr>

            <tr>
              <td valign="top"><br><?php echo $LANG['REMARKS'] ?>:</td>
              <td></td>
              <td><br><textarea type="text" name="order_remarks"></textarea></td>
            </tr>

            <tr>
             <td valign="top"><?php echo $LANG['THE_ANSWER'] ?>:</td>
             <td></td>
             <td><?php echo $first; ?> + <?php echo $last; ?> = <input type="text" name="verify" id="verify" style="width: 155px" placeholder=" <?php echo $LANG['THE_ANSWER'] ?>"/></td>
            </tr>

            <tr>
              <td valign="top"></td>
              <td></td>
              <td>
                <br>
                <button type="submit" class="btn"><?php echo $LANG['SEND'] ?></button><br>
                <?php if($_SESSION['language'] == 'nl' ) { ?>
                <br>
                <sup>Wij willen u er op wijzen dat het niet is toegestaan om als klant bewust<br>onjuiste informatie te verschaffen bij het registreren op deze website.</sup>
                <br>
                <?php } ?>
                <br>
                <p><a onclick="JavaScript:window.print()" href="#"><i class="fa fa-print text-black-opacity fa-lg"></i> <?php echo $LANG['PRINT'] ?></a></p>
              </td>
            </tr>
          </tbody>
          </table>
          </form>

      </div>
    
    </div> <!-- EOF row  -->  

		<?php include 'footer.php'; ?>

	</body>

</html>