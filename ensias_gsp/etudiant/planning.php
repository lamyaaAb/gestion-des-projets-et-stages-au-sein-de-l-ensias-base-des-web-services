<?php

include_once '../php_rest/config/Database.php';
include 'Calendar.php';

session_start();
$database=new Database();
$db=$database->connect();
if(isset($_POST['programmer']) && isset($_POST['duree']) && isset($_POST['nom_projet']) && isset($_POST['ordre']) && isset($_POST['date']))
{
  $duree=$_POST['duree'];
  $date=$_POST['date'];
  $nom_projet=$_POST['nom_projet'];
  $ordre=$_POST['ordre'];
  $stmt3=$db->prepare('select idProjet from projet where sujet=:sujet');
  $stmt3->execute(array('sujet'=>$nom_projet));
  while($row1=$stmt3->fetch(PDO::FETCH_ASSOC))
  {
    extract($row1);
    $id=$idProjet;
  }
  $stmt=$db->prepare('INSERT into reunion(date_reunion,duree_reunion,ordre_reunion,idProjet) values(:dater,:dureer,:ordrer,:idProjet)');
  $stmt->execute(array(
      'dater' =>$date,
      'dureer'=> $duree,
      'ordrer'=>$ordre,
      'idProjet'=>$idProjet
     ));
}
//hadshi db pour le calendrier

$month=date('m');//recuperation de l'année courante
$year=date('y');//recupération du mois courant
//création du calendrier en se basant sur le mois courant et l'annee courante
$calendar = new Calendar($year.'-'.$month.'-01');

//recupération des evenements des projets hadi pour etudiant

     $stmt2=$db->prepare('select * from reunion where MONTH(date_reunion)=MONTH(CURDATE()) and idProjet in (select idprojet from projetetudiant where id=:id)');
     $stmt2->execute(array( 
                    'id'=>$_SESSION['id']));
      while($row3=$stmt2->fetch(PDO::FETCH_ASSOC))
        {
          extract($row3);
          $dur=$duree_reunion;
          $dte=$date_reunion;
          $ordr=$ordre_reunion; 
          //pour l'ajout des événements
          $calendar->add_event($ordr.' à '.$heure, $dte, 1, 'green');      
        }
        
        
      //recupération des evenements des soutenances hadi pour etudiant

     $stmt3=$db->prepare('select * from soutenance where MONTH(dateSoutenance)=MONTH(CURDATE()) and idProjet in (select idprojet from projetetudiant where id=:id)');
     $stmt3->execute(array( 
                    'id'=>$_SESSION['id']));
      while($row4=$stmt3->fetch(PDO::FETCH_ASSOC))
        {
          extract($row4);

          $stmt10=$db->prepare('select sujet from projet where idProjet=:idp');
          $stmt10->execute(array( 'idp'=>$idProjet));
          $row10=$stmt10->fetch(PDO::FETCH_ASSOC);
          extract($row10);

          $dateS=$dateSoutenance;
        
          //pour l'ajout des événements
          $calendar->add_event('Soutenance à '.$heureSoutenance.' du projet '.$sujet, $dateS, 1, 'red');      
        }    
       
        
 
//pour l'ajout des événements
//$calendar->add_event('Birthday', '2022-06-03', 1, 'green');

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
  <link href="calendar.css" rel="stylesheet" type="text/css">

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
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $_SESSION['prenom']." ".$_SESSION['nom'] ?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php echo $_SESSION['prenom']." ".$_SESSION['nom'] ?></h6>
              <span>Ensiaste</span>
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
        <a class="nav-link collapsed" href="index.php">
          <i class="bi bi-grid"></i>
          <span>Votre projet PFA</span>
        </a>
      </li><!-- End Dashboard Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="projet_stage.php">
          <i class="bi bi-grid"></i>
          <span>Votre projet stage</span>
        </a>
      </li><!-- End Dashboard Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="planning.php">
          <i class="bi bi-menu-button-wide"></i>
          <span>Planning</span>
        </a>
      </li><!-- End Dashboard Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-contact.php">
          <i class="bi bi-envelope"></i>
          <span>Contact</span>
        </a>
      </li><!-- End Dashboard Nav --> </ul>
  
    </aside><!-- End Sidebar-->
  

  <main id="main" class="main">
  <div class="pagetitle">
      <h1>Planning</h1>
  </div>
  <br><br>
<!--form action="planning.php" method="post">
  <div class="row mb-7">
    <label for="inputText" class="col-sm-2 col-form-label">La date de la réunion</label>
        <div class="col-sm-10">
            <input type="date" name="date" class="form-control">
        </div>
  </div>
  <div class="row mb-7">
    <label for="inputText" class="col-sm-2 col-form-label">La durée de la réunion</label>
        <div class="col-sm-10">
            <input type="text" name="duree" class="form-control">
        </div>
  </div>
  <div class="row mb-7">
    <label for="inputText" class="col-sm-2 col-form-label">L'ordre de la réunion</label>
        <div class="col-sm-10">
            <input type="text" name="ordre" class="form-control">
        </div>
  </div>
  <div class="row mb-7">
    <label for="inputText" class="col-sm-2 col-form-label">Nom du projet</label>
        <div class="col-sm-10">
            <input type="text" name="nom_projet" class="form-control">
        </div>
  </div><br><br>
  <div class="text-center"><button class="btn btn-info" name="programmer" type="submit"><b>Programmer la réunion</b></button></div>
  <br><br><br>
</form-->
  
  <?=$calendar?>
  
  

    
    


            </div>
          </div>

        </div>
      </div-->
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
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>