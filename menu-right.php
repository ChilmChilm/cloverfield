<!-- ======================================================= LINE ======================================================= -->

  <div class="quarter container">
  
  <?php if($_SESSION['member'] == TRUE) { ?>

        <?php echo $LANG['WELCOME'] ?> <span class="small"><?php echo $_SESSION['name']; ?></span><br>
        <p><?php echo '<a href="customer-resume.php" title="'.$LANG['MANAGE_YOUR_DATA'].'"><i class="fa fa-book text-grey fa-lg"></i> '.$LANG['MANAGE_YOUR_DATA'].'</a>'; ?></p>
        <p><?php echo '<a href="customer-resume.php" title="'.$LANG['MANAGE_YOUR_ORDERS'].'"><i class="fa fa-book text-grey fa-lg"></i> '.$LANG['MANAGE_YOUR_ORDERS'].'</a>'; ?></p>

  <?php } ?>

<?php  if ($super['allow_consumer'] == 1 || $_SESSION['member'] == TRUE) { ?>

				<h4><?php echo $LANG['BASKET'] ?></h4>

<?php
        // Totale orderbedrag tot nu toe tonen.
        $query3 = mysqli_query($conn,"SELECT SUM(price_total) 
                                      AS pricetotal 
                                      FROM clo_orders_a 
                                      WHERE session_id = '".session_id()."'
                                      ");

        $total_amount = mysqli_fetch_assoc($query3);
?>
        <p class="small"><?php echo $LANG['TOTAL'] ?>:</p>
        <p><b>&euro; <?php echo number_format($total_amount['pricetotal'], 2, ',', '.'); ?></b></p>
        <hr>

				<?php
// Eventueel bestelgegevens ophalen. ================================================================================= //
						$query = mysqli_query($conn,"SELECT session_id FROM clo_orders_a WHERE session_id = '".session_id()."'");

// Zijn er wel artikelen besteld? ================================================================================= //
						if (mysqli_num_rows($query) > 0) {
							$query = mysqli_query($conn, "SELECT * 
                                            FROM clo_orders_a 
                                            WHERE session_id = '".session_id()."' 
                                            ORDER BY idx DESC
                                            ");

							while($order = mysqli_fetch_array($query))
              {
								$query2 = mysqli_query($conn,"SELECT * 
                                              FROM clo_products 
                                              WHERE idx = '".$order['item_id']."'
                                              ");

								$basket = mysqli_fetch_array($query2);

								$quantity = $order['quantity']; // Het bestelde aantal.

								if ($order['millimeter'] == 0)
                {
									$price = $order['price']; // Prijs artikel of meter.
								}
                else if ($order['millimeter'] != 0)
                {
									$price = $order['millimeter'] / 1000 * $order['price'];
								}

								$fee_cutting   = $config['fee_cutting'];    // Prijs zaagkosten.
								$cutting_total = $quantity * $fee_cutting;  // Totaal zaagkosten.
								$millimeter    = $order['millimeter'];      // Aantal millimeters.
								$item_id       = $order['item_id'];         // Het item ID.
								$product_title = $basket['product_title_'.$_SESSION['language'].''];  // Naam van het product.

// Als het WEL metermateriaal is. ================================================================================= //
								if ($basket['meter'] == 1) { ?>

									<b><?php echo $LANG['SKU'] ?>:</b> <a href="<?php echo urlencode(MyReplace($product_title)); ?>-ID-<?php echo $item_id; ?>" title="<?php echo $product_title; ?>"><?php echo word_count($product_title,2); ?> <i class="fa fa-arrow-right text-grey"></i></a><br>
									<?php echo $LANG['PIECES_OF'] ?>: <?php echo $quantity; ?> <?php echo $LANG['PIECE'] ?>. <?php echo $LANG['OF'] ?>  <?php echo $millimeter; ?> mm.<br>
									<?php echo $LANG['PRICE'] ?>: &euro; <?php echo number_format($order['price'], 2, ',', '.'); ?> <?php echo $LANG['PER_METER'] ?>.<br>
									<?php echo $LANG['CUTTING_COSTS'] ?>: &euro; <?php echo number_format($cutting_total, 2, ',', '.'); ?><br>
									<?php echo $LANG['TOTAL'] ?>: &euro; <?php echo number_format(($quantity * $price + $cutting_total), 2, ',', '.'); ?> | <a href="basket-action.php?action=product_delete&product_id=<?php echo $item_id; ?>&order_idx=<?php echo $order['idx']; ?>" onclick="return confirm('Artikel compleet verwijderen?')" title="Verwijderen?"><i class="fa text-grey fa-trash fa-lg"></i></a><br>
									<hr>

								<?php }

// Als het GEEN metermateriaal is. ================================================================================= //
								else if ($basket['meter'] == 0)
                {
									echo '<b>Artikel:</b> <a href="'.urlencode(MyReplace($product_title)).'-ID-'.$item_id.'">'.word_count($product_title,2)."".' <i class="fa fa-arrow-right text-grey"></i></a><br>';

                    // Optie waardes nu laten zien. ================================================================================= //
										if(!empty($order['product_option']))
                    {
											$string = explode(';',$order['product_option']);
											foreach ($string as $key => $value)
                      {
												$real_value = explode('#',$value);

                        // Lege waarde vanwege explode er uit filteren, kan dat ook anders?	 ================================================================================= //
												if(!empty($real_value[0]))
                        {
													echo ''.$real_value[0].' '.$real_value[1].' &euro; '.$real_value[2].'<br>';
												}
											}
										}
?>
<?php echo $LANG['PIECES'] ?>: <?php echo $quantity; ?> st. | &euro; <?php echo number_format($order['price'], 2, ',', '.'); ?> p. st.<br>
<?php echo $LANG['TOTAL'] ?>: &euro; <?php echo number_format(($quantity * $price), 2, ',', '.'); ?> | <a href="basket-action.php?action=product_delete&product_id=<?php echo $item_id; ?>&order_idx=<?php echo $order['idx']; ?>" onclick="return confirm('Artikel compleet verwijderen?')" title="Verwijderen?"><i class="fa fa-trash-o"></i></i></a><br>

                  <hr>

<?php
      }
    }
  }
  else
  {
?>

				<p class="small"><i><?php echo $LANG['BASKET_EMPTY'] ?></i></p>

<?php } ?>

				<form method="post" action="basket.php">
					<p><button type="submit" class="btn"><?php echo $LANG['BASKET'] ?> <i class="fa fa-arrow-right text-white"></i></button></p>
				</form>

  <?php } ?>  <!-- EOF when consumer -->
  
  </div> <!-- EOF quarter -->  

<!-- ======================================================= LINE ======================================================= -->