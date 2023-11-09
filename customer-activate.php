<?php 
/*************************************************
 Copyright : (C) 2021 - Cloverfield
 Mail: chilm@planet.nl
 Change date : 06 - 10 - 2021
**************************************************/
	session_start();
   	
	include 'includes/globals.php';
	$page       = 'customer-activate.php'; 
	$menu_right = 0;
  
  isset($_REQUEST['email']) ? $email = mysqli_real_escape_string($conn, $_REQUEST['email']) : $email ='';
  isset($_REQUEST['code']) ? $code = mysqli_real_escape_string($conn, $_REQUEST['code']) : $code ='';

  $query = mysqli_query($conn, "SELECT * 
                                FROM clo_customers_reset 
                                WHERE email = '".$email."' 
                                AND activation_code = '".$code."'
                                ");

  $row    = mysqli_fetch_array($query);
  
  if(($row['email'] == $email) AND ($row['activation_code'] == $code))
  {
    mysqli_query ($conn, "UPDATE clo_customers 
                          SET `password` = '".$row['new_password']."' 
                          WHERE username = '".$email."'
                          ");

    mysqli_query ($conn, "UPDATE clo_customers_reset 
                          SET visited = 1 
                          WHERE idx = '".$row['idx']."' 
                          AND activation_code = '".$code."' 
                          LIMIT 1
                          ");
  }
?>
<!DOCTYPE HTML>

<html lang="en-NL">

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf8">
    <meta name="viewport" content="width=device-width">
    <title><?php echo $config['site_title']; ?></title>
    <meta name="Description" content="<?php echo $config['site_description']; ?>" />
    <meta name="Keywords" content="<?php echo $config['site_keywords']; ?>" />
    <?php include "header-meta.php"; ?>
  </head>
  
  <body id="top">
	
		<?php include "header.php"; ?>
		
    <div align="center" class="row max">
    
      <div class="evo_page padding-64">
      
       <h2>Uw wachtwoord is succesvol aangepast.</h2>
       U kunt nu <a href="login.php">inloggen</a> en eventueel uw wachtwoord weer veranderen of aanpassen.<br>
       Uw gebruikersnaam is altijd het emailadres waarmee u bij ons geregistreerd bent.<br>
       <br>
       Is e.e.a. niet duidelijk bel dan met ons team T: <b><?php echo $config['shop_phone']; ?></b><br>
       <br>
       <a title="Naar de homepage..." href="index.php"><i class="fa fa-home fa-2x"></i></a><br>
      
      </div>
    
    </div> <!-- EOF row  -->

		<?php include 'footer.php'; ?>	

  </body>
  
</html>