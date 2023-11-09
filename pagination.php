<?php
/************************************************
 Copyright : (C) 2021 - Cloverfield
 Mail: chilm@planet.nl
 Change date : 06 - 10 - 2021
 ************************************************/

  // Ripped from: https://www.studentstutorial.com/php/php-pagination.php

	header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
	header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
	header("Cache-Control: post-check=0, pre-check=0",false);
	session_cache_limiter("must-revalidate");

	session_start();
	include 'includes/globals.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Pagings Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>-->
</head>
<body>
<br>
<table class="table table-bordered table-striped" style="width: 950px; margin: 0 auto;">
<thead>
<tr>
<th>userid</th>
<th>First name</th>
<th>Last name</th>
 <th>City name</th>
<th>email</th>
</tr>
<thead>
<tbody>

<?php
  isset($_REQUEST["page"]) ? $page  = $_REQUEST["page"] : $page = 1;

  $limit      = $config['pager_limit'];
  $start_from = ($page-1) * $limit;

  $pager = mysqli_query($conn, "SELECT *
                                 FROM clo_customers
                                 ORDER BY idx
                                 ASC LIMIT $start_from, $limit
                                 ");

  while ($row = mysqli_fetch_array($pager))
  {
?>
<tr>
  <td><?php echo $row["email"]; ?></td>
  <td><?php echo $row["firstname"]; ?></td>
  <td><?php echo $row["surname"]; ?></td>
  <td><?php echo $row["invoice_city"]; ?></td>
  <td><?php echo $row["phone"]; ?></td>
</tr>
<?php } ?>
</tbody>
</table>

<?php
  $result_db     = mysqli_query($conn,"SELECT COUNT(idx) FROM clo_products");
  $row_db        = mysqli_fetch_row($result_db);
  $total_records = $row_db[0];
  $total_pages   = ceil($total_records / $limit);
  $pagelink      = "<ul class='pagination'>";

  for ($i = 1; $i <= $total_pages; $i++)
  {
    $pagelink .= "<li class='page-item'><a class='page-link' href='pagination.php?page=".$i."'>".$i."</a></li>";
  }

  echo $pagelink."</ul>";
?>

</body>
</html>
