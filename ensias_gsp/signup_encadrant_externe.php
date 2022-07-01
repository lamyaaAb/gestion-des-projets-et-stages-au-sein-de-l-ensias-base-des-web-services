<?php 

if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email']) && isset($_POST['mdp']) && isset($_POST['etablissement']) && isset($_POST['filiere']) )
{   
    $nom=$_POST['nom'];
    $prenom =$_POST['prenom'];
    $email =$_POST['email'];
    $mdp = $_POST['mdp'];
    $etablissement=$_POST['etablissement'];
    $filiere=$_POST['filiere'];
    $encadrant = file_get_contents("http://localhost/Projet-PFA/ensias_gsp/php_rest/api/encadrant/create_externe.php?nom=$nom&prenom=$prenom&email=$email&mdp=$mdp&etablissement=$etablissement&filiere=$filiere");
    $response = json_decode($encadrant,true); 
if(isset($response['message1'])) 
    { 
        
      header('location:http://localhost/Projet-PFA/ensias_gsp/test - Copie.php');
        
       
    }
else {
  header('location:http://localhost/Projet-PFA/ensias_gsp/test - Copie - Copie.php');
}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>ENSIAS - GSP</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">


</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container-fluid d-flex justify-content-between align-items-center">

      <h1 class="logo me-auto me-lg-0"><a href="index.html">ENSIAS</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a href="index.html">Home</a></li>
          <li><a  href="about.html">About</a></li>
          <li><a   href="login.php">Login</a></li>
          <li><a class="active" href="signup.php">Sign up</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

      <div class="header-social-links">
        <a href="https://twitter.com/ensias_official" class="twitter"><i class="bi bi-twitter"></i></a>
        <a href="https://www.facebook.com/ensias.official/" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="https://www.instagram.com/ensias.official/" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="https://www.linkedin.com/in/ensias/" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
      </div>

    </div>

  </header><!-- End Header -->

  <main id="main">



    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

      
        <div class="row">
          <div class="col-lg-5">
            <img src="assets/img/login.jpeg" class="img-fluid imgheight"  alt="">
          </div>
          <div class="col-lg-7 pt-4 pt-lg-0 content">
            <section id="contact" class="contact">
              <div class="container" data-aos="fade-up">
        
                <div class="section-title">
                  <h2>Sign up</h2>
                  <p></p>
                </div>
        
                
        
               
        
                  <div >
        
                    <form action="" method="post"  >
                      <div class="row">
                        <div class="form-group mt-3">
                          <input type="text" name="nom" class="form-control" id="nom" placeholder="Nom" required>
                        </div>
                      <div class="form-group mt-3">
                        <input type="text" class="form-control" name="prenom" id="prenom" placeholder="Prénom" required>
                      </div>
                      <div class="form-group mt-3">
                        <input type="text" class="form-control" name="email" id="email" placeholder="Email" required>
                      </div>
                      
                      <div class="form-group mt-3">
                        <input type="text" class="form-control" name="mdp" id="mdp" placeholder="Mot de passe" required>
                      </div>
                      <div class="form-group mt-3">
                          <input type="text" name="etablissement" class="form-control" id="etablissement" placeholder="Etablissement" required>
                        </div>
                        <div class="form-group mt-3">
                          <input type="text" name="filiere" class="form-control" id="filiere" placeholder="Filière" required>
                        </div>
                     
                  <div class="text-center"><br><button class="btn btn-info" name="submit" type="submit">Sign up</button></div>
                      
                    </form>
                    
                  </div>
        
                </div>
              
                  <br>
                  <br>

              </div>
            </section><!-- End Contact Section -->
          </div>
        </div>

      </div>
    </section><!-- End About Section -->




    
    <!-- ======= Contact Section ======= -->
   

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  


  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <footer id="footer">
    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>2012-2022</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
      </div>
    </div>
  </footer><!-- End  Footer -->

</body>

</html>