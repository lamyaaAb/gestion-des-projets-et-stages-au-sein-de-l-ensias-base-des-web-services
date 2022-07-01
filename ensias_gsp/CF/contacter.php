<?php
$host="localhost";
$username="root";
$pass="";
$database="gsp";
try{
	$connect=new PDO("mysql:host=$host;dbname=$database",$username,$pass);
}

catch(PDOException $e){
	echo" connexion pas faite";
}

session_start();
$email=$_SESSION['email_cf'];
if(isset($_POST['email']) && isset($_POST['submit']) && isset($_POST['message']) ){
if(! empty($_FILES['file']['name'])) {
  $file_name=$_FILES['file']['name'];
  $file_dest=$file_name;
  $file_tmp_name=$_FILES['file']['tmp_name'];
  if(move_uploaded_file($file_tmp_name,$file_dest)){
    $stmt=$connect->prepare('INSERT into chatetudiantencadrant(emailEncadrant,emailEtudiant,texte,lien) values(:emailEncadrant,:emailEtudiant,:texte,:lien)');
    $stmt->execute(array(
      'emailEncadrant' =>$_POST['email'],
      'emailEtudiant'=> $email,
      'texte'=>$_POST['message'],
      'lien'=>$file_dest
     ));
  }
  
}
else {
  $stmt=$connect->prepare('INSERT into chatetudiantencadrant(emailEncadrant,emailEtudiant,texte) values(:emailEncadrant,:emailEtudiant,:texte)');
  $stmt->execute(array(
    'emailEncadrant' =>$_POST['email'],
    'emailEtudiant'=> $email,
    'texte'=>$_POST['message']
   ));
  
}
}



?>




















<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>ENSIAS-GSP</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
<style>

div.info-box{
  
  height: 200px;
  overflow: auto;
}

</style>
  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">ENSIAS</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->


    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        
        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $_SESSION['prenom_cf']." ".$_SESSION['nom_cf'] ?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php echo $_SESSION['prenom_cf']." ".$_SESSION['nom_cf'] ?></h6>
              <span>Chef de la filière <?php echo $_SESSION['filiere']?></span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.php">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

         
            

            <li>
              <a class="dropdown-item d-flex align-items-center" href="../index.html">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

 <!-- ======= Sidebar ======= -->
 <aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

  <li class="nav-item">
    <a class="nav-link collapsed" href="Affecter_sujet_encadrant_binomes.php">
      <i class="bi bi-grid"></i>
      <span>Affecter les sujets et les encadrants aux binômes</span>
    </a>
  </li><!-- End Dashboard Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" href="planifier_soutenance.php">
      <i class="bi bi-menu-button-wide"></i>
      <span>Planifier les soutenances</span>
    </a>
  </li><!-- End Profile Page Nav -->

  <li class="nav-item">
<a class="nav-link collapsed" href="liste_binomes.php">
  <i class="bi bi-card-list"></i>
  <span>Affecter et consulter les binomes</span>
</a>
</li>

<li class="nav-item">
<a class="nav-link collapsed" href="liste_jures.php">
  <i class="bi bi-card-list"></i>
  <span>Affecter et consulter les jurés</span>
</a>
</li>
 
  <li class="nav-item">
    <a class="nav-link collapsed" href="contacter.php">
      <i class="bi bi-envelope"></i>
      <span>Contacter</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link collapsed" href="valider_sujet.php">
      <i class="bi bi-card-list"></i>
      <span>Valider les sujets</span>
    </a>
  </li>



</ul>

</aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Contacter</h1>
      
    </div>
  <section class="section contact">
<!--div class="row gy-4"-->






<div class="col-xl-12">
    <div class="card p-4">
      <form action="" method="post" enctype="multipart/form-data">
      <div class="row gy-4">

<div class="col-md-12">
  <input class="form-control" type="text" name="email"  placeholder="Email du destinataire" required>
</div>



<div class="col-md-12">
  <textarea class="form-control" name="message" rows="6" placeholder="Tapez votre message" required>
  </textarea>
</div>
<br>
<div class="row md-12">
                  <label for="inputNumber" class="col-sm-5 col-form-label"></label>
                  <div class="col-sm-12">
                    <input class="form-control" name="file" type="file" id="file">
                  </div>
                </div>

<br>

  <button name="submit" class="btn btn-info" type="submit">Send Message</button>
</div>

</div>
      </form>
    </div>

  </div>

</div>







<br><br>





  <div class="col-xl-12">

    <div class="row">
      <div class="col-lg-12">
      <div class="info-box card">
      <table class="table"> 
        <?php 
      $recupMessages=$connect->prepare('SELECT * from chatetudiantencadrant where emailEncadrant=:email');
      $recupMessages->execute(array(
        'email' =>$email
       ));

       while($message=$recupMessages->fetch()){
        ?>
    <tr>
   <td class="table-active" ><?=$message['emailEtudiant'];?></td>  <td ><?php echo $message['texte'];
   if(isset($message['lien'])){
     echo'<br><br>';
     echo '<a href="'.$message['lien'].'">Télécharger un fichier déposé</a>';
   }
   
   
   
   ?></td></tr>


<?php } ?>
     </table>
      </div>

      </div>
     
      
    </div>

  </div>

  

</section>





















  

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>2021/2022</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
     <a href="https://bootstrapmade.com/"></a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.min.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <!--script src="assets/vendor/php-email-form/validate.js"></script-->

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>