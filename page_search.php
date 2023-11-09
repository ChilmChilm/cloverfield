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

	$page       = 'search.php';
	$menu_right = 0;
  
  // Sanitise search string.
  $searched = mysqli_real_escape_string(trim($_POST['que']));
  
  // Check input minimum of 3 characters needed.
  if(empty($searched) || (strlen($searched) < 3)) {
    echo '<script language="javascript">
            <!-- begin
            alert("Geef a.u.b. minimaal 3 letters als zoekwoord op!")
            // end -->
          </script>

          <script language="JavaScript">location.href="javascript:history.go(-1)"</script>';
    exit;
    }  
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
      
        <h1>Zoekresultaten voor: <span class="text-theme"><b><?php echo $searched; ?></b></span></h1>
        Klik op onderstaande resultaten om het artikel te bekijken.<br>
        <br>
        <?php
        
          $query = mysqli_query($conn, "SELECT * 
                                        FROM clo_products
                                        WHERE (product_number LIKE '%".$searched."%'
                                           OR product_title_".$_SESSION['language']." LIKE '%".$searched."%'
                                           OR product_note_".$_SESSION['language']."  LIKE '%".$searched."%'
                                           OR product_body_".$_SESSION['language']."  LIKE '%".$searched."%'
                                           OR keywords                                LIKE '%".$searched."%')
                                          AND active = '1'
                                          AND stock > '0'
                                          ");

          if(mysqli_num_rows($query) != 0)
          {
       ?>
        
        <table class="border">
        <tbody>
          <tr class="theme">
            <th>Artikelnummer:</th>
            <th></th>
            <th>Titel:</th>
            <th></th>
            <th>Prijs:</th>
          </tr>
            <?php
              while($id_product = mysqli_fetch_array($conn, $result))
              {
                echo '<tr class="border-bottom">
                        <td>'.$id_product['product_number'].'</td>
                        <td>&nbsp;</td>
                        <td><a href="'.urlencode(MyReplace($id_product['product_title_'.$_SESSION['language'].''])).'-ID-'.$id_product['idx'].'" title="'.$id_product['product_title_'.$_SESSION['language'].''].'"><img src="'.GetMyImages($id_product['idx'],1).'" height="30"> <i class="fa fa-arrow-right text-grey fa-fw"></i> '.word_count($id_product['product_title_'.$_SESSION['language'].''],3).'</a></td>
                        <td></td>
                        <td>';
                          if ($super['allow_consumer'] == 1 || $_SESSION['member'] == TRUE)
                          {
                            echo '&euro; '.fee_formula($id_product['price'],$config['fee_formula'],1);
                          }
                          else
                          {
                            echo '&nbsp;';
                          }
                echo '</td>
                      </tr>
                      ';
                }
              }
              else
              {
                echo '<h3>Geen resultaat gevonden voor <span class="text-theme"><b>'.$searched.'</b></span>, probeer het anders.</h3>';
              }
           ?>
        </tbody>
        </table>
        <br>
        <h1>Opnieuw zoeken</h1>  
  
          <form method="post" action="page_search.php" onFocus="doClear(this)">
            <input type="search" name="que" id="test" placeholder="Zoek" onclick="clear(this);">
            <button type="submit" class="button-none"><i class="fa fa-search-plus text-grey fa-lg"></i></button>
          </form>        

      </div>
    
    </div> <!-- EOF row  -->  

		<?php include 'footer.php'; ?>

	</body>

</html>