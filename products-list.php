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

  $cat_id = mysqli_real_escape_string($conn, $_REQUEST['id']);

  $query = mysqli_query($conn, "SELECT * FROM clo_categories WHERE idx = '".$cat_id."'");
  $name  = mysqli_fetch_assoc($query);

  !empty($name['category_name']) ? $paging_name = $name['category_name'] : $paging_name = '';
?>
<!DOCTYPE HTML>

<html lang="en-NL">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width">
		<title><?php echo $name['category_name_'.$_SESSION['language'].'']; ?></title>
		<meta name="Description" content="<?php echo $name['category_name_'.$_SESSION['language'].'']; ?>" />
		<meta name="Keywords" content="<?php echo $config['site_keywords']; ?>" />
		<?php include "header-meta.php"; ?>
	</head>

	<body id="top">

<!-- ======================================================= LINE ======================================================= -->

    <?php include "header.php"; ?>

<!-- ======================================================= LINE ======================================================= -->

          <div class="row max">
          
          <?php include "menu-left.php"; ?>
          
          <div class="threethird">

				    <h1><span class="padding-left text-theme"><?php echo $LANG['CATEGORY'] ?>:</span> <?php echo $name['category_name_'.$_SESSION['language'].'']; ?></h1>
            <br>
            
<!-- ======================================================= LINE ======================================================= -->           

        <?php
          // Show the banners when available.
          if($config['allow_banners'] == 1)
          {
            $query = mysqli_query($conn, "SELECT * FROM clo_banners WHERE bind_id = '".$cat_id."' AND active = '1'");

            if (mysqli_num_rows($query) > 0)
            {
              echo '<div id="sliderFrame" class="slider_products_list">
                      <div id="slider">';

              while($banner = mysqli_fetch_array($query))
              {
                echo '<a href="'.$banner['banner_url'].'" title="'.$banner['banner_txt_'.$_SESSION['language'].''].'"><img src="uploads/banners/'.$banner['banner_image'].'" alt="'.$banner['banner_txt_'.$_SESSION['language'].''].'" /></a>';
              }

              echo '</div> <!-- EOF sliderFrame -->
                  </div> <!-- EOF slider -->';
            }
          }
       ?>
        
<!-- ======================================================= LINE ======================================================= -->         

			<?php
          // Heeft deze categorie soms subcategorieen?
					$query = mysqli_query($conn, "SELECT * FROM clo_categories WHERE parent = '".$cat_id."' AND active = '1'");
					$sub   = mysqli_fetch_array($query);

