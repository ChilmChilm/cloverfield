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
  </head>

  <body id="top">

  <?php include "header.php"; ?>


    <div class="row max">
    
    <?php include "menu-left.php"; ?>
    
      <div class="twothird container">
			  <h1>FAQ</h1>
        
        <?php
          $query = mysqli_query($conn, "SELECT * FROM clo_faq ORDER BY sort_order");

          while($faq = mysqli_fetch_array($query))
          {
        ?>

         <i class="fa fa-question-circle fa-fw"></i> <b><?php echo $LANG['QUESTION'] ?>:</b> <em class="text-theme"><?php echo $faq['faq_question_'.$_SESSION['language'].'']; ?></em><br />
         <br />
         <i class="fa fa-comment-o fa-fw"></i> <b><?php echo $LANG['ANSWER'] ?>:</b> <?php echo $faq['faq_answer_'.$_SESSION['language'].'']; ?><br />
         <hr class="hr_grey" />

        <?php } ?>
						
      </div>
    
    </div> <!-- EOF row  -->  

    <?php include 'footer.php' ?>

  </body>

</html>