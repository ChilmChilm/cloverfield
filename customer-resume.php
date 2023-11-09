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
	$menu_right = 0;
  
  // Alle klantgegevens ophalen.
  $query = mysqli_query($conn, "SELECT * FROM clo_customers WHERE username = '".$_SESSION['email']."'");
  $customer = mysqli_fetch_array($query);
  
  // Voor de veiligheid straks met post en get e.d.
  $query = mysqli_query($conn, "SELECT session_id FROM clo_orders_c WHERE username = '".$_SESSION['email']."'");
  $session = mysqli_fetch_array($query);
  
  $session_id = $session['session_id'];
  
  // Geef de checkboxes de juiste waardes in het formulier:
  $customer['active'] == 1 ? $customer['active'] = 'Ja' : $customer['active'] = 'Nee';
  $customer['see_prices'] == 1 ? $customer['see_prices'] = 'Ja' : $customer['see_prices'] = 'Nee';
  $customer['newsletter'] == 1 ? $customer['newsletter'] = "checked='checked'" : $customer['cust_newsletter'] = "";
  $customer['discount_type'] == 'P' ? $discount_type = 'Procentueel' : $discount_type = 'Absoluut';
  $customer['discount'] == '0.00' ? $discount = 'Nee' : $discount = 'Ja '.$customer['discount'].' '.$discount_type;
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
    
    <!-- BEO CODE FOR TABS -->
    <script src="includes/js/jquery-1.7.1.min.js" type="text/javascript"></script>
    <script src="includes/js/jquery.hashchange.min.js" type="text/javascript"></script>
    <script src="includes/js/jquery.easytabs.min.js" type="text/javascript"></script>

    <script type="text/javascript">
      $(document).ready( function() {
        $('#tab-container').easytabs();
      });
    </script>
    <!-- EOF CODE FOR TABS -->    
	</head>
	
	<body id="top">
	
    <form method="post" action="customer-action.php">
    <input type="hidden" name="action" value="edit">
    <input type="hidden" name="session_id" value="<?php echo $session_id; ?>">		
    
    <?php include "header.php"; ?>
		
    <div align="center" class="row max">
    
      <div class="evo_page">
      
			  <h1>Uw gegevens en orderhistorie</h1>
        
          <div id="box_tabs">

            <div id="tab-container" class="tab-container">

              <ul class="etabs">
                <li class="tab"><a href="#tabs1-1">Algemeen</a></li>
                <li class="tab"><a href="#tabs1-2">Orderhistorie</a></li>
              </ul>
              
