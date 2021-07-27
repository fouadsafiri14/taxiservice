<?php
$bol=0;
if(isset($_POST['valid']))
{
  if(isset($_POST['valid']))
   {
  extract($_POST);
  require('config/PDOAccess.php');
  $query = $PDO->prepare("INSERT INTO message(name,telnumber,email,text) VALUES(:name,:tel_number,:Email,:text)");
  $tabExec =[':name'=>$name,':tel_number'=>$tel_number,':Email'=>$Email,':text'=>$text];
  $query->execute($tabExec);
  $bol=1;
   }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<!-- basic -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- mobile metas -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="viewport" content="initial-scale=1, maximum-scale=1">
<!-- site metas -->
<link rel="shortcut icon" type="image/x-icon" href="images/logo.png" />
<title>TAXI SERVICE - contact </title>
<meta name="keywords" content="">
<meta name="description" content="">
<meta name="author" content=""> 
<!-- bootstrap css -->
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<!-- style css -->
<link rel="stylesheet" type="text/css" href="css/style.css">
<!-- Responsive-->
<link rel="stylesheet" href="css/responsive.css">
<!-- fevicon -->
<link rel="icon" href="images/fevicon.png" type="image/gif" />
<!-- Scrollbar Custom CSS -->
<link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
<!-- Tweaks for older IEs-->
<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
<!-- owl stylesheets --> 
<link rel="stylesheet" href="css/owl.carousel.min.css">
<link rel="stylesheet" href="css/owl.theme.default.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">

</head>
<body>
  <!--header section start -->
  <div class="header_section">
    <div class="container-fluid">
      <div class="row">
          <div class="col-sm-12 col-lg-3">
            <div class="logo"><img src="images/logo.png"></div>
          </div>
          <div class="col-sm-4 col-lg-5">
            <div class="menu-area">
                    <nav class="navbar navbar-expand-lg ">
                        <!-- <a class="navbar-brand" href="#">Menu</a> -->
                        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa fa-bars"></i>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav mr-auto">
                               <li class="nav-item active">
                                <a class="nav-link active" href="index.html">Accueil<span class="sr-only">(current)</span></a> </li>
                               <li class="nav-item">
                                <a class="nav-link" href="about.html">A propos</a></li>
                               <li class="nav-item" href="#">
                                <a class="nav-link" href="contact.php">Contactez nous</a></li>
                            </ul>
                        </div>
                    </nav>
                </div>
          </div>
          <div class="col-sm-8 col-lg-4">
            <div class="togle_3">
                  <div class="left_main">
                     <div class="menu_main">
                      <a href="connexion.php"><i class="fa fa-fw fa-user"></i> Se connecter /</a>
						<a href="inscription.php"> S'inscrire</a>
                     </div>
                  </div>
                 
               </div>
          </div>

    </div>
    </div>
  </div>
  <!-- header section end  -->
  <!-- contact section start -->  
    <div class="layout_padding contact_section">
      <div class="container">
        <div class="contact_section_inner">
          <form method="POST" >    
          <div class="contact_main">
            <h1 class="contact_text">Contactez nous</h1>
            <div class="input_main">
              <div class="row">
                <div class="col-sm-6 col-lg-3">
                  <div class="form-group">
                                   <input type="text" class="email-bt" placeholder="Name" name="name">
                                </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                  <div class="form-group">
                                   <input type="text" class="email-bt" placeholder="Phone Number" name="tel_number">
                                </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                  <div class="form-group">
                                   <input type="text" class="email-bt" placeholder="Email" name="Email" required>
                                </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                  <div class="social_icon">
                    <ul>
                      <li><img src="images/fb-icon.png"></li>
                      <li><img src="images/twitter-icon.png"></li>
                      <li><img src="images/in-icon.png"></li>
                      <li><img src="images/instagram-icon.png"></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="massage_box">
              <div class="row">
                <div class="col-sm-8">
                
                                <div class="form-group">
                                  <textarea class="massage-bt" placeholder="Massage" rows="5" id="comment" name="text" min="10" max="300" required></textarea>
                                </div>
                        
                </div>
                <div class="col-sm-4">
                  <button name="valid" class="send_bt" value="ok">Send</button>
                </div>
              </div>
            </div>
          </div>
          <?php if($bol==1){ echo "<p style='font-size:20px; font-weight:bold; color:black'>done</p>";}?>
        </form>
        </div>
      </div>
    </div>

  <!-- contact section end -->
  <!-- footer section start -->
  <div class="footer_section layout_padding">
    <div class="container">
   <div class="row">
        
         
          <div class="col-md-12">
            <div class="useful_main border_right0">
              <h2 class="useful_text">Menus</h2>
              <ul >
                <li><a href="index.html">Accueil</a></li>
                <li><a href="about.html">A propos </a></li>
                <li><a href="contact.php">Contactez nous</a></li>
              </ul>
              
              
              
              
              
            </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 ">
           <h2 class="useful_text">Address</h2>
                     <ul class="location">
                <li><img src="images/map-icon.png">NR 100 oueld lhaj,Errachidia</li>
                
                <li><img src="images/call-icon.png"><a href="company.html">+212 89078493</a></li>
                <li><img src="images/email-icon.png"><a href="furnitures.html">ziad@gmail.com</a></li>
                
              </ul>
                       

          </div>
          
      </div>
    </div>
  </div>
  <!-- footer section end --> 
  <!-- copyright section start -->  
  <div class="copyright">
    <div class="container">
      <p class="copyright_text">Copyright 2019 All Right Reserved By SWT</p>
    </div>
  </div>
  <!-- copyright section end -->  

      <!-- Javascript files-->
      <script src="js/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.bundle.min.js"></script>
      <script src="js/jquery-3.0.0.min.js"></script>
      <script src="js/plugin.js"></script>
      <!-- sidebar -->
      <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
      <script src="js/custom.js"></script>
      <!-- javascript --> 
      <script src="js/owl.carousel.js"></script>
      <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
      <script>
         $(document).ready(function(){
         $(".fancybox").fancybox({
         openEffect: "none",
         closeEffect: "none"
         });
         </script>  

</body>
</html>

