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
	$menu_right = 0;

	include 'includes/globals.php';

  // Very strange and have to research that /$ sign when $_REQUEST['id']
  $request = str_replace('/$', '', $_REQUEST['id']);

	!empty($request) ? $product_id = $request : $product_id = '';

	$query = mysqli_query($conn, "SELECT * 
                                FROM clo_products 
                                WHERE idx = '".$product_id."' 
                                AND active = 1 
                                AND stock > 0
                                ");

	$product = mysqli_fetch_array($query);

  // Verpakkingseenheid ophalen.
  $query2 = mysqli_query($conn, "SELECT * 
                                 FROM clo_units 
                                 WHERE idx = '".$product['product_unit']."'
                                 ");

  $unit = mysqli_fetch_array($query2);

  // Breadcrumb samenstellen.
	$query = mysqli_query($conn, "SELECT clo_products.cat_id , clo_categories.category_name_".$_SESSION['language']."
                                FROM clo_products, clo_categories
                                WHERE clo_products.cat_id = clo_categories.idx
                                AND clo_products.idx = '".$product['idx']."'
                                ");

  $crumb = mysqli_fetch_array($query);

	$crumb_total = '<div class="crumb">
                    <a href="index.php" title="Home"><i class="fa fa-home text-grey fa-lg"></i></a>
                    &raquo; <a href="'.str_replace(' ','-',$crumb['category_name_'.$_SESSION['language'].'']).'-C-'.$crumb['cat_id'].'.html">'.$crumb['category_name_'.$_SESSION['language'].''].'</a>
                    &raquo; <a href="'.urlencode(Myreplace($product['product_title_'.$_SESSION['language'].''])).'-ID-'.$product['idx'].'" title="'.$product['product_title_'.$_SESSION['language'].''].'">'.$product['product_title_'.$_SESSION['language'].''].'</a><br>
								  </div>
								  ';

  // Voorraad vinkje tonen of niet.
	if ($product['stock'] > 0)
  {
		$stock = '<tr>
						    <td><b>'.$LANG['STOCK'].':</b></td>
						    <td>&nbsp;</td>
						    <td><i class="fa fa-check text-green fa-lg"></i></td>
							</tr>';
  }
  else
  {
    $stock = '<tr>
                <td><b>'.$LANG['STOCK'].':</b></td>
                <td>&nbsp;</td>
                <td>Geen</td>
              </tr>';
	}
?>
<!DOCTYPE HTML>

<html lang="en-NL">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width">
		<title><?php echo $product['product_title_'.$_SESSION['language'].'']; ?> <?php echo $product['product_number']; ?></title>
		<meta name="Description" content="<?php echo $product['product_note_'.$_SESSION['language'].'']; ?>">
		<meta name="Keywords" content="<?php echo $product['keywords']; ?>">
		<?php include "header-meta.php"; ?>

		<script type="text/javascript" language="JavaScript" src="includes/js/functions.js"></script>

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
		
<!-- ======================================================= LINE ======================================================= -->

    <?php include "header.php"; ?>

<!-- ======================================================= LINE ======================================================= -->

          <div class="row max">
          
          <?php include "menu-left.php"; ?>
          
          <div class="threethird">
          
<!-- ======================================================= LINE ======================================================= --> 

					<form method="post" action="basket-action.php">
					<input type="hidden" name="action" value="product_update">
					<input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
          <input type="hidden" name="unit_value" value="<?php echo $unit['unit_value']; ?>">
					<input type="hidden" name="session_id" value="<?php echo session_id(); ?>">
        <?php if ($product['price_discount'] == '0.00') { ?>
          <input type="hidden" name="price" value="<?php echo str_replace(",",".",$product['price']); ?>">
        <?php } else { ?>
          <input type="hidden" name="price" value="<?php echo str_replace(",",".",$product['price_discount']); ?>">
        <?php } ?>

            <div class="third container border-right" style="padding-top: 15px;">
							
              <a href="#pop_image"><img src="<?php echo GetMyImages($product_id,1); ?>" alt="<?php echo $product['product_title_'.$_SESSION['language'].'']; ?>" class="image"></a><br>
              
		          <!-- Modal pop-up -->
		          <div id="pop_image" class="modal">
		            <div class="modal-dialog padding-large">
		            	
		            	<div class="right" style="margin: 10px 10px 10px 0;"><a href="#"><i class="fa fa-close text-white fa-2x"></i></a></div>
		            	
		              <div class="center modal-content animate-top center padding-64">
		                <img alt="Image" src="<?php echo GetMyImages($product_id,2); ?>" style="height: 85% !important;" class="image">
		              </div>
		              
		            </div>
		          </div>
		          <!-- END modal popup -->               
            
<!-- ======================================================= LINE ======================================================= -->            
                        
            <?php // Eventueel de meerdere afbeeldingen ophalen als die er zijn.
              $query = mysqli_query($conn, "SELECT image_name
                                            FROM clo_products_images
                                            WHERE id_product = '".$product_id."'
                                            ");

              $num_rows = mysqli_num_rows($query); // Even tellen.

              if ($num_rows > 1) // Is er meer als 1 afbeelding.
              {
                $count = 1;

                while($match = mysqli_fetch_array($result))
                {
           ?>
            
				          <!-- START Modal pop-up 2 -->
				          <div id="pop_image<?php echo $count; ?>" class="modal">
				            <div class="modal-dialog padding-large">
				            	
				            	<div class="right" style="margin: 10px 10px 10px 0;"><a href="#"><i class="fa fa-close text-white fa-2x"></i></a></div>
				            	
				              <div class="center modal-content animate-top center padding-24">
												<img alt="Image" src="uploads/products_normal/<?php echo $match['image_name']; ?>" style="width: 80% !important;" class="image">
				              </div>
				              
				            </div>
				          </div>
				          <!-- END Modal pop-up 2 -->
		             
		              <div class="left" style="width: 70px; margin: 0 10px 0 0;">
		                <a href="#pop_image<?php echo $count; ?>"><img src="uploads/products_thumbs/<?php echo $match['image_name']; ?>" alt="<?php echo $match['image_name']; ?>" style="width: 60px;" class="image"></a><br>
		              </div>
		              
		              <?php $count++; ?>
							
            <?php
                }
              }
           ?>
            
<!-- ======================================================= LINE ======================================================= -->            

            <div style="clear: both; padding: 0 !important; margin: 0 !important; width: 100%">&nbsp;</div>
            <br>
            <b><?php echo $LANG['ORDERED_TODAY'] ?>:</b><br>
            <i><?php echo $config['shop_delivery']; ?></i><br>
          <?php  
            if ($super['allow_consumer'] == 1 || $_SESSION['member'] == TRUE)
            {
              if ($product['price_discount'] != '0.00')
              {
         ?>

            <h1 class="text-theme"><?php echo $LANG['NOW'] ?> <i>&euro; <?php echo fee_formula($product['price_discount'],$config['fee_formula'],$unit['unit_value']); ?></i></h1>
            <?php echo $LANG['NORMALLY'] ?> <?php echo fee_formula($product['price'],$config['fee_formula'],$unit['unit_value']); ?><br>

          <?php } else { ?>

            <span class="text-theme" style="font-size: 160%; font-weight: 700;">&euro; <?php echo fee_formula($product['price'],$config['fee_formula'],$unit['unit_value']); ?></span>&nbsp;&nbsp;<span class="sup"><?php echo $tax_included; ?></span>
            

          <?php if($product['product_unit'] != 1) { // unit value is niet 1 dan ook stuksprijs tonen ?>
           
            <b><?php echo $LANG['SEARCH'] ?>: <span class="text-theme" style="font-size: 160%; font-weight: 700;">&euro; <?php echo fee_formula($product['price'],$config['fee_formula'],1); ?></span>&nbsp;&nbsp;<span class="sup"><?php echo $tax_included; ?></span></b><br>

          <?php 
              } 
             }
            }
         ?>              

            </div>
            
<!-- ======================================================= LINE ======================================================= -->            

						<div class="twothird container margin-bottom">

							<table>
              <tbody>
                <tr>
                  <td colspan="3">
                    <?php echo $crumb_total; ?>
                    <h1><?php echo word_count($product['product_title_'.$_SESSION['language'].''],5); ?></h1>
                    <?php echo $product['product_note_'.$_SESSION['language'].'']; ?><br>
                    <br>
                  </td>
                </tr>

							  <tr>
						      <td><b><?php echo $LANG['ARTICLE_NR'] ?>:</b></td>
						      <td></td>
						      <td><em><?php echo $product['product_number']; ?></em></td>
							  </tr>

                <tr>
                  <td><b><?php echo $LANG['PACKED'] ?>:</b></td>
                  <td></td>
                  <td><em><?php echo $unit['unit_name_'.$_SESSION['language'].'']; ?> - <?php echo $unit['unit_value']; ?></em> <?php echo $LANG['PIECES'] ?></td>
                </tr>

							  <?php echo $stock; ?>

							  <?php
							    // Documenten ophalen.
								  $query = mysqli_query($conn, "SELECT * 
                                                FROM clo_products_docs 
                                                WHERE id_product = '".$product_id."'
                                                ");

								  if(mysqli_num_rows($query) != 0)
                  {
									  while($doc = mysqli_fetch_array($query))
                    {
							 ?>

							  <tr>
						      <td><b><?php echo $LANG['DOCUMENT'] ?>:</b> <span class="small"></span></td>
						      <td>&nbsp;</td>
						      <td><a href="uploads/docs/<?php echo $doc['doc_name']; ?>" target="_blank"><i class="fa fa-file-o text-grey fa-lg"></i>&nbsp;&nbsp;&nbsp;<?php echo $doc['doc_name']; ?></a></td>
							  </tr>

						  <?php
									  }
								  }
						   // Is het metermateriaal?
							  if ($product['meter'] == 0) {
						 ?>

              <?php echo GetMyOptions($product_id); ?>

                <?php  if ($super['allow_consumer'] == 1 || $_SESSION['member'] == TRUE AND $product['stock'] > 0) { ?>
                <tr>
                  <td><b><?php echo $LANG['PIECES'] ?>:</b></td>
                  <td></td>
                  <td><input type="text" name="quantity" value="1" class="input_numbers"></td>
                </tr>
                <?php } ?>

              <?php } elseif ($product['meter'] == 1) { ?>
                <tr>
                  <td colspan="3">
                    <hr>
                    <b><?php echo $LANG['METER_MATERIAL'] ?>:</b><br>
						        <?php echo $LANG['METER_1'] ?><br>
						        <?php echo $LANG['METER_2'] ?> &euro; <?php echo $config['fee_cutting']; ?><br>
						        <br>
						        <?php echo $LANG['METER_3'] ?>:&nbsp;&nbsp;&nbsp;<input type="text" name="quantity" value="1" class="input_short">&nbsp;&nbsp;&nbsp;<?php echo $LANG['OFF'] ?>:&nbsp;&nbsp;&nbsp;<input type="text" name="millimeter" value="3000" class="input_numbers">&nbsp;&nbsp;&nbsp;mm.<br>
                 </td>
               </tr>
              <?php } ?>

              <tr>
                <td colspan="3">
                  <?php  if ($super['allow_consumer'] == 1 || $_SESSION['member'] == TRUE AND $product['stock'] > 0) { ?>
                  <br><button type="submit" class="btn"><?php echo $LANG['ORDER'] ?></button><br>
                  <?php } ?>                
                </td>
              </tr>
            
          </tbody>
          </table>

					</form>

					</div>  <!-- END threethird -->
          
<!-- ======================================================= LINE ======================================================= -->          
          <div class="container">&nbsp;</div>

					<div id="box_tabs">

						<div id="tab-container" class="tab-container">

              <ul class="etabs">
						    <li class="tab"><a href="#tabs1-1"><?php echo $LANG['DESCRIPTION'] ?></a></li>
								<?php
									if($config['allow_cross_selling'] == 1) {
										if (!empty($product['related'])) {
								?>
								<li class="tab"><a href="#tabs1-2"><?php echo $LANG['SEE_ALSO'] ?></a></li>
								<?php
										}
									}

									if (!empty($product['product_technical_'.$_SESSION['language'].''])) {
								?>
						    <li class="tab"><a href="#tabs1-3"><?php echo $LANG['DETAILS'] ?></a></li>
							<?php } ?>
						  </ul>

						  <div id="tabs1-1" class="viewport"><?php echo $product['product_body_'.$_SESSION['language'].'']; ?></div>

							<?php
								if($config['allow_cross_selling'] == 1) {
									if (!empty($product['related'])) {
							?>

							<div id="tabs1-2" class="viewport">
								<?php // Bijproducten tonen of niet.
									if (empty($product['related'])) {
								?>
								<?php echo $LANG['NO_CROSS_SELLING'] ?>
								<?php
									}
                  else
                  {
                    $cross = explode(';',$product['related']);
                    foreach($cross as $key)
                    {
                      $query = mysqli_query($conn, "SELECT * 
                                                    FROM clo_products 
                                                    WHERE idx = '".$key."'
                                                    ");

                      $product_cross = mysqli_fetch_array($query);
								?>
								<div class="third container center">
									<a href="<?php echo urlencode(MyReplace($product_cross['product_title_'.$_SESSION['language'].''])); ?>-ID-<?php echo $product_cross['idx']; ?>"><img src="<?php echo GetMyImages($product_cross['idx'],1); ?>" alt="<?php echo $product_cross['product_title_'.$_SESSION['language'].'']; ?>" class="image"></a>
                <?php  if ($super['allow_consumer'] == 1 || $_SESSION['member'] == TRUE) { ?>
                  <h3>Prijs: <i>&euro; <?php echo fee_formula($product_cross['price'],$config['fee_formula'],$unit['unit_value']); ?></i></h3><br>
                <?php } ?>
								</div>
								<?php
											}
										}
								?>
								</div>

								<?php
									}
								}// EOF allow_cross_selling.

                if (!empty($product['product_technical_'.$_SESSION['language'].'']))
                {
               ?>
                
                <div id="tabs1-3" class="viewport"><?php echo nl2br($product['product_technical_'.$_SESSION['language'].'']); ?></div>
             
              <?php } ?>              
              
						  </div> <!-- EOF tab-container -->
              
            </div> <!-- END box-tabs --> 
            
<!-- ======================================================= LINE ======================================================= -->                

          <?php
            if($menu_right)
            {
              include 'menu-right.php';
            }
         ?> 
        
        </div> <!-- END row -->

      </div> <!-- ????? -->
            
<!-- ======================================================= LINE ======================================================= -->

    <?php include 'footer.php'; ?>

<!-- ======================================================= LINE ======================================================= -->

	</body>

</html>
