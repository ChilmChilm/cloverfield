<?php
/*************************************************
 Copyright : (C) 2021 - Cloverfield
 Mail: chilm@planet.nl
 Change date : 20 - 02 - 2022
**************************************************/
	header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
	header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
	header("Cache-Control: post-check=0, pre-check=0",false);
	session_cache_limiter("must-revalidate");

	session_start();
	include 'includes/globals.php';
	$menu_right = 1;

  if(isset($_GET['language']))
  {
    unset($_SESSION['language']);
    $language = mysqli_real_escape_string($conn, $_GET['language']);
  }
  else
  {
    $language = 'nl';
  }
  
  $_SESSION['language'] = $language;
  
  if(empty($_SESSION['language']))
  {
    $_SESSION['language'] = 'nl';
    $language = $_SESSION['language'];
  }	
?>
<!DOCTYPE html>

<html lang="en-NL">

	<head>

    <!-- Cloverfield Shop -->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width">
		<title><?php echo $config['site_title']; ?></title>
		<meta name="Description" content="<?php echo $config['site_description']; ?> | Cloverfield Shop" />
		<meta name="Keywords" content="<?php echo $config['site_keywords']; ?>, Cloverfield Shop" />
		<?php include "header-meta.php"; ?> 
		
	</head>

	<body id="top">

<!-- ======================================================= LINE ======================================================= -->

		<?php include "header.php"; ?>

