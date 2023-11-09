<?php
/*************************************************
 Copyright : (C) 2021 - Cloverfield
 Mail: chilm@planet.nl
 Change date : 06 - 10 - 2021
**************************************************/
	session_start();
  include 'includes/globals.php';

	if((empty($_POST['username'])) || (empty($_POST['password']))) {
		$_SESSION['member'] = FALSE;
		echo '<script language="JavaScript">location.href="index.php";</script>';
	}

	$query = mysqli_query($conn, "SELECT * FROM clo_customers
              WHERE username = '".mysqli_real_escape_string($conn, $_POST["username"])."'
                AND password = '".md5($_POST["password"])."'
                AND registered = '1'
                ") or die(mysqli_error());

	$row = mysqli_fetch_array($query);

	if ($row['username'] == $_POST['username'] AND $row['password'] == md5($_POST['password'])) {

		$_SESSION['member']          = TRUE;
		$_SESSION['email']           = $row['email'];
		$_SESSION['name']            = $row['saluation'].' '.$row['firstname'].' '.$row['surname'];
		$_SESSION['invoice_country'] = $row['invoice_country'];
    $_SESSION['companyname']     = $row['companyname'];

		echo '<script language="JavaScript">location.href="index.php";</script>';
		} else {
				$_SESSION['member'] = FALSE;
				echo '<script language="JavaScript">location.href="page-login.php";</script>';
	}
?>