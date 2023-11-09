  
  <footer class="container theme-dark evo_footer">
    
    <div class="evo_full_width">
      <div style="margin-right: 25px;" class="tooltip right">
        <span class="text theme-dark"><?php echo $LANG['UP'] ?></span>&nbsp;   
        <a class="text-white" href="#evo_header"><span class="xlarge"><i class="fa fa-chevron-circle-up"></i></span></a>
      </div>
    </div>
    
    <div class="row-padding"> 
  
<!-- ======================================================= LINE ======================================================= -->  

      <div class="third">
        <h2 class="evo_footer_h2"><?php echo $LANG['CATEGORIES'] ?></h2>
        <div class="container" style="text-align: left;">
        
<?php
  $query = mysqli_query($conn, "SELECT * 
                                FROM clo_categories 
                                WHERE active = 1 
                                ORDER BY parent
                                ");

  while ($category = mysqli_fetch_array($query))
  {
    echo '<a href="'.urlencode(MyReplace($category['category_name_'.$_SESSION['language'].''])).'-C-'.$category['idx'].'" title="'.$category['category_name_'.$_SESSION['language'].''].'">'.$category['category_name_'.$_SESSION['language'].''].'</a> ';
  }
?>

        </div>
      </div> <!-- EOF third 1  -->
    
<!-- ======================================================= LINE ======================================================= -->    

      <div class="third">
        <h2 class="evo_footer_h2"><?php echo $LANG['INFORMATION'] ?></h2>
        <div class="container" style="text-align: left;">
          <a href="page-faq.php">FAQ</a><br>
          <a href="customer-register.php"><?php echo $LANG['REGISTER'] ?></a><br>

<?php if($super['allow_returns'] == 1) { ?>

          <a href="page-retour.php"><?php echo $LANG['RETOUR'] ?></a><br>

<?php } ?>

<?php
  $query = mysqli_query($conn, "SELECT * 
                                FROM clo_text 
                                WHERE text_menu = 'Onder' 
                                AND text_item = 'Algemeen' 
                                AND active = '1' 
                                ORDER BY sort_order
                                ");

  while ($text = mysqli_fetch_array($query))
  {
    echo '<a href="'.urlencode(MyReplace($text['text_title_'.$_SESSION['language'].''])).'-T-'.$text['idx'].'" title="Pagina '.$text['text_title_'.$_SESSION['language'].''].'">'.$text['text_title_'.$_SESSION['language'].''].'</a><br>';
  }
?>
        </div>
      </div> <!-- EOF third 2  -->
    
<!-- ======================================================= LINE ======================================================= -->    

      <div class="third">

<?php
  // Show the header social media.
  if($config['allow_social'] == 1)
  {
    echo '<h2 class="evo_footer_h2">'.$LANG['SOCIAL_MEDIA'].'</h2>';
  }
  else
  {
    echo '<h2 class="evo_footer_h2">'.$LANG['OTHERS'].'</h2>';
  }
?>

        <div class="container" style="text-align: left;">

<?php
  if($config['allow_social'] == 1)
  {
    if (!empty($config['social_facebook']))
    {
      echo '<a href="'.$config['social_facebook'].'" title="Facebook" target="_blank"><i class="fa fa-facebook-square text-white fa-1x  margin-right"></i></a>';
    }

    if (!empty($config['social_google_plus']))
    {
      echo '<a href="'.$config['social_google_plus'].'" title="Google+" target="_blank"><i class="fa fa-google-plus-square text-white fa-1x  margin-right"></i></a>';
    }

    if (!empty($config['social_instagram']))
    {
      echo '<a href="'.$config['social_instagram'].'" title="Instagram" target="_blank"><i class="fa fa-instagram text-white fa-1x margin-right"></i></a>';
    }

    if (!empty($config['social_linkedin']))
    {
      echo '<a href="'.$config['social_linkedin'].'" title="Linkedin" target="_blank"><i class="fa fa-linkedin-square text-white fa-1x  margin-right"></i></a>';
    }

    if (!empty($config['social_pinterest']))
    {
      echo '<a href="'.$config['social_pinterest'].'" title="Pinterest" target="_blank"><i class="fa fa-pinterest-square text-white fa-1x  margin-right"></i></a>';
    }

    if (!empty($config['social_twitter']))
    {
      echo '<a href="'.$config['social_twitter'].'" title="Twitter" target="_blank"><i class="fa fa-twitter-square text-white fa-1x margin-right"></i></a>';
    }

    if (!empty($config['social_youtube']))
    {
      echo '<a href="'.$config['social_youtube'].'" title="YouTube" target="_blank"><i class="fa fa-youtube-square text-white fa-1x  margin-right"></i></a>';
    }
  }
?>

        <h2><?php echo $LANG['NEWS'] ?></h2>

<?php
  $query = mysqli_query($conn, "SELECT * 
                                FROM clo_text 
                                WHERE text_item = 'Nieuws' 
                                AND active = '1' 
                                ORDER BY sort_order
                                ");

  while ($text = mysqli_fetch_array($query))
  {
    echo '<a href="text.php?id='.$text['idx'].'" title="'.$text['text_title_'.$_SESSION['language'].''].'">'.$text['text_title_'.$_SESSION['language'].''].'</a><br>';
  }
?>

        </div>
      </div> <!-- EOF third 3  -->
    
<!-- ======================================================= LINE ======================================================= -->    
  
    </div> <!-- EOF row-padding  -->  
    
    <div class="center evo_footer_center small">
      &copy; <?php echo $config['text_shop_footer']; ?><br>
      <br>
      <a href="cloverfield" title="Cloverfield Webwinkelsoftware" tarrget="_blank"><img src="layout/cloverfield-webwinkelsoftware-wit.png" alt="Cloverfield Webwinkelsoftware" style="border: none;"></a><br>
    </div> <!-- EOF center  -->
  
  </footer>  <!-- EOF footer  -->
  
  <!-- Script for the pop-up side navigation -->
  <script>
    function slide_down()
    {
      document.getElementsByClassName("sidenav")[0].style.width      = "100%";
      document.getElementsByClassName("sidenav")[0].style.textAlign  = "center";
      document.getElementsByClassName("sidenav")[0].style.fontSize   = "30px";
      document.getElementsByClassName("sidenav")[0].style.paddingTop = "6%";
      document.getElementsByClassName("sidenav")[0].style.display    = "block";
      document.getElementsByClassName("sidenav")[0].style.opacity    = "0.9";
    }

    function close_down()
    {
      document.getElementsByClassName("sidenav")[0].style.display    = "none";
    }
  </script>

  <script src="includes/js/w3codecolors.js"></script>     

<?php
  if(!empty($config['site_google']))
  {
    echo '<script>'.$config['site_google'].'</script>';
  }
?>