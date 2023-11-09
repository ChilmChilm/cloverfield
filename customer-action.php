<?php
/*************************************************
 Copyright : (C) 2021 - Cloverfield
 Mail: chilm@planet.nl
 Change date : 06 - 10 - 2021
**************************************************/
  session_start();

  include 'includes/globals.php';

  // Hebben we een GET of een POST:
	isset($_REQUEST['action']) ? $action = $_REQUEST['action'] : $action = '';
	!empty($_REQUEST['newsletter']) ? $newsletter = 1 : $newsletter = 0;
	isset($_REQUEST['session_id']) ? $session_id = mysqli_real_escape_string($conn, $_REQUEST['session_id']) : $session_id = '';

  // Is er een btw nummer aanwezig of verplicht.
  !empty($_REQUEST['vat']) ? $vat = mysqli_real_escape_string($conn, $_REQUEST['vat']) : $vat = '';

/* ========================================================== LINE ============================================================ */

  switch ($action) {

    case 'edit':
  
      // B to B dan b.t.w. nummer invullen bij registratie
      if($super['allow_consumer'] == 0)
      {
        if (empty($_POST['vat']))
        {
          echo '<script language="javascript">
                  <!-- begin
                  alert("Vul a.u.b. uw B.t.w. nummer in!")
                  // end -->
                </script>
                
                <script language="JavaScript">location.href="javascript:history.go(-1)"</script>';
                exit;
        } 
      }      

      mysqli_query ($conn, "UPDATE clo_customers SET
                              firstname         = '".mysqli_real_escape_string ($conn, ucfirst($_POST['firstname']))."',
                              saluation         = '".mysqli_real_escape_string ($conn, $_POST['saluation'])."',
                              surname           = '".mysqli_real_escape_string ($conn, ucfirst($_POST['surname']))."',
                              companyname       = '".mysqli_real_escape_string ($conn, ucfirst ($_POST['companyname']))."',
                              invoice_street    = '".mysqli_real_escape_string ($conn, ucfirst($_POST['invoice_street']))."',
                              invoice_street_nr = '".mysqli_real_escape_string ($conn, ucfirst($_POST['invoice_street_nr']))."',
                              invoice_zip       = '".mysqli_real_escape_string ($conn, $_POST['invoice_zip'])."',
                              invoice_city      = '".mysqli_real_escape_string ($conn, $_POST['invoice_city'])."',
                              invoice_country   = '".mysqli_real_escape_string ($conn, $_POST['invoice_country'])."',
                              deliver_street    = '".mysqli_real_escape_string ($conn, ucfirst($_POST['deliver_street']))."',
                              deliver_street_nr = '".mysqli_real_escape_string ($conn, ucfirst($_POST['deliver_street_nr']))."',
                              deliver_zip       = '".mysqli_real_escape_string ($conn, $_POST['deliver_zip'])."',
                              deliver_city      = '".mysqli_real_escape_string ($conn, $_POST['deliver_city'])."',
                              deliver_country   = '".mysqli_real_escape_string ($conn, $_POST['deliver_country'])."',
                              website           = '".mysqli_real_escape_string ($conn, $_POST['website'])."',
                              bank_name         = '".mysqli_real_escape_string ($conn, ucfirst($_POST['bank_name']))."',
                              bank_nr           = '".mysqli_real_escape_string ($conn, $_POST['bank_nr'])."',
                              tax_nr            = '".$vat."',
                              commerce_nr       = '".mysqli_real_escape_string ($conn, $_POST['commerce_nr'])."',
                              phone             = '".mysqli_real_escape_string ($conn, $_POST['phone'])."',
                              newsletter        = '".$newsletter."'
                            WHERE email = '".$_SESSION['email']."'
                            ");

      if(!empty($_POST['password_new']))
      {
        mysqli_query ($conn, "UPDATE clo_customers 
                              SET `password` = '".md5($_POST['password_new'])."' 
                              WHERE username = '".$_SESSION['email']."'
                              ");
      }

		  echo '<script language="JavaScript">location.href="customer-resume.php"</script>';

	  break;

/*==========================================================================================================================*/

  case 'reset_password':

    // Wrong counting.
    if(empty($_POST['verify']) || $_POST['verify'] != $_SESSION['answer'])
    {
      echo '<script language="javascript">alert("'.$LANG['THE_ANSWER_ERROR'].'")</script>
            <script>window.history.back()</script>';
      exit;
    }

    if ($_SESSION['answer'])
    {
      $activation_code = md5($_POST['new_password'].$_POST['email']);

      mysqli_query ($conn, "INSERT IGNORE INTO clo_customers_reset SET
                              email             = '".mysqli_real_escape_string ($conn, $_POST['email'])."',
                              new_password      = '".md5($_POST['new_password'])."',
                              activation_code   = '".$activation_code."',
                              ip_address        = '".mysqli_real_escape_string($conn, $_POST['ip_address'])."',
                              created           = CURDATE()
                              ");

      $email_owner   = $config['site_email_sales'];
      $email_sender  = mysqli_real_escape_string($conn, $_POST['email']);
      $subject       = 'Wachtwoord resetten: '.$config['shop_name'];
      $xmailer       = $config['shop_name'];
      $aanhef        = 'Uw nieuwe wachtwoord.';
      $footer        = $config['shop_name'].' | '.$config['shop_address'].' | '.$config['shop_zip'].' '.$config['shop_city'].' | T: '.$config['shop_phone'].' | E: '.$email_owner."";

      $mailbody = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
      <meta http-equiv="content-type" content="text/html;charset=utf-8" />

      <html lang="en-NL">

        <head>

          <title>'.$onderwerp.'</title>

         <style>

          body {
            margin-left: 20px;
            margin-top: 20px;
            margin-bottom: 20px;
            }

          td {
            color: #333333;
            font-family: Tahoma, Verdana, Arial;
            font-size: 12px;
            }

          hr {
            color: #999999;
            height: 1px;
            width: 100%;
            }

          b {
            color: #555555;
            font-weight: bold;
            font-family: Tahoma, Verdana, Arial;
            }

          h2 {
            color: #555555;
            font-size: 19px;
            font-family: Trebuchet MS, Tahoma, Verdana, Arial;
            }

          .tbl_breed {
            width: 600px;
            }

          .klein {
            font-size: 10px;
            }

          </style>

        </head>

          <body>

          <table class="tbl_breed" border="0" cellspacing="0" cellpadding="5">
            <tr>
              <td><img src="'.$config["path_url"].'/layout/logo.png" width="300" height="68" border="0"></td>
            </tr>
          </table>

          <table class="tbl_breed" cellpadding="5" cellspacing="0" border="0">
            <tr>
              <td>
                <br>
                <b>'.$aanhef.'</b><br>
                <br>
                <br>
                Om deze te activeren klik:&nbsp;&nbsp;&nbsp;<a href="'.$config["path_url"].'/customer-activate.php?email='.$email_sender.'&code='.$activation_code.'">HIER &raquo;</a><br>
                <br>
              </td>
            </tr>
            <tr>
              <td>
                <hr>
                <div align="center">
                  '.$footer.'
                </div>
                <hr>
              </td>
            </tr>
          </table>

        </body>

      </html>
      ';

      $headers  = "From: $email_owner\n";
      $headers .= "Return-Path: $email_owner\n";
      $headers .= "X-Mailer: $xmailer\n";
      $headers .= "MIME-Version: 1.0\n";
      $headers .= "Content-type: text/html; charset=utf-8\n";

      mail($email_sender, $subject, $mailbody, $headers);

      echo '<script language="JavaScript">location.href="index.php"</script>';
    }

  break;

/*==========================================================================================================================*/

	case 'register':

    // Wrong counting.
    if(empty($_POST['verify']) || $_POST['verify'] != $_SESSION['answer'])
    {
      echo '<script language="javascript">alert("'.$LANG['THE_ANSWER_ERROR'].'")</script>
            <script>window.history.back()</script>';
      exit;
    }

    if ($_SESSION['answer'])
    {
      // B to B dan b.t.w. nummer invullen bij registratie
      if($super['allow_consumer'] == 0) 
      {
        if (empty($_POST['vat'])) 
        {
          echo '<script language="javascript">
                  <!-- begin
                  alert("Vul a.u.b. uw B.t.w. nummer in!")
                  // end -->
                </script>
                
                <script language="JavaScript">location.href="javascript:history.go(-1)"</script>';
          exit;
        } 
      }
      
    // Staat B to B aan?
		if ($super['allow_consumer'] == 1) 
    {
			$registered = 1;
			$active     = 1;
			$see_prices = 1;
		} 
    else
    {
      $registered = 0; 
      $active     = 0;
      $see_prices = 0;
		}      
      mysqli_query ($conn, "INSERT IGNORE INTO clo_customers SET
                              email             = '".strtolower(mysqli_real_escape_string($conn, $_POST['email']))."',
                              username          = '".strtolower(mysqli_real_escape_string($conn, $_POST['email']))."',
                              `password`        = '".md5($_POST['password'])."',
                              registered        = '".$registered."',
                              saluation         = '".mysqli_real_escape_string($conn, $_POST['saluation'])."',
                              firstname         = '".ucfirst(mysqli_real_escape_string($conn, $_POST['firstname']))."',
                              surname           = '".ucfirst(mysqli_real_escape_string($conn, $_POST['surname']))."',
                              companyname       = '".mysqli_real_escape_string($conn, ucfirst ($_POST['companyname']))."',
                              invoice_street    = '".ucfirst(mysqli_real_escape_string($conn, $_POST['invoice_street']))."',
                              invoice_street_nr = '".mysqli_real_escape_string($conn, $_POST['invoice_street_nr'])."',
                              invoice_zip       = '".mysqli_real_escape_string($conn, $_POST['invoice_zip'])."',
                              invoice_city      = '".ucfirst(mysqli_real_escape_string($conn, $_POST['invoice_city']))."',
                              invoice_country   = '".mysqli_real_escape_string($conn, $_POST['invoice_country'])."',
                              phone             = '".mysqli_real_escape_string($conn, $_POST['phone'])."',
                              active            = '".$active."', 
                              see_prices        = '".$see_prices."',
                              tax_nr            = '".$vat."',
                              remarks           = '".mysqli_real_escape_string($conn, $_POST['order_remarks'])."',
                              created           = CURDATE()
                              ");

      $tijd_1       = date("d-m-Y ");
      $tijd_2       = date("H:i:s");
      $email_owner  = $config['site_email_sales'];
      $email_sender = strtolower($_POST['email']);
      $subject      = 'Nieuwe Registratie '.$config['shop_name'];
      $xmailer      = $config['shop_name'];
      $aanhef       = 'Bedankt voor uw registratie.';
      $footer       = $config['shop_name'].' | '.$config['shop_address'].' | '.$config['shop_zip'].' '.$config['shop_city'].' | T: '.$config['shop_phone'].' | E: '.$email_owner.'';
      $bedankt      = 'forms/thanks-global.php';
      $parent       = 'customer-register.php';

/* ======================================================== LINE ======================================================== */

              $mailbody = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
              <meta http-equiv="content-type" content="text/html;charset=utf-8" />
  
              <html lang="en-NL">
  
                <head>
  
                  <title>'.$subject.'</title>
  
                 <style>
  
                    body {
                      margin-left: 20px;
                      margin-top: 20px;
                      margin-bottom: 20px;
                      }
  
                    td {
                      color: #333333;
                      font-family: Tahoma, Verdana, Arial;
                      font-size : 12px;
                      }
  
                    hr {
                      color: #999999;
                      height: 1px;
                      width: 100%;
                      }
  
                    b {
                      color: #555555;
                      font-weight: bold;
                      font-family: Tahoma, Verdana, Arial;
                      }
  
                    h2 {
                      color: #555555;
                      font-size : 19px;
                      font-family: Trebuchet MS, Tahoma, Verdana, Arial;
                      }
  
                    .tbl_breed {
                      width: 600px;
                      }
  
                    .klein {
                      font-size: 10px;
                      }
  
                  </style>
  
                </head>
  
                  <body>
  
                  <table class="tbl_breed" border="0" cellspacing="0" cellpadding="5">
                    <tr>
                      <td><img src="'.$config["path_url"].'/layout/logo.png" width="300" height="68" border="0"></td>
                    </tr>
                  </table>
  
                  <table class="tbl_breed" border="0" cellspacing="0" cellpadding="5">
                    <tr>
                      <td colspan="3">
                        <br>
                        '.$aanhef.'<br>
                        <br>
                      </td>
                    </tr>
                  </table>
  
                  <table class="tbl_breed" border="0" cellspacing="0" cellpadding="5">
                    <tr>
                      <td><b>Verstuurd:</b></td>
                      <td width="10">&nbsp;</td>
                      <td><b>Op:</b> '.$tijd_1.' <b>Om:</b> '.$tijd_2.'</td>
                    </tr>
                    <tr>
                      <td><b>Bedrijf:</b></td>
                      <td></td>
                      <td>'.$_POST['companyname'].'</td>
                    </tr>
                    <tr>
                      <td><b>Naam:</b></td>
                      <td></td>
                      <td>'.$_POST['saluation'].' '.$_POST['firstname'].' '.$_POST['surname'].'</td>
                    </tr>
                    <tr>
                      <td><b>Adres:</b></td>
                      <td></td>
                      <td>'.$_POST['invoice_street'].' '.$_POST['invoice_street_nr'].'</td>
                    </tr>
                    <tr>
                      <td><b>Postcode:</b></td>
                      <td></td>
                      <td>'.$_POST['invoice_zip'].'</td>
                    </tr>
                    <tr>
                      <td><b>Plaats:</b></td>
                      <td></td>
                      <td>'.$_POST['invoice_city'].'</td>
                    </tr>
                    <tr>
                      <td><b>Land:</b></td>
                      <td></td>
                      <td>'.$_POST['invoice_country'].'</td>
                    </tr>          
                    <tr>
                      <td><b>Telefoon:</b></td>
                      <td></td>
                      <td>'.$_POST['phone'].'</td>
                    </tr>
                    ';

      if($super['allow_consumer'] == 0)
      {
        $mailbody .= '<tr>
                        <td><b>B.t.w. nummer:</b></td>
                        <td></td>
                        <td>'.$vat.'</td>
                      </tr>';
      }

      $mailbody .= '<tr>
                      <td><b>E-mail:</b></td>
                      <td></td>
                      <td>'.$email_sender.'</td>
                    </tr>
                    <tr>
                      <td><b>Username:</b></td>
                      <td></td>
                      <td>'.$email_sender.'</td>
                    </tr>
                    <tr>
                      <td><b>Password:</b></td>
                      <td></td>
                      <td>'.$_POST['password'].'</td>
                    </tr>
                    <tr>
                      <td colspan="3"><hr></td>
                    </tr>
                  </table>
  
                  <table class="tbl_breed" border="0" cellspacing="0" cellpadding="5">
                    <tr>
                      <td class="klein">
                        <div align="center">
                          '.$footer.'
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <hr>
                      </td>
                    </tr>
                  </table>
  
                </body>
  
              </html>
          ';

      $headers  = "From: $email_owner\n";
      $headers .= "Return-Path: $email_owner\n";
      $headers .= "X-Mailer: $xmailer\n";
      $headers .= "MIME-Version: 1.0\n";
      $headers .= "Content-type: text/html; charset=utf-8\n";

      mail($email_sender, $subject, $mailbody, $headers);
      mail($email_owner, $subject, $mailbody, $headers);

      echo '<script language="JavaScript">location.href="'.$bedankt.'";</script>';
      }
      else
      {
        echo '<script language="JavaScript">parent.location.href="'.$parent.'";</script>';
      }

    break;
  }