    <meta name="robots"                content="all">
    <meta name="language"              content="nl">
    <meta name="rating"                content="general">
    <meta name="robots"                content="index, follow">
    <meta name="distribution"          content="global">
    <meta name="viewport"              content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">

    <meta property="og:locale"      content="nl_NL">
    <meta property="og:type"        content="website">
    <meta property="og:title"       content="<?php echo $config['site_title']; ?>">
    <meta property="og:description" content="<?php echo $config['site_description']; ?>">
    <meta property="og:url"         content="<?php echo $config['path_url']; ?>">

		<link rel="shortcut icon"    href="favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="touch-icon-iphone.png">
    <link rel="apple-touch-icon" sizes="76x76" href="touch-icon-ipad.png">
    <link rel="apple-touch-icon" sizes="120x120" href="touch-icon-iphone-retina.png">
    <link rel="apple-touch-icon" sizes="152x152" href="touch-icon-ipad-retina.png">
    

    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">
    <link rel="stylesheet"    type="text/css"     href="layout/ontwikkel.css">
    <link rel="stylesheet"    type="text/css"     href="layout/theme-ontwikkel.css">
    <link rel="stylesheet"    type="text/css"     href="layout/purecookie.css">
    <link rel="stylesheet"    type="text/css"     href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.0/css/font-awesome.min.css">
    <link rel="stylesheet"    type="text/css"     href="layout/print.css" media="print" type="text/css" >
    <link rel="stylesheet"    type="text/css"     href="includes/validation/validation.css">
     
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,700,500italic,700italic,900,900italic" rel="stylesheet" type="text/css">     

    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="includes/js/functions.js"></script>
    <script type="text/javascript" src="includes/js/hover_popup.js"></script>
    <script type="text/javascript" src="includes/js/purecookie.js"></script>
    <script type="text/javascript" src="includes/validation/validation.js"></script>
    <script type="text/javascript" src="includes/validation/jquery.validate.min.js"></script>  

		<!-- BEO HOME SLIDER -->
    <script src="includes/flexslider/jquery.flexslider-min.js"></script>
    <link rel="stylesheet" href="includes/flexslider/flexslider.css" type="text/css" media="screen"> 
		<!-- EOF HOME SLIDER -->    

    <script type="text/javascript">
      $(document).ready(function(){
        
        $('#menu_left a').each(function(index) {
         if(this.href.trim() == window.location)
         $(this).addClass("selected");
        });
        
	      $('.flexslider').flexslider({
						easing:        "swing",  
						animation:     "fade",
						slideshowSpeed: 5000,
						animationSpeed: 600,
						startAt:        0, 
						initDelay:      0,
						controlNav:     true,              
						directionNav:   false,
						pausePlay:      false,
						pauseText:     'Pause',            
						playText:      'Play',
						after:          function(){$(this).flexslider('slideshowSpeed',1000);
	        }
	      });
	              
      });
    </script>
    
    <?php
    	// When empty $page.
      !empty($page) ? $page = $page : $page = '';

    	// Shop gesloten laat pagina zien.      
      if ($super['shop_closed'] == 1 || $config['shop_closed'] == 1 AND $page != 'page-closed.php')
      {
      	echo '<script language="JavaScript">location.href="page-closed.php"</script>';
      }
   ?>


