<?php

 
if(isset($_POST['login']) && isset($_POST['email']) && isset($_POST['mdp']))
{
    $email =$_POST['email'];
    $mdp = $_POST['mdp'];
    $etudiant = file_get_contents("http://localhost/Projet-PFA/ensias_gsp/php_rest/api/etudiant/readun.php?eml=$email&motdp=$mdp");
    $response = json_decode($etudiant,true); 
if(isset($response['data'])) 
    { //ze3ma lweb service rejee3 lina shi objet
        session_start();
      
        $_SESSION['prenom']=$response['data'][0]['prenom'];
        $_SESSION['nom']=$response['data'][0]['nom'];
        $_SESSION['cne']=$response['data'][0]['cne'];
        $_SESSION['email']=$response['data'][0]['email'];
        $_SESSION['id']=$response['data'][0]['id'];
        $_SESSION['mdp']=$response['data'][0]['mdp'];
        header('location:http://localhost/Projet-PFA/ensias_gsp/etudiant/users-profile.php');
        
       
    }

else 
    {
      if(isset($_POST['encadrant']))
      {
      //On teste s'il s'agit d'un encadrant
      $encadrant = file_get_contents("http://localhost/Projet-PFA/ensias_gsp/php_rest/api/encadrant/readun.php?eml=$email&motdp=$mdp");
      $response = json_decode($encadrant,true); 
  if(isset($response['data'])) 
    { //ze3ma lweb service rejee3 lina shi objet
        session_start();
      
        $_SESSION['prenom_encadrant']=$response['data'][0]['prenom'];
        $_SESSION['nom_encadrant']=$response['data'][0]['nom'];
        $_SESSION['email_encadrant']=$response['data'][0]['email'];
        $_SESSION['id_encadrant']=$response['data'][0]['id'];
        $_SESSION['mdp_encadrant']=$response['data'][0]['mdp'];
        $_SESSION['type_encadrant']=$response['data'][0]['type'];
        $_SESSION['etab_encadrant']=$response['data'][0]['etablissement'];
        header('location:http://localhost/Projet-PFA/ensias_gsp/encadrant/users-profile.php');
       
    }
  }
    
    else
      { 
         //On teste s'il s'agit d'un chef de filiere
      $cf = file_get_contents("http://localhost/Projet-PFA/ensias_gsp/php_rest/api/cf/readun.php?eml=$email&motdp=$mdp");
      $response = json_decode($cf,true); 
        if(isset($response['data'])) 
           { //ze3ma lweb service rejee3 lina shi objet
              session_start();
      
              $_SESSION['prenom_cf']=$response['data'][0]['prenomCF'];
              $_SESSION['nom_cf']=$response['data'][0]['nomCF'];
              $_SESSION['email_cf']=$response['data'][0]['emailCF'];
              $_SESSION['id_cf']=$response['data'][0]['idCF'];
              $_SESSION['mdp_cf']=$response['data'][0]['mdpCF'];
              $_SESSION['filiere']=$response['data'][0]['filiereCF'];
              header('location:http://localhost/Projet-PFA/ensias_gsp/CF/users-profile.php');
            }

        else{
                if(isset($_POST['mJury']))
                 {
                  //On teste s'il s'agit d'un membre de jury
                 $mj = file_get_contents("http://localhost/Projet-PFA/ensias_gsp/php_rest/api/membrejury/readun.php?eml=$email&motdp=$mdp");
                 $response = json_decode($mj,true); 
                 if(isset($response['data'])) 
                      { //ze3ma lweb service rejee3 lina shi objet
                          session_start();
                          $_SESSION['prenom_mj']=$response['data'][0]['prenomMJ'];
                          $_SESSION['nom_mj']=$response['data'][0]['nomMJ'];
                          $_SESSION['email_mj']=$response['data'][0]['emailMJ'];
                          $_SESSION['id_mj']=$response['data'][0]['idMJ'];
                          $_SESSION['mdp_mj']=$response['data'][0]['mdpMJ'];
                          $_SESSION['filiere_mj']=$response['data'][0]['filiereMJ'];
                          header('location:http://localhost/Projet-PFA/ensias_gsp/jury/users-profile.php');
                      }
                    }
                  else
                  {
                      //On teste s'il s'agit d'un administrateur 
                      $administrateur = file_get_contents("http://localhost/Projet-PFA/ensias_gsp/php_rest/api/administrateur/readun.php?eml=$email&motdp=$mdp");
                      $response = json_decode($administrateur,true); 
                  if(isset($response['data'])) 
                       { //ze3ma lweb service rejee3 lina shi objet
                       session_start();
                     
                       $_SESSION['prenom_admin']=$response['data'][0]['prenom'];
                       $_SESSION['nom_admin']=$response['data'][0]['nom'];
                       $_SESSION['email_admin']=$response['data'][0]['email'];
                       $_SESSION['id_admin']=$response['data'][0]['id'];
                       $_SESSION['mdp_admin']=$response['data'][0]['mdp'];
                       header('location:http://localhost/Projet-PFA/ensias_gsp/admin/index.php');
                      
                      }
                    
                 else{ // lweb service mareje3 walo
                  header('location:http://localhost/Projet-PFA/ensias_gsp/test.php');}   


                  }    

 
            }
    }   

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


      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a href="index.html">Home</a></li>
          <li><a  href="about.html">About</a></li>
          <li><a  class="active" href="login.php">Login</a></li>
          <li><a href="signup.php">Sign up</a></li>
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
          <div class="col-lg-4">
            <img src="assets/img/login.jpeg" class="img-fluid" alt="">
          </div>
          <div class="col-lg-8 pt-4 pt-lg-0 content">
            <section id="contact">
              <div class="container" data-aos="fade-up">
        
                <div class="section-title">
                  <h2>LOGIN</h2>
                  <p></p>
                </div>
        
                
        
               
        
                  <div >
        
                    <form action="login.php" method="post"  >
                      <div class="row">
                        <div class="form-group mt-3">
                          <input type="text" name="email" class="form-control"  id="email" placeholder="Your email" required>
                        </div>
                      <div class="form-group mt-3">
                        <input type="password"  name="mdp" class="form-control"  id="mdp" placeholder="Your password" required>
                      </div>
                      <div class="form-group mt-3">
                          <div class="form-check form-check-inline">
                               <input class="form-check-input" type="radio" name="encadrant" id="inlineRadio1" value="option1">
                               <label class="form-check-label" for="inlineRadio1">Encadrant</label>
                          </div>
                          <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="mJury" id="inlineRadio2" value="option2">
                                <label class="form-check-label" for="inlineRadio2">Membre Jury</label>
                          </div>
                      </div>
                      <br>
                      <br>
                      <br>
                      
                      <div class="text-center"><button class="btn btn-info" name="login" type="submit">Login</button></div>
                    </form>
        
                  </div>
        
                </div>
        
              </div>
            </section><!-- End Contact Section -->
          </div>
        </div>

      </div>
    </section><!-- End About Section -->




    
    <!-- ======= Contact Section ======= -->
   

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>2012-2022</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
      </div>
    </div>
  </footer><!-- End  Footer -->


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
 <!--script src="assets/vendor/php-email-form/validate.js"></script-->

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>