/* ======================================================== LINE ======================================================== */

          // Geen subcategorieen we laten dus direct de gekoppelde artikelen zien.
					if($sub['parent'] != $cat_id) 
          {
            // Eventuele gekoppelde tekst weergeven.
						$query = mysqli_query($conn, "SELECT * FROM clo_text WHERE text_category = '".$cat_id."' AND active = '1'");
						$text = mysqli_fetch_array($query);

						if($text['text_category'] != 0)
            {
							echo '<h1>'.$text['text_title_'.$_SESSION['language'].''].'</h1>';
							echo $text['text_body_'.$_SESSION['language'].''];
						}

            include 'includes/pager_get.php';
            $pager = mysqli_query($conn, "SELECT * 
                                          FROM clo_products 
                                          WHERE cat_id = '".$cat_id."' 
                                          AND active = 1 
                                          AND stock > 0
                                          ORDER BY sort_order
                                          ASC LIMIT $start_from, $limit
                                          ");

						while ($product = mysqli_fetch_assoc($pager))
            {
              // Verpakkingseenheid ophalen.
              $query2 = mysqli_query($conn, "SELECT * FROM clo_units WHERE idx = '".$product['product_unit']."'");
              $unit = mysqli_fetch_array($query2);
						?>

						<div class="row padding-bottom border-bottom">

			        <div class="third container">
								<a href="<?php echo urlencode(MyReplace($product['product_title_'.$_SESSION['language'].''])); ?>-ID-<?php echo $product['idx']; ?>" title="<?php echo $product['product_title_'.$_SESSION['language'].'']; ?>"><img src="<?php echo GetMyImages($product['idx'],2); ?>" alt="<?php echo $product['product_title_'.$_SESSION['language'].'']; ?>" border="0" style="width: 100%;" class="image radius-3"></a>
			        </div>

              <div class="twothird padding-left">

                <div class="">
									<h2><a href="<?php echo urlencode(MyReplace($product['product_title_'.$_SESSION['language'].''])); ?>-ID-<?php echo $product['idx']; ?>"><?php echo word_count($product['product_title_'.$_SESSION['language'].''],8); ?></a></h2>
								</div>
                
                <a href="<?php echo urlencode(MyReplace($product['product_title_'.$_SESSION['language'].''])); ?>-ID-<?php echo $product['idx']; ?>"><?php echo ''.strip_tags(word_count($product['product_body_'.$_SESSION['language'].''],3)).'... <i>'.$LANG['MORE'].' &raquo;</i>'; ?></a>

				        <?php
									if ($super['allow_consumer'] == 1 || $_SESSION['member'] == TRUE)
                  {
										if ($product['price_discount'] == '0.00')
                    {
                      echo '<h2 class="text-theme"><i><a href="'.urlencode(MyReplace($product['product_title_'.$_SESSION['language'].''])).'-ID-'.$product['idx'].'">&euro; '.fee_formula($product['price'],$config['fee_formula'],1).'</a></i></h2>';
										}
                    else
                    {
                      echo '<h2 class="text-theme"><i>'.$LANG['NOW'].': <a href="'.urlencode(MyReplace($product['product_title_'.$_SESSION['language'].''])).'-ID-'.$product['idx'].'">&euro; '.fee_formula($product['price_discount'],$config['fee_formula'],1).'</a> <span style="font-size: 65%;">'.$LANG['NORMALLY'].': &euro; '.fee_formula($product['price'],$config['fee_formula'],1).'</i></span></h2>';
                    }
                    }
                  else
                  {
										echo '<h2 class="text-theme">N.v.t.</h2>';
									}
								?>
                
                <a href="<?php echo urlencode(MyReplace($product['product_title_'.$_SESSION['language'].''])); ?>-ID-<?php echo $product['idx'] ?>" class="btn"><?php echo $LANG['MORE'] ?> <i class="fa fa-arrow-right text-white"></i></a><br>
									
							</div>
						</div>
            
						<?php
								}
							}
              else
              {
						?>
                  
<!-- ======================================================= LINE ======================================================= -->                  
                  
						  <?php
                // Er zijn WEL nog subcategorieen dus laat deze nu zien.
                // Eventuele gekoppelde tekst weergeven.
							  $query = mysqli_query($conn, "SELECT * FROM clo_text WHERE text_category = '".$cat_id."' AND active = '1'");
							  $text = mysqli_fetch_array($query);

							  if($text['text_category'] != 0)
                {
						 ?>
						  <h1><?php echo $text['text_title_'.$_SESSION['language'].'']; ?></h1> 
						  
						  <div class="threethird padding">
						  <?php echo $text['text_body_'.$_SESSION['language'].''];
							  }

							  $query = mysqli_query($conn, "SELECT * 
                                              FROM clo_categories 
                                              WHERE parent = '".$cat_id."' 
                                              AND active = '1' 
                                              ORDER BY sort_order DESC
                                              ");

							  while ($category = mysqli_fetch_array($query))
                {
								  if (!empty($category['category_image']))
                  { // Is er een categorie afbeelding aanwezig.
									  $cat_image = ''.$config['path_abs'].'/uploads/categories_thumbs/'.$category['category_image'].'';
									  }
                    else
                    {
                      $cat_image = 'layout/no-image.png';
                    }
						 ?>

                <div class="row padding margin-bottom margin-top border-bottom border">
                  <div class="half left" style="padding: 8px 0 8px 0 !important;">
                   <div class="cat-image">
                   	<a href="<?php echo urlencode(MyReplace($category['category_name_'.$_SESSION['language'].''])); ?>-<?php echo $category['idx']; ?>" title="<?php echo $category['category_name_'.$_SESSION['language'].'']; ?>"><img src="<?php echo $cat_image; ?>" alt="<?php echo $category['category_name_'.$_SESSION['language'].'']; ?>" style="max-width: 100%" /></a>
                   </div>
                  </div>
                 
                  <div class="half right">
                    <h3 style="margin-left: -6px !important;"><a href="<?php echo urlencode(MyReplace($category['category_name_'.$_SESSION['language'].''])); ?>-<?php echo $category['idx']; ?>" title="<?php echo $category['category_name_'.$_SESSION['language'].'']; ?>" class="text-red"><?php echo $category['category_name_'.$_SESSION['language'].'']; ?></a></h3>
                    <p><?php echo $category['category_note']; ?></p> 
                    <a href="<?php echo urlencode(MyReplace($category['category_name_'.$_SESSION['language'].''])); ?>-<?php echo $category['idx']; ?>" title="<?php echo $category['category_name_'.$_SESSION['language'].'']; ?>" class="btn">Alles <i class="fa fa-arrow-right text-white"></i></a>
                  </div>
                </div>              
              

						  <?php
								  }
							  }
						 ?>
              
             </div> <!-- END subcat wrap -->

<!-- ======================================================= LINE ======================================================= -->                

			      <div class="container center" style="clear: both;">
              <?php
                $result_db     = mysqli_query($conn,"SELECT COUNT(idx) FROM clo_products WHERE cat_id = $cat_id");
                $row_db        = mysqli_fetch_row($result_db);
                $total_records = $row_db[0];
                $total_pages   = ceil($total_records / $limit);

                echo '<ul style="list-style-type: none !important;">';
                for ($i = 1; $i <= $total_pages; $i++)
                {
                  echo '<li style="display: inline-block;">
                          <a style="color: white; background-color: #333333; margin-right: 3px;" href="'.$paging_name.'?page='.$i.'">'.$i.'</a>
                        </li>';
                }
                echo '</ul>';
              ?>
			      </div>

          </div> <!-- END threethird -->  
          
          <?php
            if($menu_right)
            {
              include 'menu-right.php';
            }
          ?>
        
        </div> <!-- END row -->                   
            
<!-- ======================================================= LINE ======================================================= -->

    <?php include 'footer.php'; ?>

<!-- ======================================================= LINE ======================================================= -->

  </body>

</html>