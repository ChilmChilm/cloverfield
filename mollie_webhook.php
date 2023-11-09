<?php
/*************************************************
 Copyright : (C) 2021 - Cloverfield
 Mail: chilm@planet.nl
 Change date : 06 - 10 - 2021
**************************************************/
  
  require_once __DIR__ . '/includes/globals.php';
  
  $email = 'info@email.cloverfield';
  
  $headers  = 'MIME-Version: 1.0' . "\r\n";
  $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
  
  $message  = '<b>$_GET</b><pre>   '.print_r($_GET, true).'   </pre>';
  $message .= '<b>$_POST</b><pre>  '.print_r($_POST, true).'  </pre>';
  $message .= '<b>$_SERVER</b><pre>'.print_r($_SERVER, true).'</pre>';
  
  // An ID needs to be posted from Mollie
  if (isset($_POST['id']) === false)
  {
    mail($email, 'Mollie Webhook - Missing Mollie ID', $message, $headers);

    http_response_code(400);
    exit('Missing Mollie ID');
  }
  
  // Let's check if the ID exists in our database, if not, we exit
  $query  = mysqli_query($conn, "SELECT * FROM clo_orders_c WHERE mollie_order_id = '".mysqli_real_escape_string($conn, $_POST['id'])."' LIMIT 1");
  $amount = mysqli_num_rows($query);
  
  if ($amount !== 1)
  {
    mail($email, 'Mollie Webhook - Order not found', $message, $headers);

    http_response_code(400);
    exit('Specified order not found');
  }
  
  $order  = mysqli_fetch_array($query);
  
  try
  {
    require_once __DIR__ . '/includes/Mollie/API/Autoloader.php';

    $mollie = new Mollie_API_Client();
    $mollie->setApiKey($config['mollie_api_key']);

    $payment = $mollie->payments->get($_POST['id']);

    if ($payment instanceof Mollie_API_Object_Payment === false)
    {
      mail($email, 'Mollie Webhook - Not a valid payment object', $message, $headers);
      http_response_code(400);
      exit('Not a valid payment object');
    }

    if ($payment->id !== $order['mollie_order_id'])
    {
      mail($email, 'Mollie Webhook - Order ID mismatch', $message, $headers);
      http_response_code(400);
      exit('Order ID mismatch');
    }

    // Update order status in the database
    switch ($payment->status)
    {
      case 'pending':
          mysqli_query($conn, 'UPDATE clo_orders_c SET order_paystatus = "Onderweg" WHERE order_idx = "' . $order['order_idx'] . '" LIMIT 1');
      break;

      case 'paid':
          mysqli_query($conn, 'UPDATE clo_orders_c SET order_paystatus = "Betaald" WHERE order_idx = "' . $order['order_idx'] . '" LIMIT 1');

          mail($order['username'], 'Je betaling is ontvangen', 'Je betaling is ontvangen.', $headers);
          mail($email, 'Betaling ontvangen voor ' . $order['order_number'], 'Er is een betaling ontvangen voor order ' . $order['order_number'] . '.', $headers);
      break;

      case 'refunded':
          mysqli_query($conn, 'UPDATE clo_orders_c SET order_paystatus = "Gestorneerd" WHERE order_idx = "' . $order['order_idx'] . '" LIMIT 1');
      break;

      default:
          mysqli_query($conn, 'UPDATE clo_orders_c SET order_paystatus = "Controleer" WHERE order_idx = "' . $order['order_idx'] . '" LIMIT 1');
      break;
    }
  }

  catch(Mollie_API_Exception $e)
  {
    $message .= '<b>Exception message</b> ' . $e->getMessage();
    mail($email, 'Mollie Webhook - Exception encountered', $message, $headers);

    http_response_code(400);
    echo $e->getMessage();
  }