<!DOCTYPE html>
<html lang="en-NL">
<title>Demo W3.CSS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="layout/ontwikkel.css">
<link rel="stylesheet" href="layout/theme-ontwikkel.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">
<body>

<!-- Side Navigation -->
<nav class="sidenav white card-2 animate-left" style="display:none">
  <a href="javascript:void(0)" onclick="w3_close()" class="closenav xxxlarge text-theme">Close &times;</a>
  <a href="javascript:void(0)">Link 1</a>    
  <a href="javascript:void(0)">Link 2</a>    
  <a href="javascript:void(0)">Link 3</a>    
  <a href="javascript:void(0)">Link 4</a>    
  <a href="javascript:void(0)">Link 5</a>    
</nav>

<!-- Header -->
<header class="container theme padding" id="myHeader">
  <i onclick="w3_open()" class="fa fa-bars xlarge opennav"></i> 
  <div class="center">
  <h5>BEAUTIFUL RESPONSIVE WEB SITES</h5>
  <h1 class="animate-bottom">BUILT WITH W3.CSS</h1>
  <h5>INSPIRED BY GOOGLE MATERIAL DESIGN<br><br></h5>
    <div class="padding-32">
      <a href="#id01" class="btn xxlarge theme-dark">LEARN W3.CSS</a>
    </div>
  </div>
</header>

<!-- Modal -->
<div id="id01" class="modal">
  <div class="modal-dialog">
    <div class="modal-content card-8 animate-top">
      <header class="container theme"> 
        <a href="#" class="closebtn">&times;</a>
        <h4>Oh snap! We just showed you a modal..</h4>
        <h5>Because we can <i class="fa fa-smile-o"></i></h5>
      </header>
      <div class="container white">
        <p>Cool huh? Ok, enough teasing around..</p>
        <p>Go to our <a class="btn" href="/w3css/default.asp">W3.CSS Tutorial</a> to learn more!</p>
      </div>
      <footer class="container light-grey">
        <p>Modal footer</p>
      </footer>
    </div>
  </div>
</div>

<div class="row-padding center margin-top">

  <div class="third">
    <div class="card-2 padding-top" style="min-height:460px">
    <h4>Responsive</h4><br>
    <i class="fa fa-desktop margin-bottom text-theme" style="font-size: 120px;"></i>
    <p>Built-in responsiveness</p>
    <p>Mobile first fluid grid</p>
    <p>Fits any screen sizes</p>
    <p>PC Tablet and Mobile</p>
    </div>
  </div>

  <div class="third">
    <div class="card-2 padding-top" style="min-height:460px">
    <h4>Standard CSS</h4><br>
    <i class="fa fa-css3 margin-bottom text-theme" style="font-size:120px"></i>
    <p>Standard CSS only</p>
    <p>Easy to learn</p>
    <p>No need for jQuery</p>
    <p>No JavaScript library</p>
    </div>
  </div>

  <div class="third">
    <div class="card-2 padding-top" style="min-height:460px">
    <h4>Material Design</h4><br>
    <i class="fa fa-diamond margin-bottom text-theme" style="font-size:120px"></i>
    <p>Paper like design</p>
    <p>Bold colors and shadows</p>
    <p>Equal across platforms</p>
    <p>Equal across devices</p>
    </div>
  </div>
  
</div>

<div class="container">
<hr>
<div class="center">
  <h2>Color Classes</h2>
</div>

<div class="row">
  <div class="col container m2 red"><p>Red</p></div>
  <div class="col container m2 blue"><p>Blue</p></div>
  <div class="col container m2 blue-grey"><p>Blue Grey</p></div>
  <div class="col container m2 teal"><p>Teal</p></div>
  <div class="col container m2 yellow"><p>Yellow</p></div>
  <div class="col container m2 orange"><p>Orange</p></div>
</div>

<hr>
<div class="center">
  <h2>Built-In Responsiveness</h2>
  <p class="large">Resize the page to see the effect!</p>
</div>
<br>

<div class="row border">
  <div class="half container blue border">
    <h5>half</h5>  
    <p>The half class uses half (50%) of the screen window.</p>
    <p>On small screens (max 600 pixels) it automatically resizes to full screen width.</p>
  </div>
  <div class="half container">
    <h5>half</h5>  
  </div>
</div>
<br>

<div class="row border">
  <div class="third container green">
    <h5>third</h5>  
    <p>The third class uses one third (33.33%) of the screen widow.</p>
    <p>On small screens (max 600 pixels) it automatically resizes to full screen width.</p>
  </div>
  <div class="third container">
    <h5>third</h5>  
  </div>
  <div class="third container">
    <h5>third</h5>  
  </div>
