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
    
  <!--https://jqueryui.com/datepicker/#icon-trigger-->
   <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
    
    <script type="text/javascript">
      $(function() {
        $( "#datepicker, #datepicker_2, #datepicker_3" ).datepicker({
          showOn:          "button",
          buttonImage:     "layout/calendar.png",
          buttonImageOnly: true,
          monthNames:      ['Januari','Februari','Maart','April','Mei','Juni','Juli','Augustus','September','Oktober','November','December'],
          monthNamesShort: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Aug','Sep','Okt','Nov','Dec'],
          dayNames:        ['Zondag','Maandag','Dinsdag','Woensdag','Donderdag','Vrijdag','Zaterdag'],
          dayNamesShort:   ['Zo','Ma','Di','Wo','Do','Vr','Za'],
          dayNamesMin:     ['Zo','Ma','Di','Wo','Do','Vr','Za'],
          clearText:       '-',
          clearStatus:     '',
          closeText:       'Sluiten', closeStatus: '',
          todayText:       'Vandaag', todayStatus: '',
          prevText:        '&laquo; Terug',
          prevStatus:      '',
          prevJumpText:    '&#x3c;&#x3c;',
          prevJumpStatus:  '',
          nextText:        'Vooruit &raquo;',
          nextStatus:      '',
          nextJumpText:    '&#x3e;&#x3e;',
          nextJumpStatus:  '',
          dateFormat:      'dd-mm-yy',
        });
      });

      $(theElement).css('height','30px').css('width','30px');
    </script> 
       
  </head>

  <body id="top">

  <?php include "header.php"; ?>

    <div class="row max">
    
    <?php include "menu-left.php"; ?>
    
      <div class="twothird container">
			      <h1><?php echo $LANG['RETOUR'] ?> <?php echo $config['shop_name']; ?></h1>
						<?php if($_SESSION['language'] == 'nl' ) { ?>
						Retourzendingen zijn uitsluitend mogelijk met het formulier die u ontvangt via e-mail na het volledig invullen van onderstaande gegevens. <b>Let op:</b> stuur onder geen beding artikelen retour zonder de te ontvangen adressticker met het ticketnummer (u ontvangt deze per e-mail).<br>
						<br>
						<?php } ?>
						<?php echo $LANG['RETURN_TEXT'] ?>
	          <hr>
	          <br>						
						<form method="post" action="forms/send-retour.php" id="retour-form" name="retour-form" novalidate="novalidate" enctype="multipart/form-data">

	          <table>
	          <tbody>
						
               <tr>
                <td width="30%"><?php echo $LANG['SALUATION'] ?>:</td>
                <td width="5%">&nbsp;</td>
                <td width="65%"><i class="fa fa-male text-black-opacity fa-2x"></i> <input type="radio" name="saluation" value="Hr." class="input_short" checked> <i class="fa fa-female text-black-opacity fa-2x"></i> <input type="radio" name="saluation" value="Mw." class="input_short"></td>
              </tr>							
							
							<tr>
								<td><?php echo $LANG['COMPANYNAME'] ?>:<br><sup><?php echo $LANG['EVENTUAL'] ?>.</sup></td>
								<td>&nbsp;</td>
								<td><input type="text" name="companyname"></td>
							</tr>	
								
							<tr>
								<td><?php echo $LANG['FIRSTNAME'] ?>:*</td>
								<td>&nbsp;</td>
								<td><input type="text" name="firstname"></td>
							</tr>	
																										
							<tr>
								<td><?php echo $LANG['LASTNAME'] ?>:*</td>
								<td>&nbsp;</td>
								<td><input type="text" name="surname"></td>
							</tr>	
																						
              <tr>
                <td><?php echo $LANG['STREET'] ?>:*</td>
                <td></td>
                <td><input type="text" name="invoice_street" value="">&nbsp;&nbsp;Nr:&nbsp;&nbsp;<input type="text" name="invoice_street_nr" value="" style="width: 7% !important;"></td>
              </tr>
							
							<tr>
								<td><?php echo $LANG['ZIP'] ?>:*</td>
								<td></td>
								<td><input type="text" name="invoice_zip"></td>
							</tr>		
									
							<tr>
								<td><?php echo $LANG['CITY'] ?>:*</td>
								<td></td>
								<td><input type="text" name="invoice_city"></td>
							</tr>
							
							<tr>
								<td><?php echo $LANG['COUNTRY'] ?>:*</td>
								<td></td>
								<td>
									<select name="invoice_country">
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
								<td><input type="text" name="phone"></td>
							</tr>
							
							<tr>
								<td><?php echo $LANG['EMAIL'] ?>:*</td>
								<td></td>
								<td><input type="text" name="email"></td>
							</tr>
              
              <tr>
                <td valign="top"><?php echo $LANG['PICTURE'] ?>:</td>
                <td></td>  
                <td><input name="image_file" type="file" id="bestand" style="border: none;"></td>
              </tr>             
              
							<tr>
								<td valign="top"><?php echo $LANG['REASON_RETURN'] ?>:</td>
								<td></td>	
								<td><textarea name="remarks"></textarea></td>
							</tr>	
							
							<tr>
								<td colspan="3">
									
				          <table>
				          <tbody>
										<tr>
											<td colspan="7"><hr></td>
										</tr>													
										<tr>
											<td width="28%"><b><?php echo $LANG['ARTICLE_NR'] ?>:</b></td>
											<td width="5%">&nbsp;</td>
											<td width="28%"><b><?php echo $LANG['PIECES'] ?>:</b></td>
											<td width="5%">&nbsp;</td>
											<td width="28%"><b><?php echo $LANG['RECEIVED'] ?>:</b></td>
											<td width="5%">&nbsp;</td>
											<td width="28%"><b><?php echo $LANG['INVOICE_NR'] ?>:</b></td>	
										</tr>
										<tr>
											<td colspan="7"><hr></td>
										</tr>
										<tr>
											<td><input type="text" name="sku[]"></td>
											<td></td>
											<td>
												<select name="number[]">
												<?php for ($i=1; $i<=100; $i++) { ?>
													<option value="<?php echo $i;?>"><?php echo $i;?></option>
												<?php } ?>													
												</select>
											</td>
											<td></td>
											<td><input type="text" name="received[]" id="datepicker"> </td>
											<td></td>
											<td><input type="text" name="invoice[]"></td>
										</tr>
										<tr>
											<td><input type="text" name="sku[]"></td>
											<td></td>
											<td>
												<select name="number[]">
												<?php for ($i=1; $i<=100; $i++) { ?>
													<option value="<?php echo $i;?>"><?php echo $i;?></option>
												<?php } ?>													
												</select>
											</td>
											<td></td>
											<td><input type="text" name="received[]" id="datepicker_2"> </td>
											<td></td>
											<td><input type="text" name="invoice[]"></td>
										</tr>	
										<tr>
											<td><input type="text" name="sku[]"></td>
											<td></td>
											<td>
												<select name="number[]">
												<?php for ($i=1; $i<=100; $i++) { ?>
													<option value="<?php echo $i;?>"><?php echo $i;?></option>
												<?php } ?>													
												</select>
											</td>
											<td></td>
											<td><input type="text" name="received[]" id="datepicker_3"> </td>
											<td></td>
											<td><input type="text" name="invoice[]"></td>
										</tr>	
                    <tr>
                      <td colspan="7"><hr></td>
                    </tr>                    
				          </tbody>
				          </table>
								
								</td>
							</tr>
							
              <tr>
                <td valign="top"><?php echo $LANG['THE_ANSWER'] ?>:</td>
                <td></td>
                <td><?php echo $first; ?> + <?php echo $last; ?> = <input type="text" name="verify" id="verify" style="width: 155px" placeholder=" <?php echo $LANG['THE_ANSWER'] ?>"/></td>
              </tr>
              
              <tr>
                <td colspan="3"><hr></td>
              </tr> 
                                         
							<tr>
								<td colspan="3">
                  <br>
                  <input type="checkbox" name="accoord" class="input_no_left"> *<?php echo $LANG['AGREED'] ?>: <a href="<?php echo ''.str_replace(' ','-','Algemene Voorwaarden').'-T-35.html' ?>" target="_blank">Leveringsvoorwaarden <i class="fa fa-arrow-right text-black-opacity"></i></a><br>
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