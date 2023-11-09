<?php
/*************************************************
 Copyright : (C) 2021 - Cloverfield
 Mail: chilm@planet.nl
 Change date : 06 - 10 - 2021
**************************************************/

  session_start();
  $_SESSION = array();
  session_destroy();
  session_write_close();
  setcookie(session_name(),'',0,'/');
  session_regenerate_id(true);
?>

<html lang="en-NL">
<head>
<title>Uitloggen</title>
</head>

<body>
  <script language=javascript>
    window.open('index.php', '_self', '')
  </script>
</body>
</html>