
<!-- ================================================================================ LINE ================================================================================ -->          
         
          <!-- Navigation pop-up -->
          <nav class="sidenav white card-2 animate-left" style="display: none;">
            <a href="javascript:void(0)" onclick="close_down()" class="closenav xxlarge text-theme"><?php echo $LANG['CLOSE'] ?> <i class="fa fa-close"></i></a> 
            <a href="index.php" >Home</a>
            <?php
              // Get the complete url.
              $url = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

              // Get all the main categories.
              $query = mysqli_query($conn,"SELECT * 
                                           FROM clo_categories 
                                           WHERE parent = 0 
                                           AND active = 1 
                                           ORDER BY sort_order
                                           ");

              while ($category = mysqli_fetch_array($query))
              {
                // Must the url be highlighted?.
                if($url == $config['path_url'].'/'.MyReplace($category['category_name_'.$_SESSION['language'].'']).'-C-'.$category['idx']) {

                // Alle Subcategorieen van de categorie ophalen.
                  $query2 = mysqli_query($conn,"SELECT * 
                                                FROM clo_categories 
                                                WHERE parent = '".$category['idx']."' 
                                                AND active = 1 
                                                ORDER BY sort_order
                                                ");

           ?>
                  <a href="<?php echo urlencode(MyReplace($category['category_name_'.$_SESSION['language'].''])); ?>-C-<?php echo $category['idx']; ?>" title="<?php echo $category['category_name_'.$_SESSION['language'].'']; ?>"><?php echo $category['category_name_'.$_SESSION['language'].'']; ?></a>

<?php
  while ($sub = mysqli_fetch_array($query2))
  {
  // Spit the sub categories.
?>

      <a href="<?php echo urlencode(MyReplace($sub['category_name_'.$_SESSION['language'].''])); ?>-C-<?php echo $sub['idx']; ?>" title="<?php echo $sub['category_name_'.$_SESSION['language'].'']; ?>"><?php echo $sub['category_name_'.$_SESSION['language'].'']; ?></a>

  <?php } ?>

<?php
  }
  else // And otherwise the normal url.
  {
?>
                  <a href="<?php echo urlencode(MyReplace($category['category_name_'.$_SESSION['language'].''])); ?>-C-<?php echo $category['idx']; ?>" title="<?php echo $category['category_name_'.$_SESSION['language'].'']; ?>"><?php echo $category['category_name_'.$_SESSION['language'].'']; ?></a>
            <?php
                }
              }
           ?>    
          </nav>
          
<!-- ================================================================================ LINE ================================================================================ -->           
          
          <!-- Modal pop-up -->
          <div id="pop_cart" class="modal">
          
            <div class="modal-dialog">
            
              <div class="modal-content card-8 animate-top">
              
                <header class="container"> 
                  <div style="float: left; padding-top: 5px;"><i class="fa fa-shopping-basket text-green"></i> <b><?php echo $LANG['BASKET'] ?>:</b></div>
                  <a href="#" class="closebtn" style="margin-top: -2px;">&times;</a>
                </header>
                
                <div class="container white padding-16">
                  
                  <?php
                    // Bestelgegevens ophalen.
                    $query = mysqli_query($conn, "SELECT * 
                                                  FROM clo_orders_a 
                                                  WHERE session_id = '".session_id()."'
                                                  ");

                    while($order = mysqli_fetch_array($query))
                    {
                      $query2 = mysqli_query($conn, "SELECT * 
                                                     FROM clo_products 
                                                     WHERE idx = '".$order['item_id']."'
                                                     ");

                      $basket = mysqli_fetch_array($query2);
                  ?>
                        <div style="float: left; width: 33%;" class="padding-right border-bottom">
                        <p><em><b><a href="products-single.php?id=<?php echo $basket['idx']; ?>"><?php echo word_count($basket['product_title_'.$_SESSION['language'].''],6); ?> <i class="fa fa-arrow-right text-grey fa-fw"></i></a></b></em></p>
                        <p><?php echo $LANG['PIECES'] ?>: <?php echo $order['quantity']; ?> st. | <?php echo $LANG['PRICE'] ?>: <b>&euro; <?php echo number_format($order['price'], 2, ',', '.'); ?></b><br>

                   <?php
                   
                        // Now show the option values.
                        if(!empty($order['product_option']))
                        {
                          $string = explode(';',$order['product_option']);
                          
                          foreach ($string as $key => $value) 
                          {
                            $real_value = explode('#',$value);
                            // Filter empty values from explode.
                            if(!empty($real_value[0])) 
                            {
                              echo '<p>Optie: '.$real_value[0].' '.$real_value[1].' &euro; '.$real_value[2].'</p>';
                            }
                          }
                        }
                       ?>

                        <p><?php echo $LANG['SUBTOTAL'] ?>: <b><?php echo $config['currency']; ?> <?php echo number_format(($order['quantity'] * $order['price']), 2, ',', '.'); ?></b></p>
											</div>
											
                    <?php
                      }
									
                    // Get order total to count with.
                    $query3 = mysqli_query($conn, "SELECT SUM(price_total) 
                                                   AS pricetotal 
                                                   FROM clo_orders_a 
                                                   WHERE session_id = '".session_id()."'
                                                   ");

                    $pricetotal = mysqli_fetch_assoc($query3);

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
                    $total = $subtotal;
                   ?>

									<div style="clear: both;">
                    <p>
                      <br>
                      <b>
	                    <?php
	                      if($config['tax_included'] == 0)
                        {
	                        $percent    = '0.'.$config['tax_percent'].''; // Derive from config i.e. 0.21
	                        $tax        = $total * $percent; // Add to the total cost.
	                        $grandtotal = number_format(($total + $tax), 2, ',', '.'); // Final amount tax included.
	                        
	                        echo $LANG['VAT'].':&nbsp;&nbsp;&nbsp;&nbsp;'.$config['currency'].' '.number_format($tax, 2, ',', '.').'<br>';
	                        echo $LANG['TOTAL'].':&nbsp;&nbsp;'.$config['currency'].' '.$grandtotal.'';
                        }
                        else
                        {
                          $grandtotal = number_format($total, 2, ',', '.');
                          echo $LANG['TOTAL'].': '.$config['currency'].' '.$grandtotal.'';
	                      }
	                   ?>
                    </b>
                    </p>
									</div>
										
                    <hr>
                    
                  <p><a class="btn" href="basket.php"><?php echo $LANG['PAY'] ?></a></p>
                </div>
                
              </div>
            </div>
            
          </div> <!-- END modal popup -->
          
<!-- ================================================================================ LINE ================================================================================ -->                            
          
          <!-- Header -->
          <header class="container padding margin-bottom container-photo" id="evo_header" style="height: 350px;">
          
            <i onclick="slide_down()" class="fa fa-bars xlarge opennav theme-magenta margin-left" style="padding: 5px 9px 5px 9px; border: #E4F2FB 3px solid; border-radius: 3px;"></i> 
            
            <div class="padding-bottom margin-left margin-top">
              <a href="index.php" title="Home <?php echo $config['shop_name']; ?>"><img src="layout/logo.png" alt="Home <?php echo $config['shop_name']; ?>" style="max-width: 100%;"></a>
            </div>
            
            <div class="margin-left margin-top" style="width: 300px; margin-bottom: -50px;">
					    <form method="post" action="page_search.php">
					      <input type="search" name="que" placeholder="<?php echo $LANG['SEARCH'] ?>" style="border-radius: 5px;">
					      <button type="submit" class="button-none"><i class="fa fa-search-plus text-red fa-lg"></i></button>
					    </form>              
            </div>            
            
            <div class="topnav large theme-magenta" style="padding-bottom: 10px; margin-top: 135px !important;">
              <a href="index.php" title="Naar de homepage"><i class="fa fa-home xlarge"></i> <?php echo $LANG['HOME'] ?></a> |
              <?php
                // Get all the menu items.
                $query = mysqli_query($conn,"SELECT * 
                                             FROM clo_text 
                                             WHERE text_menu = 'Boven' 
                                             AND active = 1 
                                             ORDER BY sort_order
                                             ");

                while ($text = mysqli_fetch_array($query))
                {
                  echo '<a href="'.urlencode(MyReplace($text['text_title_'.$_SESSION['language'].''])).'-T-'.$text['idx'].'" title="'.$text['text_title_'.$_SESSION['language'].''].'">'.$text['text_title_'.$_SESSION['language'].''].'</a> |';
                }
             ?>
              <a href="page-contact.php"><i class="fa fa-pencil text-white"></i>  <?php echo $LANG['CONTACT'] ?></a> | 
              <?php
                if(isset($_SESSION['member']) && $_SESSION['member'] === TRUE)
                {
                  echo '<a href="logout.php"><i class="fa fa-user text-white"></i> '.$LANG['LOGOUT'].'</a> | ';
                }
                else
                {
                  $_SESSION['member'] = '';
                  echo '<a href="page-login.php"><i class="fa fa-user text-white"></i> '.$LANG['LOGIN'].'</a> | ';
                }
             ?> 
              <a href="basket.php" title="<?php echo $LANG['BASKET'] ?>"><i class="fa fa-shopping-basket text-white"></i></a> 
              
              <?php // Talen aanzetten ?
                if($super['shop_languages'] == 1) {
             ?>              
                     
		              <?php if($super['shop_language_fr'] == 1) { ?>
			              <div class="right">
			                <a href="index.php?language=fr" title="Francais"><img src="layout/flag_fr.png" height="22"></a> 
			              </div>		              
		              <?php	} ?> 
		              
		              <?php if($super['shop_language_de'] == 1) { ?>
			              <div class="right">
			                <a href="index.php?language=de" title="Deutsch"><img src="layout/flag_de.png" height="22"></a> 
			              </div>		              
		              <?php	} ?>		                                  
		              
		              <?php if($super['shop_language_en'] == 1) { ?>
			              <div class="right">
			                <a href="index.php?language=en" title="English"><img src="layout/flag_en.png" height="22"></a> 
			              </div>		              
		              <?php	} ?>
		              
		              <div class="right">
		                <a href="index.php?language=nl" title="Nederlands"><img src="layout/flag_nl.png" height="22"></a> 
		              </div>		              
		              
							<?php	} ?>                            
              
            </div>                      
            
          </header>
          