<!-- ======================================================= TAB 1 ======================================================= -->              

              <div id="tabs1-1" class="viewport">
              
                <table>
                <tbody>
                  <tr>
                    <td class="td_twin_L">
                      <fieldset>
                      <legend>Algemeen</legend>
                        <table>
                        <tbody>
                          <tr>
                            <td width="30%">Bedrijfsnaam:</td>
                            <td width="5%"></td>
                            <td width="65%"><input type="text" name="companyname" value="<?php echo $customer['companyname']; ?>"></td>
                          </tr>
                          <tr>
                            <td>Aanhef:</td>
                            <td></td>
                            <td>
                              <select name="saluation">
                                <?php echo '<option value="'.$customer['saluation'].' ">'.$customer['saluation'].'</option>' ?>
                                <option value="Hr. ">Hr.</option>
                                <option value="Mw. ">Mw.</option>
                              </select>              
                            </td>
                          </tr>            
                          <tr>
                            <td>Voornaam:</td>
                            <td></td>
                            <td><input type="text" name="firstname" value="<?php echo $customer['firstname']; ?>"></td>
                          </tr>            
                          <tr>
                            <td>Achternaam:</td>
                            <td></td>
                            <td><input type="text" name="surname" value="<?php echo $customer['surname']; ?>"></td>
                          </tr>
                          <tr>
                            <td>Telefoon:</td>
                            <td></td>
                            <td><input type="text" name="phone" value="<?php echo $customer['phone']; ?>"></td>
                          </tr>
                        </tbody>
                        </table>
                      </fieldset>
                      
                      <fieldset>
                      <legend>Factuuradres</legend>
                        <table>
                        <tbody>
                          <tr>
                            <td width="30%">Adres & nummer:</td>
                            <td width="5%"></td>
                            <td width="65%"><input type="text" name="invoice_street" value="<?php echo $customer['invoice_street']; ?>"> <input type="text" name="invoice_street_nr" class="input_short" value="<?php echo $customer['invoice_street_nr']; ?>"></td>
                          </tr>
                          <tr>
                            <td>Postcode:</td>
                            <td></td>
                            <td><input type="text" name="invoice_zip" value="<?php echo $customer['invoice_zip']; ?>"></td>
                          </tr>
                          <tr>
                            <td>Plaats:</td>
                            <td></td>
                            <td><input type="text" name="invoice_city" value="<?php echo $customer['invoice_city']; ?>"></td>
                          </tr>
                          <tr>
                            <td>Land:</td>
                            <td></td>
                            <td>
                              <select class="input_200_drop" name="invoice_country">
                                <?php
                                  $query4 = mysqli_query($conn, "SELECT invoice_country 
                                                                 FROM clo_customers 
                                                                 WHERE idx = '".$customer['idx']."'
                                                                 ");

                                  $row4 = mysqli_fetch_array($query4);

                                  echo "<option value='".$row4['invoice_country']."' selected>".$row4['invoice_country']."</option>";

                                  $query5 = mysqli_query($conn, "SELECT * 
                                                                  FROM clo_countries 
                                                                  ORDER BY '.idx.'
                                                                  ");

                                  while($row5 = mysqli_fetch_array($query5))
                                  {
                                    echo "<option value='".$row5['country_name']."'>".$row5['country_name']."</option>";
                                  }
                               ?>
                              </select>
                            </td>
                          </tr>
                        </tbody>
                        </table>
                      </fieldset>

                      <fieldset>
                      <legend>Bezorgadres</legend>
                        <table>
                        <tbody>
                          <tr>
                            <td width="30%">Adres & nummer:</td>
                            <td width="5%"></td>
                            <td width="65%"><input type="text" name="deliver_street" value="<?php echo $customer['deliver_street']; ?>"> <input type="text" name="deliver_street_nr" class="input_short" value="<?php echo $customer['deliver_street_nr']; ?>"></td>
                          </tr>
                          <tr>
                            <td>Postcode:</td>
                            <td></td>
                            <td><input type="text" name="deliver_zip" value="<?php echo $customer['deliver_zip']; ?>"></td>
                          </tr>
                          <tr>
                            <td>Plaats:</td>
                            <td></td>
                            <td><input type="text" name="deliver_city" value="<?php echo $customer['deliver_city']; ?>"></td>
                          </tr>
                          <tr>
                            <td>Land:</td>
                            <td></td>
                            <td>
                              <select class="input_200_drop" name="deliver_country">
                                <?php
                                  $query7 = mysqli_query($conn, "SELECT deliver_country 
                                                                 FROM clo_customers 
                                                                 WHERE idx = '".$customer['idx']."'
                                                                 ");

                                  $row7 = mysqli_fetch_array($query7);

                                  echo "<option value='".$row7['deliver_country']."' selected>".$row7['deliver_country']."</option>";

                                  $query8 = mysqli_query($conn, "SELECT * 
                                                                 FROM clo_countries 
                                                                 ORDER BY '.idx.'
                                                                 ");

                                  while($row8 = mysqli_fetch_array($query8))
                                  {
                                    echo "<option value='".$row8['country_name']."'>".$row8['country_name']."</option>";
                                  }
                               ?>
                              </select>
                            </td>
                          </tr>
                        </tbody>  
                        </table>
                      </fieldset>
                      
                      <fieldset>
                      <legend>Overig</legend>
                        <table>
                        <tbody>
                          <tr>
                            <td width="30%">Username:</td>
                            <td width="5%"></td>
                            <td width="65%"><b><?php echo $customer['username']; ?></b></td>
                          </tr>
                          <tr>
                            <td>E-mail:</td>
                            <td></td>
                            <td><b><?php echo $customer['email']; ?></b></td>
                          </tr>
                          <tr>
                            <td colspan="3"><hr></td>
                          </tr>            
                          <tr>
                            <td>Website:</td>
                            <td></td>
                            <td><input type="text" name="website" value="<?php echo $customer['website']; ?>"></td>
                          </tr>
                          <tr>
                            <td>B.t.w. nummer:</td>
                            <td></td>
                            <td><input type="text" name="tax_nr" value="<?php echo $customer['tax_nr']; ?>"></td>
                          </tr>
                          <tr>
                            <td>K.v.k. nummer:</td>
                            <td></td>
                            <td><input type="text" name="commerce_nr" value="<?php echo $customer['commerce_nr']; ?>"></td>
                          </tr>
                          <tr>
                            <td>Rekeningnummer:</td>
                            <td></td>
                            <td><input type="text" name="bank_nr" value="<?php echo $customer['bank_nr']; ?>"></td>
                          </tr>
                          <tr>
                            <td>Bankrelatie:</td>
                            <td></td>
                            <td><input type="text" name="bank_name" value="<?php echo $customer['bank_name']; ?>"></td>
                          </tr>
                          <tr>
                            <td colspan="3"><hr></td>
                          </tr>            
                          <tr>
                            <td>Betaalmethode:</td>
                            <td></td>
                            <td>
                              <b><?php echo $customer['payment_method']; ?></b>
                            </td>
                          </tr>
                          <tr>
                            <td>Korting:</td>
                            <td></td>
                            <td>
                              <b><?php echo $discount; ?></b>
                            </td>
                          </tr>
                          <tr>
                            <td>Actief:</td>
                            <td></td>
                            <td><b><?php echo $customer['active']; ?></b></td>
                          </tr>
                          <tr>
                            <td>Mag prijzen zien:</td>
                            <td></td>
                            <td><b><?php echo $customer['see_prices']; ?></b></td>
                          </tr>
                          <tr>
                            <td>Nieuwsbrief:</td>
                            <td></td>
                            <td><input type="checkbox" name="newsletter" class="input_no_left" <?php echo $customer['newsletter']; ?>></td>
                          </tr>
                        </tbody>
                        </table>
                      </fieldset>
                      
                      <fieldset>
                      <legend>Nieuw wachtwoord:</legend>
                        Uw wachtwoord wordt versleuteld opgeslagen daarom is uw oude wachtwoord niet meer te achterhalen.<br>
                        Een nieuw wachtwoord lost dit dan op.<br>
                        <br>          
                        <table>
                        <tbody>
                          <tr>
                          <tr>
                            <td width="30%">Nieuw wachtwoord:</td>
                            <td width="5%"></td>
                            <td width="65%"><input type="text" name="password_new" value=""></td>
                          </tr>
                          </tr>
                        </tbody>
                        </table>
                      </fieldset>                       
                      
                    </td>
                  </tr>
                </tbody>  
                </table>              
              
              </div>
              
<!-- ======================================================= TAB 2 ======================================================= --> 

              <div id="tabs1-2" class="viewport">
              
                <table>
                <tbody>
                  <tr>
                    <td>
                      Alle orders van <b><?php echo $customer['companyname']; ?></b><br>
                      <br>
                    
                      <?php
                          // Alle ordergegevens van dee klant ophalen.
                          $query2 = mysqli_query($conn, "SELECT * 
                                                         FROM clo_orders_c 
                                                         WHERE username = '".$_SESSION['email']."' 
                                                         ORDER BY order_idx 
                                                         DESC
                                                         ");

                          // Define $color=1
                          $color = 1;
                          
                          echo '<table class="border">
                                <tbody>
                                  <tr class="theme">
                                    <th>Bedrag:</th>
                                    <th>B.t.w:</th>
                                    <th>Totaal:</th>
                                    <th>Korting:</th>
                                    <th>Betaalmethode:</th>
                                    <th>Status:</th>
                                    <th>Datum & Tijd:</th>
                                    <th align="center">Details:</th>
                                    <th align="center">Pdf:</th>
                                  </tr>';

                          while($row = mysqli_fetch_array($query2))
                          {
                            $datum = date("d-m-Y", strtotime($row['order_date']));
                            
                            if($color==1)
                            {
                              echo '<tr class="rowcolor-1 border">
                                      <td>'.$config['currency'].' '.number_format($row['order_total'], 2, ',', '.').'</td>
                                      <td>'.$config['currency'].' '.number_format($row['order_tax'], 2, ',', '.').'</td>
                                      <td><b>'.$config['currency'].' '.number_format($row['order_grand_total'], 2, ',', '.').'</b></td>
                                      <td><span class="small">'.$config['currency'].' '.number_format($row['store_discount'], 2, ',', '.').'</span></td>
                                      <td><span class="small">'.$row['order_payment_name'].'</span></td>
                                      <td><span class="small">'.$row['order_status'].'</span></td>
                                      <td><span class="small">'.$datum.'&nbsp;&nbsp; <b>|</b>&nbsp;&nbsp; '.$row['order_time'].'</span></td>
                                      <td align="center"><a href="customer-mailorder.php?action=show_mail&session_id='.$row['session_id'].'" title="Originele mail bekijken" target="_blank"><i class="fa fa-envelope -o fa-fw"></i></a></td>
                                      <td align="center"><a href="invoice/factuur.php?customer_id='.$row['customer_id'].'&session_id='.$row['session_id'].'" title="Pdf genereren" target="_blank"><i class="fa fa-file-pdf-o"></i></a></td>
                                    </tr>
                                    ';

                              // Set $color==2, for switching to other color 
                              $color = 2;
                              }
                              
                              // When $color not equal to 1, use this table row color 
                              else
                              {
                              echo '<tr class="rowcolor-2 border">
                                      <td>'.$config['currency'].' '.number_format($row['order_total'], 2, ',', '.').'</td>
                                      <td>'.$config['currency'].' '.number_format($row['order_tax'], 2, ',', '.').'</td>
                                      <td><b>'.$config['currency'].' '.number_format($row['order_grand_total'], 2, ',', '.').'</b></td>
                                      <td><span class="small">'.$config['currency'].' '.number_format($row['store_discount'], 2, ',', '.').'</span></td>
                                      <td><span class="small">'.$row['order_payment_name'].'</span></td>
                                      <td><span class="small">'.$row['order_status'].'</span></td>
                                      <td><span class="small">'.$datum.'&nbsp;&nbsp; <b>|</b>&nbsp;&nbsp; '.$row['order_time'].'</span></td>
                                      <td align="center"><a href="customer-mailorder.php?action=show_mail&session_id='.$row['session_id'].'" title="Originele mail bekijken" target="_blank"><i class="fa fa-envelope -o fa-fw"></i></a></td>
                                      <td class="td_height" align="center"><a href="invoice/factuur.php?customer_id='.$row['customer_id'].'&session_id='.$row['session_id'].'" title="Pdf genereren" target="_blank"><i class="fa fa-file-pdf-o"></i></a></td>
                                    </tr>
                                      ';

                                  // Set $color back to 1
                                  $color = 1;
                                }
                              }
                              echo '</tbody>
                                  </table>';
                       ?>
                        <br>
                    </td>
                  </tr>
                </tbody>
                </table>              
              
              </div> 
              
          </div> <!-- EOF tab-container -->        

        </div> <!-- EOF box_tabs  -->
        
        <br>
        <button type="submit" class="btn">Opslaan</button><br>
        <br>
        </form>
        
      </div> <!-- EOF evo_page  -->
    
    </div> <!-- EOF row  -->

		<?php include 'footer.php'; ?>	
	
	</body>
	
</html>