</div>
<br>

<div class="row border">
  <div class="quarter container red">
    <h5>quarter</h5>  
    <p>The quarter class uses one quarter (25%) of the screen window.</p>
    <p>On small screens (max 600 pixels) it automatically resizes to full screen width.</p>
  </div>
  <div class="quarter container">
    <h5>quarter</h5>  
  </div>
  <div class="quarter container">
    <h5>quarter</h5>  
  </div>
  <div class="quarter container">
    <h5>quarter</h5>  
  </div>
</div> 
     
<div class="center">
  <h2>Containers</h2>  
  <p>Use containers to create headers, sections and footers.</p>
</div>   

<header class="container blue-grey">
  <h2>Header</h2>
</header>

<div class="container white">
  <span onclick="this.parentElement.style.display='none'" class="closebtn">&times;</span>
  <h2>London</h2>
  <p>London is the capital city of England. It is the most populous city in the United Kingdom,
  with a metropolitan area of over 13 million inhabitants.</p>
  <p>Standing on the River Thames, London has been a major settlement for two millennia,
  its history going back to its founding by the Romans, who named it Londinium.</p>
  <p>By the way, you can add a close icon to all containers if you want the ability to hide them. Look to your right!</p>
</div>

<footer class="container blue-grey">
  <h5>Footer</h5>
  <p class="text-white-opacity">Footer information goes here</p>
</footer>

<hr>
<div class="center">
  <h2>Color Themes</h2>  
  <p>The color themes have been designed to work harmoniously with each other.</p>
</div>
</div>

<div class="row-padding">

<div class="half">
<div class="card white">
  <div class="container indigo">
    <h3>&#9776; Theme Indigo</h3>
  </div>
  <div class="container">
  <h3 class="text-indigo">Movies 2014</h3>
  </div>
  <ul class="ul border-top">
    <li>
      <h3>Frozen</h3>
      <p>The social media response to the animations was ridiculous</p>
    </li>
    <li>
      <h3>The Fault in Our Stars</h3>
      <p>Touching, gripping and genuinely well made</p>
    </li>
    <li>
      <h3>The Avengers</h3>
      <p>The Avengers is a hugely bankable franchise for Marvel and Disney</p>
    </li>
  </ul>
  <div class="container indigo xlarge">
  &laquo;<span class="right">&raquo;</span>
  </div>
</div>
</div>

<div class="half">
<div class="card white">
  <div class="container theme">
    <h3>&#9776; Theme</h3>
  </div>
  <div class="container">
  <h3 class="text-theme">Movies 2014</h3>
  </div>
  <ul class="ul border-top">
    <li>
      <h3>Frozen</h3>
      <p>The social media response to the animations was ridiculous</p>
    </li>
    <li>
      <h3>The Fault in Our Stars</h3>
      <p>Touching, gripping and genuinely well made</p>
    </li>
    <li>
      <h3>The Avengers</h3>
      <p>The Avengers is a hugely bankable franchise for Marvel and Disney</p>
    </li>
  </ul>
  <div class="container indigo xlarge">
  &laquo;<span class="right">&raquo;</span>
  </div>
</div>
</div>
</div>

<div class="container center">
  <hr>
  <h3>Paper-like Cards with Shadows</h3>  
</div>

<div class="row-padding"> 

<div class="third">
<div class="card-2">
  <img src="uploads/img_car.png" alt="Car" style="width:100%">
  <div class="container">
  <p>card-2</p>
  </div>
</div>
</div>

<div class="third">
<div class="card-4">
  <img src="uploads/img_car.png" alt="Car" style="width:100%">
  <div class="container">
  <p>card-4</p>
  </div>
</div>
</div>

<div class="third">
<div class="card-8">
  <img src="uploads/img_car.png" alt="Car" style="width:100%">
  <div class="container">
  <p>card-8</p>
  </div>
</div>
</div>
</div>

<div class="container">
  <hr>
  <div class="center">
    <h2>Tables</h2>  
    <p class="large">Don't worry. W3.CSS takes care of your tables.</p>
  </div>
<div class="responsive card-4">
<table class="table striped bordered">
<thead>
<tr class="theme">
  <th>First Name</th>
  <th>Last Name</th>
  <th>Points</th>
</tr>
</thead>
<tbody>
<tr>
  <td>Jill</td>
  <td>Smith</td>
  <td>50</td>