<!-- ======================================================= LINE ======================================================= -->

          <div class="row max">
          
          <?php include "menu-left.php"; ?>
          
          <div class="half container border-left border-right"> 
          	
          <!-- ========================= SHORTY ========================= -->
          
            <?php
							// Eventueel banners weergeven.
							if($config['allow_banners'] == 1) {
                $query = mysqli_query($conn,"SELECT * 
                                             FROM clo_banners 
                                             WHERE banner_type = 'homepage' 
                                             AND active = 1
                                             ");

							  if (mysqli_num_rows($query) > 0) {

                  echo '<div class="flexslider">
												  <ul class="slides">';

									while($banner = mysqli_fetch_array($query))
                  {
										echo '<li>
														<a href="'.$banner['banner_url'].'"><img src="uploads/banners/'.$banner['banner_image'].'" alt="'.$banner['banner_txt_'.$_SESSION['language'].''].'" class="image"></a>
														<p class="flex-caption">'.$banner['banner_txt_'.$_SESSION['language'].''].'</p>
													</li>';
									}

								  echo '</ul> <!-- EOF slider -->
										  </div> <!-- EOF sliderFrame -->';
							  }
              }
           ?>
              
            <div class="head theme-blue" style="margin-bottom: 35px;"><h2 class="text-white"><?php echo $LANG['CATEGORIES'] ?></h2></div>          

            <?php
							// Alle categorieen van de shop ophalen.
							$query = mysqli_query($conn,"SELECT * 
                                           FROM clo_categories 
                                           WHERE parent = 0 
                                           AND active = 1 
                                           ORDER BY sort_order
                                           ");

              while ($category = mysqli_fetch_array($query))
              {
								// Is er een categorie afbeelding aanwezig.
								if (!empty($category['category_image']))
                {
									$cat_image = 'uploads/categories_thumbs/'.$category['category_image'].'';
								}
                else
                {
									$cat_image = 'layout/no-image.png';
								}
              ?>
                
                <div class="row border">
                  <div class="half container">
                    <p><a href="<?php echo urlencode(MyReplace($category['category_name_'.$_SESSION['language'].''])); ?>-<?php echo $category['idx']; ?>" title="<?php echo $category['category_name_'.$_SESSION['language'].'']; ?>"><img src="<?php echo $cat_image; ?>" alt="<?php echo $category['category_name_'.$_SESSION['language'].'']; ?>" style="width:100%"></a></p>
                  </div>
                  <div class="half container">
                    <h2><a href="<?php echo urlencode(MyReplace($category['category_name_'.$_SESSION['language'].''])); ?>-<?php echo $category['idx']; ?>" title="<?php echo $category['category_name_'.$_SESSION['language'].'']; ?>"><?php echo $category['category_name_'.$_SESSION['language'].'']; ?></a></h2> 
                    <p><a href="<?php echo urlencode(MyReplace($category['category_name_'.$_SESSION['language'].''])); ?>-<?php echo $category['idx']; ?>" title="<?php echo $category['category_name_'.$_SESSION['language'].'']; ?>" class="btn"><?php echo $LANG['ALL'] ?> <i class="fa fa-arrow-right text-white"></i></a></p> 
                  </div>
                </div>

            <?php
							}
						
/* ========================================================================== LIJNTJE ========================================================================== */						

							// Alle aanbiedingen van de shop ophalen.
              if($config['allow_featured'] == 1) {
                
                $query = mysqli_query($conn,"SELECT * 
                                             FROM clo_products 
                                             WHERE offer = 1
                                             AND active = 1 
                                             ORDER BY sort_order 
                                             LIMIT ".$config['allow_featured_nr']."
                                             ");

							  if (mysqli_num_rows($query) != 0) {
							?>

              <div class="head theme-blue" style="margin-bottom: 50px;"><h2 class="text-white"><?php echo $LANG['OFFER'] ?></h2></div>
              
						  <?php while ($offer = mysqli_fetch_array($query)) { ?>
                
                <div class="row">
                
                  <div class="half container card-2">
                    <p><a href="<?php echo urlencode(MyReplace($offer['product_title_'.$_SESSION['language'].''])); ?>-ID-<?php echo $offer['idx']; ?>" title="<?php echo $offer['product_title_'.$_SESSION['language'].'']; ?>"><img src="<?php echo GetMyImages($offer['idx'],2); ?>" alt="<?php echo $offer['product_title_'.$_SESSION['language'].'']; ?>" border="0" style="width:100%"></a></p>
                  </div>
                  
                  <div class="half container">
                    <h4><a href="<?php echo urlencode(MyReplace($offer['product_title_'.$_SESSION['language'].''])); ?>-ID-<?php echo $offer['idx']; ?>" title="<?php echo $offer['product_title_'.$_SESSION['language'].'']; ?>"><?php echo word_count($offer['product_title_'.$_SESSION['language'].''],8); ?></a></h4> 
                    
                    <?php
                      if ($super['allow_consumer'] == 1 || $_SESSION['member'] == TRUE) {
                        echo '<b class="text-blue"><a href="'.urlencode(MyReplace($offer['product_title_'.$_SESSION['language'].''])).'-ID-'.$offer['idx'].'" title="'.$offer['product_title_'.$_SESSION['language'].''].'">'.$LANG['NORMAL'].' &euro; '.fee_formula($offer['price'],$config['fee_formula'],1).'</a></b><br>';
                        echo '<h2 class="text-green"><a href="'.urlencode(MyReplace($offer['product_title_'.$_SESSION['language'].''])).'-ID-'.$offer['idx'].'" title="'.$offer['product_title_'.$_SESSION['language'].''].'">'.$LANG['NOW'].' &euro; '.fee_formula($offer['price_discount'],$config['fee_formula'],1).'</a></h2>';                        
                        } else {
                            echo '';
                      }
                   ?> 
                    
                    <p class="left"><a href="<?php echo urlencode(MyReplace($offer['product_title_'.$_SESSION['language'].''])); ?>-ID-<?php echo $offer['idx']; ?>" title="<?php echo $offer['product_title_'.$_SESSION['language'].'']; ?>" class="btn"><?php echo $LANG['MORE'] ?> <i class="fa fa-arrow-right text-white"></i></a></p>

                	</div> 
                
                </div> <!-- END row -->                          
                  
            <?php
                }
              }
            }
                
/* ========================================================================== LIJNTJE ========================================================================== */                                    

							// De nieuwste artikelen ophalen.
              if($config['allow_new_products'] == 1) {
                
                $query = mysqli_query($conn,"SELECT * 
                                             FROM clo_products 
                                             WHERE active = 1 
                                             AND stock > 0 
                                             ORDER BY idx DESC 
                                             LIMIT ".$config['allow_new_products_nr']."
                                             ");

							  if (mysqli_num_rows($query) != 0) {
							?>

              <div class="head theme-blue" style="margin-bottom: 50px;"><h2 class="text-white"><?php echo $LANG['NEW_PRODUCTS'] ?></h2></div>
              
						  <?php while ($new = mysqli_fetch_array($query)) { ?>
                
                <div class="row">
                
                  <div class="half container card-2">
                    <p><a href="<?php echo urlencode(MyReplace($new['product_title_'.$_SESSION['language'].''])); ?>-ID-<?php echo $new['idx']; ?>" title="<?php echo $new['product_title_'.$_SESSION['language'].'']; ?>"><img src="<?php echo GetMyImages($new['idx'],2); ?>" alt="<?php echo $new['product_title_'.$_SESSION['language'].'']; ?>" border="0" style="width:100%"></a></p>
                  </div>
                  
                  <div class="half container">
                    <h4><a href="<?php echo urlencode(MyReplace($new['product_title_'.$_SESSION['language'].''])); ?>-ID-<?php echo $new['idx']; ?>" title="<?php echo $new['product_title_'.$_SESSION['language'].'']; ?>"><?php echo word_count($new['product_title_'.$_SESSION['language'].''],8); ?></a></h4> 
                    
                    <?php
                      if ($super['allow_consumer'] == 1 || $_SESSION['member'] == TRUE) {
                        echo '<h2 class="text-green"><a href="'.urlencode(MyReplace($new['product_title_'.$_SESSION['language'].''])).'-ID-'.$new['idx'].'" title="'.$new['product_title_'.$_SESSION['language'].''].'">&euro; '.fee_formula($new['price'],$config['fee_formula'],1).'</a></h2>';                        
                        } else {
                            echo '';
                      }
                   ?> 
                    
                    <p class="left"><a href="<?php echo urlencode(MyReplace($new['product_title_'.$_SESSION['language'].''])); ?>-ID-<?php echo $new['idx']; ?>" title="<?php echo $new['product_title_'.$_SESSION['language'].'']; ?>" class="btn"><?php echo $LANG['MORE'] ?> <i class="fa fa-arrow-right text-white"></i></a></p>

                	</div> 
                
                </div> <!-- END row -->                          
                  
            <?php
                }
              }
            }

							// Homepage tekst weergeven.
							$query = mysqli_query($conn,"SELECT * 
                                           FROM clo_text 
                                           WHERE homepage = 1 
                                           AND active = 1
                                           ");

							$text = mysqli_fetch_array($query);

							//echo '<h1>'.$text['text_title_'.$_SESSION['language'].''].'</h1>';
							echo $text['text_body_'.$_SESSION['language'].''];
						?>            

<!-- ========================================================================== LIJNTJE ========================================================================== -->                                                    
          </div> <!-- END half container -->  
          
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