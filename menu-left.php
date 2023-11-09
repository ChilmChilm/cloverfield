  
  <div class="quarter menu-left" style="text-align: left; padding: 10px 0 25px 15px;">

<!-- ======================================================= LINE ======================================================= -->

    <h4><?php echo $LANG['CATEGORIES'] ?></h4>
    
<?php
  // Vraag de volledige url op.
  $url = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

  // Sloop alles er af t/m de laatste slash.
  $clicked = substr($url, strrpos($url, '/') + 1);
  
  // Alle Hoofdcategorieen van de shop ophalen.
  $query = mysqli_query($conn,"SELECT * 
                               FROM clo_categories 
                               WHERE parent = 0 
                               AND active = 1 
                               ORDER BY sort_order
                               ");

  while ($category = mysqli_fetch_array($query)) 
  {
 ?>
      
      <i class="fa fa-heart text-theme"></i> <a href="<?php echo urlencode(MyReplace($category['category_name_'.$_SESSION['language'].''])); ?>-<?php echo $category['idx']; ?>" title="<?php echo $category['category_name_'.$_SESSION['language'].'']; ?>"><?php echo $category['category_name_'.$_SESSION['language'].'']; ?></a><br>

    <?php 
      // Als het de category met subitems is waarop geklikt is.
      if($clicked == urlencode(MyReplace($category['category_name_'.$_SESSION['language'].''])).'-'.$category['idx']) {

        // Alle Subcategorieen van de categorie ophalen.
          $query2 = mysqli_query($conn,"SELECT * 
                                        FROM clo_categories 
                                        WHERE parent = '".$category['idx']."' 
                                        AND active = 1 
                                        ORDER BY sort_order
                                        ");

          while ($sub = mysqli_fetch_array($query2)) {
   ?>
    
            <p style="font-size: 85%;"><i class="fa fa-square text-white"></i> <a href="<?php echo urlencode(MyReplace($sub['category_name_'.$_SESSION['language'].''])); ?>-<?php echo $sub['idx']; ?>" title="<?php echo $sub['category_name_'.$_SESSION['language'].'']; ?>" class="text-theme"><?php echo $sub['category_name_'.$_SESSION['language'].'']; ?></a></p>
   
    <?php
          }
        }
      } 
   ?>
  
<!-- ======================================================= LINE ======================================================= -->


	<h4><i class="fa fa-info-circle"></i></h4>
		<a href="index.php" title="Naar de homepagina"><?php echo $LANG['HOME'] ?></a><br>
	<?php // Alle tekstpagina's van de shop ophalen.
		$query = mysqli_query($conn,"SELECT * 
                                 FROM clo_text 
                                 WHERE text_menu = 'Links' 
                                 AND text_item = 'Algemeen' 
                                 AND active = '1' 
                                 ORDER BY sort_order
                                 ");

		while ($text = mysqli_fetch_array($query)) 
    {
?>
		<a href="<?php echo urlencode(MyReplace($text['text_title_'.$_SESSION['language'].''])); ?>-T-<?php echo $text['idx']; ?>" title="<?php echo $text['text_title_'.$_SESSION['language'].'']; ?>"><?php echo $text['text_title_'.$_SESSION['language'].'']; ?></a><br>
<?php } 
      if($super['allow_returns'] == 1) 
      { 
?>
        
  <a href="page-retour.php"><?php echo $LANG['RETOUR'] ?></a><br>
        
<?php } ?>
	<br>	

<!-- ======================================================= LINE ======================================================= -->
  
<?php echo $config['text_sidebar']; ?>
  
  </div>