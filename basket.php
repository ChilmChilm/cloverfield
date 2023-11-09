<?php
/***********************************************
 Copyright : (C) 2021 - Cloverfield
 Mail: chilm@planet.nl
 Change date : 06 - 10 - 2021
 **********************************************/
	header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
	header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
	header("Cache-Control: post-check=0, pre-check=0",false);
	session_cache_limiter("must-revalidate");

	session_start(); 
	include 'includes/globals.php';
	$menu_right = 0; 
	error_reporting(E_ALL);
  
  // Alle bestelgegevens ophalen inzake globaal hier tonen en shipping en payment en insurance.
  $fetch = mysqli_query($conn, "SELECT ship_name, ship_price, pay_name, pay_price, fee_insurance 
                                FROM clo_orders_a 
                                WHERE session_id = '".session_id()."' 
                                LIMIT 1
                                ");

  $extra = mysqli_fetch_array($fetch);
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
    
    <!-- Radiobuttons onclick submits -->
    <script>
      $(document).ready(function() {
      
        $('input[name=ship_name]').change(function() {
          $('form[name=form_shipping]').submit();
        });
        
        $('input[name=pay_name]').change(function() {
          $('form[name=form_payment]').submit();
        });
        
        $('input[name=fee_insurance]').change(function() {
          $('form[name=form_insurance]').submit();
        });
      });
    </script>
    
	</head>

	<body id="top">
		
		<?php include "header.php"; ?>

		<div class="container padding max">
    
    <?php
      $check = mysqli_query($conn, "SELECT SUM(price_total) 
                                    AS price_total 
                                    FROM clo_orders_a 
                                    WHERE session_id = '".session_id()."'
                                    ");

      $minimum = mysqli_fetch_array($check);

      // Nog helemaal geen artikelen in het mandje.
      if ($minimum['price_total'] == 0)
      {
   ?>
      
      <h1>Afrekenen is niet mogelijk</h1>
      <p>U heeft (nog) geen artikelen in uw mandje.</p>
      <br>
      <p><a href="index.php"><i class="fa fa-arrow-left text-black-opacity fa-lg"></i>&nbsp;&nbsp;Vorige Pagina</a></p>      
      
    <?php
      }
      else // Als er een minimum aankoopbedrag van toepassing is.
      {
        if($config['minimum_buy'] == 1 AND $minimum['price_total'] <= $config['minimum_buy_amount'])
        {
   ?>
    
      <h1>Afrekenen is nog niet mogelijk</h1>
      <p>Uw aankoopbedrag is: <b><?php echo $config['currency']; ?> <?php echo number_format($minimum['price_total'], 2, ',', '.'); ?></b> en ligt onder de <b><?php echo $config['currency']; ?> <?php echo number_format($config['minimum_buy_amount'], 2, ',', '.'); ?></b> als ons minimaal gestelde aankoopbedrag.</p>
      <br>
      <p><a href="index.php"><i class="fa fa-arrow-left text-black-opacity fa-lg"></i>&nbsp;&nbsp;Vorige Pagina</a></p>
      
    <?php 
      } else {
   ?> 
          
				<h1><?php echo $LANG['FINALIZE_1'] ?></h1>
				
<!-- ================================================================================ LINE ================================================================================ -->            
                        
    <?php
      if($config['tax_included'] == 0) {
				$tax_text = '<p class="medium">'.$LANG['TAX_EXCLUDED_PRICES'].' '.$config['tax_percent'].'% '.$LANG['VAT'].'</p>';
				echo '<p class="medium">'.$LANG['TAX_EXCLUDED_PRICES'].' '.$config['tax_percent'].'% '.$LANG['VAT'].'<br></p>';
				} else {
						$tax_text = '<p class="medium">'.$LANG['TAX_INCLUDED_PRICES'].' '.$config['tax_percent'].'% '.$LANG['VAT'].'</p>';
						echo '<p class="medium">'.$LANG['TAX_INCLUDED_PRICES'].' '.$config['tax_percent'].'% '.$LANG['VAT'].'</p><br>';
			}            
   ?>
            
<!-- ================================================================================ LINE ================================================================================ -->            
            
			<?php
        // Alle bestelgegevens ophalen.
        $query5 = mysqli_query($conn, "SELECT * 
                                       FROM clo_orders_a 
                                       WHERE session_id = '".session_id()."'
                                       ");

				while($order = mysqli_fetch_array($query5))
        {
					$query2 = mysqli_query($conn, "SELECT * 
                                         FROM clo_products 
                                         WHERE idx = '".$order['item_id']."'
                                         ");

					$basket = mysqli_fetch_array($query2);
     ?>
                    
        <div class="padding-top"> 
        	
          <form method="post" action="basket-action.php">
          <input type="hidden" name="action" value="product_adjust">
          <input type="hidden" name="order_idx" value="<?php echo $order['idx']; ?>"> 
              
          <table class="table border">
            <thead>
              <tr class="theme">
                <th colspan="2"><?php echo $LANG['PRODUCT'] ?></th>
              </tr>
            </thead>
            <tbody>
            	
              <tr class="border-bottom">
                <td><b><?php echo $LANG['PRODUCT'] ?>:</b> <a href="products-single.php?id=<?php echo $order['item_id']; ?>"><img src="<?php echo GetMyImages($order['item_id'],1); ?>" height="30"></a></td>
                <td><a href="products-single.php?id=<?php echo $order['item_id']; ?>"><?php echo word_count($basket['product_title_'.$_SESSION['language'].''],6); ?> <i class="fa fa-arrow-circle-right fa-fw text-green"></i></a></td>
              </tr>
              
              <tr class="border-bottom">
                <td><b><?php echo $LANG['PIECES'] ?>:</b></td>
                <td><input type="text" name="quantity" value="<?php echo $order['quantity']; ?>"> <button type="submit" class="button-none"><i class="fa fa-plus-square text-black-opacity fa-lg"></i></button></td>
              </tr>
              
              <tr class="border-bottom">
                <td><b><?php echo $LANG['PRICE_A_PIECE'] ?>:</b></td>
                <td><?php echo $config['currency']; ?> <?php echo number_format($order['price'], 2, ',', '.'); ?></td>
              </tr>
              
            <?php // Als er productopties zijn laat deze rij dan zien bij het bestelde artikel.
            	if(!empty($order['product_option'])) { 
								$string = explode(';',$order['product_option']);
								foreach ($string as $key => $value) {
									$real_value = explode('#',$value);
									// Lege waarde vanwege explode er uit filteren, kan dat ook anders?
									if(!empty($real_value[0])) {
						?>
              <tr class="border-bottom">
              	<td><b><?php echo $LANG['OPTIONS'] ?>:</b></td>
              	<td><?php echo $real_value[0].' '.$real_value[1].' '.$config['currency'].' '.$real_value[2]; ?></td>
              </tr>																
												
						<?php
									}
								}
							} //Einde als er productopties zijn.
						?>               
              
              <tr class="border-bottom">
                <td><b><?php echo $LANG['TOTAL'] ?>:</b></td>
                <td><b><?php echo $config['currency']; ?> <?php echo number_format($order['price_total'], 2, ',', '.'); ?></b></td>
              </tr>

              <tr class="border-bottom">
                <td><b><?php echo $LANG['DELETE'] ?>:</b></td>
                <td><a href="basket-action.php?action=product_delete&product_id=<?php echo $order['item_id']; ?>&order_idx=<?php echo $order['idx']; ?>&page=basket" id="delete_product"><i class="fa fa-trash fa-lg text-red"></i></a></td>
              </tr>
              
            </tbody>
          </table>                                                            
             
          </form>
          
        </div>
                    
			<?php
        }
     ?>
        
<!-- ================================================================================ LINE ================================================================================ -->				
				
      	<div class="padding-top padding-bottom" style="clear: both;">
      		
	      <?php
	        // Moet het in het buitenland afgeleverd worden en wat zijn dan de kosten.
	        if(!empty($config['fee_foreign_delivery'])) {
	          $foreign_txt = '<br>'.$LANG['FOREIGN_1'].' <b>'.$config['currency'].' '.number_format($config['fee_foreign_delivery'], 2, ',', '.').'</b> '.$LANG['FOREIGN_2'].'.<br>';
	          } else {
	              $foreign_txt = '<br>'.$LANG['FOREIGN_3'].' '.$LANG['FOREIGN_4'].'.';
	        }
	        
	        echo $foreign_txt;
	     ?>
      				
      	</div>
           
<!-- ================================================================================ LINE ================================================================================ -->            
            
        <form action="basket-action.php" method="post" name="form_shipping" id="form_shipping" novalidate="novalidate">
        <input type="hidden" name="action" value="calc_shipping">
        
        <p><b><?php echo $LANG['CHOOSE_DELIVERY'] ?>:</b></p>
            
        <table class="table border">
          <tbody>        
        
              <?php
                // Als er gratis verzending van toepassing is.
                if($config['minimum_ship'] == 1)
                {
                  $check_total = mysqli_query($conn, "SELECT SUM(price_total) 
                                                      AS pricetotal 
                                                      FROM clo_orders_a 
                                                      WHERE session_id = '".session_id()."'
                                                      ");

                  $pricetotal = mysqli_fetch_array($check_total);

                  if($pricetotal >= $config['minimum_ship_amount']) {
             ?>
              <tr>
                <td colspan="5">
                  <input type="hidden" name="ship_name" value="Gratis">
                  Uw aankoopbedrag is hoger of gelijk aan <b><?php echo $config['currency']; ?> <?php echo $config['minimum_ship_amount']; ?></b> dus <b>gratis verzending</b> <i class="fa fa-thumbs-up text-grey fa-lg"></i>
                </td>
              </tr>
              <?php
                }
                else
                {
                  // En anders ook hier alle bezorgmethodes ophalen.
                  $query = mysqli_query($conn, "SELECT * 
                                                FROM clo_shipping 
                                                WHERE active = '1' 
                                                ORDER BY sort_order
                                                ");

                  while($ship = mysqli_fetch_array($query)) {

                    if($extra['ship_name'] === $ship['ship_name_'.$_SESSION['language'].''])
                    {
                      $checked = 'checked';
                      $backlight = 'class="safe"';
                    }
                    else
                    {
                      $checked = '';
                      $backlight = '';
                    }

                    // Als de kosten 0.00 zijn laat dan de kosten niet zien.
                    if($ship['ship_price'] === '0.00')
                    {
                   ?>
                      
                    <tr <?php echo $backlight ?>>
                      <td><span class="small"><?php echo $ship['ship_name_'.$_SESSION['language'].'']; ?>:</span></td>
                      <td width="15">&nbsp;</td>
                      <td><input type="radio" style="width: 20px !important; height: 20px !important;" name="ship_name" value="<?php echo $ship['ship_name_'.$_SESSION['language'].'']; ?>" <?php echo $checked; ?>></td>
                      <td width="15">&nbsp;</td>
                      <td><?php if ($ship['ship_price'] == '0.00') { echo $ship['ship_text_'.$_SESSION['language'].'']; } ?></td>
                    </tr>

                    <?php } else { ?>
                      
                    <tr <?php echo $backlight ?>>
                      <td><span class="small"><?php echo $ship['ship_name_'.$_SESSION['language'].'']; ?>:</span></td>
                      <td width="15">&nbsp;</td>
                      <td><input type="radio" style="width: 20px !important; height: 20px !important;" name="ship_name" value="<?php echo $ship['ship_name_'.$_SESSION['language'].'']; ?>" <?php echo $checked; ?>></td>
                      <td width="15">&nbsp;</td>
                      <td><?php echo $LANG['COSTS'] ?>: <b><?php echo $config['currency']; ?> <?php echo number_format($ship['ship_price'], 2, ',', '.'); ?></b></td>
                    </tr>
                      
              <?php
                    }
                  }
                }
              }
              
/* ========================================================== LINE ============================================================ */

              else
              {
                // En anders alle bezorgmethodes ophalen.
                $query = mysqli_query($conn, "SELECT * 
                                              FROM clo_shipping 
                                              WHERE active = '1' 
                                              ORDER BY sort_order
                                              ");

                while($ship = mysqli_fetch_array($query))
                {
                  
                  if($extra['ship_name'] === $ship['ship_name_'.$_SESSION['language'].''])
                  {
                    $checked   = 'checked';
                    $backlight = 'class="safe"';
                  }
                  else
                  {
                    $checked   = '';
                    $backlight = '';
                  }                  
                  
                  // Als de kosten 0.00 zijn laat dan de kosten niet zien.
                  if($ship['ship_price'] == '0.00')
                  {
                 ?>
                  
                    <tr <?php echo $backlight ?>>
                      <td><span class="small"><?php echo $ship['ship_name_'.$_SESSION['language'].'']; ?>:</span></td>
                      <td width="15">&nbsp;</td>
                      <td><input type="radio" style="width: 20px !important; height: 20px !important;" name="ship_name" value="<?php echo $ship['ship_name_'.$_SESSION['language'].'']; ?>" <?php echo $checked; ?>></td>
                      <td width="15">&nbsp;</td>
                      <td><?php if ($ship['ship_price'] == '0.00') { echo $ship['ship_text_'.$_SESSION['language'].'']; } ?></td>
                    </tr>
                    
                  <?php } else { ?>
                  
                    <tr <?php echo $backlight ?>>
                      <td><span class="small"><?php echo $ship['ship_name_'.$_SESSION['language'].'']; ?>:</span></td>
                      <td width="15">&nbsp;</td>
                      <td><input type="radio" style="width: 20px !important; height: 20px !important;" name="ship_name" value="<?php echo $ship['ship_name_'.$_SESSION['language'].'']; ?>" <?php echo $checked; ?>></td>
                      <td width="15">&nbsp;</td>
                      <td><?php echo $LANG['COSTS'] ?>: <b><?php echo $config['currency']; ?> <?php echo number_format($ship['ship_price'], 2, ',', '.'); ?></b></td>
                    </tr>
            <?php
                    }
                  }
                }
            ?>
          </tbody>
        </table>
        
        </form>
        
<!-- ================================================================================ LINE ================================================================================ -->                

        <form action="basket-action.php" method="post" name="form_payment" id="form_payment">
        <input type="hidden" name="action" value="calc_payment">
        
        <p><br><b><?php echo $LANG['CHOOSE_PAYMENT'] ?>:</b></p>

        <table class="table border">
          <tbody>
              <?php
                // Alle betaalmethodes ophalen.
                $query = mysqli_query($conn, "SELECT * 
                                              FROM clo_payments 
                                              WHERE active = '1' 
                                              ORDER BY sort_order
                                              ");

                while($pay = mysqli_fetch_array($query))
                {
                  if($extra['pay_name'] === $pay['pay_name_'.$_SESSION['language'].''])
                  {
                    $checked   = 'checked';
                    $backlight = 'class="safe"';
                  }
                  else
                  {
                    $checked   = '';
                    $backlight = '';
                  }                  
                  
                  if($pay['pay_price'] === '0.00')
                  {
             ?>
              
                  <tr <?php echo $backlight ?>>
                    <td><span class="small"><?php echo $pay['pay_name_'.$_SESSION['language'].'']; ?>:</span></td>
                    <td width="15">&nbsp;</td>
                    <td><input type="radio" style="width: 20px !important; height: 20px !important;" name="pay_name" value="<?php echo $pay['pay_name_'.$_SESSION['language'].'']; ?>" <?php echo $checked; ?>></td>
                    <td width="15">&nbsp;</td>
                    <td> <?php if ($pay['pay_price'] == '0.00') { echo $pay['pay_text_'.$_SESSION['language'].'']; } ?></td>
                  </tr>
                
              <?php } else { ?>

                <tr <?php echo $backlight ?>>
                  <td><span class="small"><?php echo $pay['pay_name_'.$_SESSION['language'].'']; ?>:</span></td>
                  <td width="15">&nbsp;</td>
                  <td><input type="radio" style="width: 20px !important; height: 20px !important;" name="pay_name" value="<?php echo $pay['pay_name_'.$_SESSION['language'].'']; ?>" <?php echo $checked; ?>></td>
                  <td width="15">&nbsp;</td>
                  <td><?php echo $LANG['COSTS'] ?>: <b><?php echo $config['currency']; ?> <?php echo number_format($pay['pay_price'], 2, ',', '.'); ?></b></td>
               </tr>

              <?php
                  }
                }
             ?>
          </tbody>
        </table>
        
        </form>
        
<!-- ================================================================================ LINE ================================================================================ -->         
        
        <?php
          if(!empty($config['fee_insurance']))
          {
            if($extra['fee_insurance'] == '0.00') {
              $checked_insurance_no  = 'checked';
              $checked_insurance_yes = '';
              $backlight_yes         = '';
              $backlight_no          = 'class="safe"';
            }
            else
            {
              $checked_insurance_no  = '';
              $checked_insurance_yes = 'checked';
              $backlight_yes         = 'class="safe"';
              $backlight_no          = '';
            }
         ?>
        
        <form action="basket-action.php" method="post" name="form_insurance" id="form_insurance">
        <input type="hidden" name="action" value="calc_insurance">
        
        <p><br><b><?php echo $LANG['ORDER_INSURANCE'] ?>:</b> <span class="small"><?php echo $LANG['INSURANCE_WHY'] ?></span></p>
        
        <table class="table border">
          <tbody>
            <tr <?php echo $backlight_no ?>>
              <td><?php echo $LANG['NO'] ?>:</td>
              <td width="15">&nbsp;</td>
              <td><input type="radio" style="width: 20px !important; height: 20px !important;" name="fee_insurance" value="0.00" class="noborder" <?php echo $checked_insurance_no; ?>></td>
              <td width="15">&nbsp;</td>
              <td><?php echo $LANG['FREE'] ?></td>
            </tr>
            <tr <?php echo $backlight_yes ?>>
              <td><?php echo $LANG['YES'] ?>:</td>
              <td width="15">&nbsp;</td> 
              <td><input type="radio" style="width: 20px !important; height: 20px !important;" name="fee_insurance" value="<?php echo $config['fee_insurance']; ?>" class="noborder" <?php echo $checked_insurance_yes; ?>></td>
              <td width="15">&nbsp;</td>
              <td><?php echo $LANG['COSTS'] ?> <b><?php echo $config['currency']; ?> <?php echo number_format($config['fee_insurance'], 2, ',', '.'); ?></b></td>
            </tr>
          <tbody>
        </table>
        
        </form>
        
        <?php } ?>
            
<!-- ================================================================================ LINE ================================================================================ -->  

<?php            

              // Eventuele pakketverzekering.
							if(empty($_POST['fee_insurance']))
              {
								$insurance = "0.00";
							}
              elseif ($_POST['fee_insurance'] == 1)
              {
								$insurance = $config['fee_insurance'];
							}

              // Ordertotaal ophalen om mee te rekenen.
							$sql3 = mysqli_query($conn, "SELECT SUM(price_total) 
                                           AS pricetotal 
                                           FROM clo_orders_a 
                                           WHERE session_id = '".session_id()."'
                                           ");

							$pricetotal = mysqli_fetch_assoc($sql3);

              // Winkelkorting van toepassing?
              // 1 is Absoluut.
              // 0 is Procentueel.
							if($config['promo_discount_rate'] != 0)
              {
								if ($config['promo_discount_type'] == 1) // Als het absoluut is.
                {
									$discount = $config['promo_discount_rate'];
									$subtotal = $pricetotal['pricetotal'] - $discount;
								}
                elseif ($config['promo_discount_type'] == 0) // Als het procentueel is.
                {
                  $discount = $pricetotal['pricetotal'] / $config['promo_discount_rate'];
                  $subtotal = $pricetotal['pricetotal'] - $discount;
                }
              }
              else
              {
                $subtotal = $pricetotal['pricetotal'];
                $discount = "0.00";
              }

              // Subtotaal uitrekenen.
							$total = $subtotal + $extra['ship_price'] + $extra['pay_price'] + $extra['fee_insurance'];

              // B.t.w. uitrekenen.
              if((!empty($_SESSION['invoice_country'])) && $_SESSION['invoice_country'] != 'Nederland')
              {
                $tax = '0.00';
              }
              else
              {
                if($config['tax_included'] == 0)
                {
                  $tax = $total * ('0.'.$config['tax_percent']); // Prijzen zijn exclusief b.t.w. dus btw er bij.
                }
                else
                {
                  $tax = ($total / (100 + $config['tax_percent'])) * $config['tax_percent']; // Prijzen zijn inclusief b.t.w. dus btw alleen tonen.
                }
              }
						 ?>

              <br>
              
							<table class="table border">
								<tbody>

								  <tr>
								    <td><b><?php echo $LANG['SHIPPING_METHOD'] ?>:</b></td>
								    <td width="15">&nbsp;</td>
									  <td><?php echo $extra['ship_name']; ?> - <?php echo $config['currency']; ?> <?php echo number_format($extra['ship_price'], 2, ',', '.'); ?></td>
								  </tr>

								  <tr>
								    <td><b><?php echo $LANG['PAYMENT_METHOD'] ?>:</b></td>
								    <td></td>
									  <td><?php echo $extra['pay_name']; ?> - <?php echo $config['currency']; ?> <?php echo number_format($extra['pay_price'], 2, ',', '.'); ?></td>
								  </tr>

                </tbody>
							</table>
              
							<br>
              
							<table class="table border">
								<tbody>

                  <tr>
								    <td><?php echo $LANG['TOTAL'] ?>:</td>
								    <td align="right"><?php echo $config['currency']; ?></td>
									  <td width="15">&nbsp;</td>
								    <td align="right"><?php echo number_format($pricetotal['pricetotal'], 2, ',', '.'); ?></td>
								  </tr>

			  <?php
				  if($config['promo_discount_rate'] != 0)
          {
					  if($config['promo_discount_type'] == 0)
            {
              $before = '';
              $sign = '%';
            }
            else
            {
              $before = $config['currency'];
              $sign = ',=';
					  }

					  echo '<tr>
								    <td>Korting: '.$before.$config['promo_discount_rate'].$sign.'</td>
								    <td align="right">'.$config['currency'].'</td>
									  <td></td>
								    <td align="right">- '.number_format($discount, 2, ',', '.').'</td>
								  </tr>
								  ';
				  }
			 ?>

			  <?php
				  if(!empty($config['fee_insurance']))
          {
					  echo '<tr>
								    <td>'.$LANG['ORDER_INSURANCE'].':</td>
								    <td align="right">'.$config['currency'].'</td>
									  <td></td>
								    <td align="right">'.number_format($extra['fee_insurance'], 2, ',', '.').'</td>
								  </tr>
								  ';
				  }
			 ?>
								  <tr>
								    <td><?php echo $LANG['SHIPPING_COSTS'] ?>:</td>
								    <td align="right"><?php echo $config['currency']; ?></td>
									  <td></td>
								    <td align="right"><?php echo number_format($extra['ship_price'], 2, ',', '.'); ?></td>
								  </tr>

								  <tr>
								    <td><?php echo $LANG['PAYMENT_COSTS'] ?>:</td>
								    <td align="right"><?php echo $config['currency']; ?></td>
									  <td></td>
								    <td align="right"><?php echo number_format($extra['pay_price'], 2, ',', '.'); ?></td>
								  </tr>

								  <tr>
								    <td colspan="4"><hr></td>
								  </tr>

								  <tr>
								    <td><b><?php echo $LANG['SUBTOTAL'] ?>:</b></td>
								    <td align="right"><?php echo $config['currency']; ?></td>
									  <td></td>
								    <td align="right"><?php echo number_format(($subtotal + $extra['ship_price'] + $extra['pay_price'] + $extra['fee_insurance']), 2, ',', '.'); ?></td>
								  </tr>

								  <tr>
								    <td><?php echo $LANG['VAT'] ?> <?php echo $config['tax_percent']; ?>%</td>
								    <td align="right"><?php echo $config['currency']; ?></td>
									  <td></td>
								    <td align="right"><?php echo number_format($tax, 2, ',', '.'); ?></td>
								  </tr>

								  <tr>
								    <td colspan="4"><hr></td>
								  </tr>

								  <tr>
								    <td><b class="b_black"><?php echo $LANG['TOTAL'] ?>:</b></td>
								    <td align="right"><b class="b_black"><?php echo $config['currency']; ?></b></td>
									  <td></td>
								    <td align="right">
									  <b>
										  <?php
											  if($config['tax_included'] == 0)
                        {
                          $grandtotal = number_format(($total + $tax), 2, ',', '.');
                          echo $grandtotal;
                        }
                        else
                        {
                          $grandtotal = number_format($total, 2, ',', '.');
                          echo $grandtotal;
											  }
										 ?>
									  </b>
									  </td>
								  </tr>
                </tbody>
							</table>

							<?php
                // Als het een ingelogde klant is:
								if($_SESSION['member'] === TRUE)
                {
									$query = mysqli_query($conn, "SELECT * 
                                                FROM clo_customers 
                                                WHERE email = '".$_SESSION['email']."'
                                                ");

									$member = mysqli_fetch_assoc($query);
								}
							?>
              
<!-- ================================================================================ LINE ================================================================================ -->              

						<form method="post" action="basket-action.php" id="basket-form" name="basket-form" novalidate="novalidate">

              <input type="hidden" name="action"        value="order_final">
							<input type="hidden" name="session_id"    value="<?php echo session_id(); ?>">
							<input type="hidden" name="fee_insurance" value="<?php echo $extra['fee_insurance']; ?>">
              <input type="hidden" name="ship_name"     value="<?php echo $extra['ship_name']; ?>">
							<input type="hidden" name="ship_price"    value="<?php echo $extra['ship_price']; ?>">
							<input type="hidden" name="pay_name"      value="<?php echo $extra['pay_name']; ?>">
							<input type="hidden" name="pay_price"     value="<?php echo $extra['pay_price']; ?>">
							<input type="hidden" name="discount"      value="<?php echo $discount; ?>">
							<input type="hidden" name="total"         value="<?php echo $total; ?>">
							<input type="hidden" name="tax"           value="<?php echo $tax; ?>">
							<input type="hidden" name="tax_text"      value="<?php echo strip_tags($tax_text); ?>">
							<input type="hidden" name="grandtotal"    value="<?php echo $grandtotal; ?>">
              <br>
              <h1><?php echo $LANG['ADDRESS_INFO'] ?>:</h1> 
              
              <table class="table">
                <tbody>              
              
                <!-- Laat registreren zien als het lid niet is ingelogd:-->
                <?php if($_SESSION['member'] != TRUE) { ?>
                <h3><?php echo $LANG['WANT_REGISTER']; ?>:</h3>

                <!--Laat registreren voor BtoB zien:-->
                <?php if($super['allow_consumer'] == 0) { ?>
                <p><span class="medium"><?php echo $LANG['REGISTER_EXPLAIN']; ?> <a href="customer_register" target="_blank"><?php echo $LANG['CLICK']; ?> &raquo;</a></span></p>
                <?php } ?>
              
                <tr>
                  <td colspan="3"><hr></td>
                </tr>

                <tr>
                  <td><?php echo $LANG['PASSWORD'] ?>:</td>
                  <td></td>
                  <td><input type="password" name="password" value="" class="input250"></td>
                </tr>
                
                <tr>
                  <td colspan="3"><hr></td>
                </tr>                  
              
            <?php } ?> 
            
                  <tr>
                    <td colspan="3"><?php echo $LANG['DIFFERENT_SHIPPING'] ?>.<hr></td>
                  </tr>

            <?php if($config['allow_vouchers'] == 1) { ?>

                  <tr>
                    <td><?php echo $LANG['VOUCHER_CODE'] ?>:</td>
                    <td width="10">&nbsp;</td>
                    <td><input type="text" name="voucher" value=""></td>
                  </tr>

	                <tr>
	                  <td colspan="3"><hr></td>
	                </tr>

            <?php } ?>
                  
                  <tr>
                    <td><?php echo $LANG['SALUATION'] ?>:</td>
                    <td width="10">&nbsp;</td>
                    <td><i class="fa fa-male text-black-opacity fa-2x"></i> <input type="radio" name="saluation" value="Hr." class="input_short" checked> <i class="fa fa-female text-black-opacity fa-2x"></i> <input type="radio" name="saluation" value="Mw." class="input_short"></td>
                  </tr>

                  <tr>
                    <td><?php echo $LANG['NAME'] ?>:*</td>
                    <td></td>
                    <td><input type="text" name="surname" value=""></td>
                  </tr>

                  <tr>
                    <td><?php echo $LANG['STREET'] ?>:*</td>
                    <td></td>
                    <td><input type="text" name="invoice_street" value=""></td>
                  </tr>

                  <tr>
                    <td><?php echo $LANG['NUMBER'] ?>:*</td>
                    <td></td>
                    <td><input type="text" name="invoice_street_nr" value=""></td>
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
                    <td><?php echo $LANG['COUNTRY'] ?>:</td>
                    <td></td>
                    <td>
                      <select name="invoice_country">

                      <?php
                        if($_SESSION['member'] == 1)
                        {
                          echo '<option value="'.$member['invoice_country'].'">'.$member['invoice_country'].'</option>';
                        }
                        else if (!empty($_SESSION['tmp_invoice_country']))
                        {
                          echo '<option value="'.$_SESSION['tmp_invoice_country'].'">'.$_SESSION['tmp_invoice_country'].'</option>';
                        }
                        else
                        {
                          echo '<option value="Nederland">Nederland</option>';
                        }
                      ?>

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
                    <td><?php echo $LANG['EMAIL'] ?>:*</td>
                    <td></td>
                    <td><input type="text" name="email" value=""></td>
                  </tr>

                  <tr>
                    <td><?php echo $LANG['HOW_DID_YOU'] ?></td>
                    <td></td>
                    <td>
                      <select name="found">
                        <option value="Niet ingevuld">        <?php echo $LANG['HOW_DID_YOU'] ?></option>
                        <option value="Via Facebook">         Via Facebook</option>
                        <option value="Via Google">           Via Google</option>
                        <option value="Via een kennis">       Via een kennis</option>
                        <option value="Via markt of braderie">Via Markt of Braderie</option>
                        <option value="Via advertentie">      Via een advertentie</option>
                        <option value="Van horen zeggen">     Van horen zeggen</option>
                        <option value="Per ongeluk">          Per ongeluk</option>
                      </select>
                   	</td>
                  </tr>

                  <tr>
                    <td valign="top"><br><?php echo $LANG['REMARKS'] ?>:</td>
                    <td></td>
                    <td>
                      <br>
                      <textarea type="text" name="order_remarks"></textarea><br>
                      <br>
                      <?php echo $LANG['AGREED'] ?>: <a href="<?php echo ''.str_replace(' ','-','Algemene Voorwaarden').'-T-35.html' ?>" target="_blank"><?php echo $LANG['T_AND_C'] ?> <i class="fa fa-arrow-right text-black-opacity fa-lg"></i></a> <input type="checkbox" name="accoord" class="input_short" checked=checked> <br>
                      <br>
                    </td>
                  </tr>

                  <tr>
                    <td></td>
                    <td></td>
                    <td>
                      <button type="submit" class="btn"><?php echo $LANG['SEND'] ?></button><br>
                      <br>
                      <a onclick="JavaScript:window.print()" href="#"><i class="fa fa-print text-black-opacity fa-lg"></i> <?php echo $LANG['PRINT'] ?></a><br>
                      <br>
                      <br>
                    </td>
                  </tr>

                </tbody>
              </table>            
              
						</form>

						<?php 
               }
             } 
           ?> 
					</div>
          
			    <?php include 'footer.php'; ?>

	</body>

</html>