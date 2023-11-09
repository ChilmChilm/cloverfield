<?php
/*************************************************
 Copyright : (C) 2021 - Cloverfield
 Mail: chilm@planet.nl
 Change date : 06 - 10 - 2021
**************************************************/
 
  session_start();
 
  // Beveiliging deel 1 check of ingelogd:
  if ($_SESSION['member'] == TRUE )
  {
    include 'includes/globals.php';

    $query = mysqli_query($conn, "SELECT order_mailbody 
                                  FROM clo_orders_c 
                                  WHERE session_id = '".mysqli_real_escape_string($conn, $_GET['session_id'])."'
                                  ");

    $mailbody = mysqli_fetch_array($query);

    if(empty($mailbody['order_mailbody']))
    {
      echo '<div align="center" class="no_mail">Geen mail beschikbaar!</div>';
    }
    else
    {
      echo $mailbody['order_mailbody'];
    }
  }

  // Beveiliging deel 2 wanneer niet ingelogd:
  else
  {
    echo '<script language=javascript> 
            window.open("index.php", "_parent", "")
          </script>';
  }