</tr>
<tr class="white">
  <td>Eve</td>
  <td>Jackson</td>
  <td>94</td>
</tr>
<tr>
  <td>Adam</td>
  <td>Johnson</td>
  <td>67</td>
</tr>
</tbody>
</table>
</div>

<hr>
<h2 class="center">Forms and Lists</h2>  
</div>

<div class="row-padding">

<div class="half">
<form class="container card-4">
  <h2>Input</h2>
  <br>  
  <div class="group">      
    <input class="input" type="text" style="width:95%" required>
    <label class="label">Name</label>
  </div>
  <div class="group">      
    <input class="input" type="text" style="width:95%" required>
    <label class="label">Email</label>
  </div>
  <div class="group">      
    <textarea class="input" style="width:95%" required></textarea>
    <label class="label">Subject</label>
  </div>

  <div class="row">
  <div class="half">
    <label class="checkbox">
      <input type="checkbox" checked="checked">
      <div class="checkmark"></div> Milk
    </label><br>
    <label class="checkbox">
      <input type="checkbox">
      <div class="checkmark"></div> Sugar
    </label><br>
    <label class="checkbox">
      <input type="checkbox" disabled>
      <div class="checkmark"></div> Lemon (Disabled)
    </label><br><br>
  </div>

  <div class="half">
    <label class="checkbox">
      <input type="radio" name="gender" value="male" checked>
      <div class="checkmark"></div> Male
    </label><br>
    <label class="checkbox">
      <input type="radio" name="gender" value="female">
      <div class="checkmark"></div> Female
    </label><br>
    <label class="checkbox">
      <input type="radio" name="gender" value="female" disabled>
      <div class="checkmark"></div> Don't know
    </label>
  </div>
  </div>
</form>
</div>
<div class="half">
<div class="card-4 container">
<h2>Lists</h2>  
<ul class="ul">
  <li>Jill</li>
  <li>Eve</li>
  <li>Adam</li>
</ul>
<br>
</div>
</div>
</div>

<div class="container">
<hr>
<h2 class="center">Navigation</h2>  

<div class="topnav large theme">
  <a href="javascript:void(0)"><i class="fa fa-home xlarge"></i></a>
  <a href="javascript:void(0)">Link 1</a>
  <a href="javascript:void(0)">Link 2</a>
  <a href="javascript:void(0)">Link 3</a>
  <a href="javascript:void(0)">Link 4</a>
</div>

<hr>
<h2 class="center">Buttons</h2>  
<div class="center">
  <br>
  <a class="btn">Button</a>
  <a class="btn theme">Button</a>
  <a class="btn disabled">Button</a>
  <br><br>
  <a class="btn-floating teal"><i class="fa fa-plus"></i></a>
  <a class="btn-floating disabled"><i class="fa fa-plus"></i></a>  
  <a class="btn-floating disabled"><i class="fa fa-plus"></i></a>
  <br><br>
  <a class="btn-floating-large teal"><i class="fa fa-plus"></i></a>
  <a class="btn-floating-large disabled"><i class="fa fa-plus"></i></a>  
  <a class="btn-floating-large disabled"><i class="fa fa-plus"></i></a>
</div>
</div>

<br>

<!-- Footer -->
<footer class="container theme-dark">
  <h3>Footer</h3>
  <p>Remember to check out our&nbsp;&nbsp;<a href="https://www.w3schools.com/w3css/demo_red.htm" class="btn red">W3.CSS Reference</a>
  <div style="position:relative;bottom:55px;" class="tooltip right">
    <span class="text theme-dark">Go To Top</span>&nbsp;   
    <a class="text-white" href="#myHeader"><span class="xlarge">
    <i class="fa fa-chevron-circle-up"></i></span></a>
  </div>

  </p>
</footer>

<!-- Script for Side Navigation -->
<script>
function w3_open() {
    document.getElementsByClassName("sidenav")[0].style.width = "100%";
    document.getElementsByClassName("sidenav")[0].style.textAlign = "center";
    document.getElementsByClassName("sidenav")[0].style.fontSize = "50px";
    document.getElementsByClassName("sidenav")[0].style.paddingTop = "10%";
    document.getElementsByClassName("sidenav")[0].style.display = "block";
    document.getElementsByClassName("sidenav")[0].style.opacity = "0.9";
}
function w3_close() {
    document.getElementsByClassName("sidenav")[0].style.display = "none";
}
</script>

<script src="includes/js/w3codecolors.js"></script> 
</body>
</html>