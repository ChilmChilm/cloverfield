<?php
/*************************************************
 Copyright : (C) 2021 - Cloverfield
 Mail: chilm@planet.nl
 Change date : 06 - 10 - 2021
**************************************************/
  session_start();

	include 'includes/globals.php';
	
	$the_date = date ("Y-m-d");

  // Alle artikelen van de shop ophalen.
	$query = mysqli_query($conn, "SELECT idx, product_number, product_title_nl 
                                FROM clo_products 
                                WHERE active = 1 
                                ORDER BY product_number
                                ");

  $map = "sitemap.xml";
  $fh  = fopen($map, 'w') or die("Kan het bestand sitemap.xml niet openen!");

  $txt  = '<?xml version="1.0" encoding="UTF-8"?>
          <urlset xmlns="https://www.sitemaps.org/schemas/sitemap/0.9"
          xmlns:xsi="https://www.w3.org/2001/XMLSchema-instance"
          xsi:schemaLocation="https://www.sitemaps.org/schemas/sitemap/0.9
          https://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">'." \n";
						
	$txt .= '<url> 
             <loc>'.$config['path_url'].'/index.php</loc>
             <lastmod>'.$the_date.'</lastmod> 
             <changefreq>monthly</changefreq>
             <priority>0.5</priority> 
          </url>
          <url> 
             <loc>'.$config['path_url'].'/contact.php</loc>
             <lastmod>'.$the_date.'</lastmod> 
             <changefreq>monthly</changefreq>
             <priority>0.5</priority> 
          </url>'." \n";
	
	while($row = mysqli_fetch_array($query))
  {
	  // Welke willen wij weg hebben in de url.
	  $not         = ['&','%','\'','"',' ','?',',','\\','@','?','�','/','*','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','.','+'];
	  $not_replace = ['-','','','','-','','.','-','','-','','','','a','a','a','a','a','e','e','e','e','i','i','i','i','o','o','o','o','o','u','u','u','u','c','A','A','A','A','A','E','E','E','E','I','I','I','I','O','O','O','O','O','U','U','U','U','C','-',''];
	
	  $txt .= '<url>
               <loc>'.$config['path_url'].'/'.str_replace($not,$not_replace,$row['product_title_nl']).'-ID-'.$row['idx'].'</loc>
               <lastmod>'.$the_date.'</lastmod>
               <changefreq>weekly</changefreq> 
               <priority>0.8</priority>
            </url>'." \n";
	}

  $txt .= '</urlset>';

	fwrite($fh, $txt);
	fclose($fh);

	echo "<script language=\"JavaScript\">location.href=\"manage/sitemap_ready.php\"</script>";