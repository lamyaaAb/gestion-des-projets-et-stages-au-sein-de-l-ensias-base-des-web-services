<?php
session_start();
include_once '../php_rest/config/Database.php';
include 'Calendar.php';

if(empty($_SESSION['email']) or empty($_SESSION['mdp'])){
  header("location:http://localhost/Projet-PFA/ensias_gsp/login.php");
    exit();
}

$database=new Database();
$db=$database->connect();


if(isset($_POST['programmer']) &&isset($_POST['heures']) && isset($_POST['durees']) && isset($_POST['nomP']) && isset($_POST['jury']) && isset($_POST['dates'])&& isset($_POST['salles']))
{
  $duree=$_POST['durees'];
  $date=$_POST['dates'];
  $nom_projet=$_POST['nomP'];
  $salle=$_POST['salles'];
  $heure=$_POST['heures'];
  $jury=$_POST['jury'];
   $nom1=strtok($jury, " "); 
  $stmt3=$db->prepare('select idJury from jury where nom1=:nm');
  $stmt3->execute(array('nm'=>$nom1));
  while($row1=$stmt3->fetch(PDO::FETCH_ASSOC))
  {
    extract($row1);
    $stmt9=$db->prepare('select idProjet from projet where sujet=:sjt');
    $stmt9->execute(array('sjt'=>$nom_projet));
    $row9=$stmt9->fetch(PDO::FETCH_ASSOC);
    extract($row9);
    $stmt=$db->prepare('INSERT into soutenance(dateSoutenance,dureeSoutenance,salleSoutenance,heureSoutenance,idProjet,idJury) values(:dater,:dureer,:salle,:heure,:idProjet,:idJury)');
    $stmt->execute(array(
              'dater' =>$date,
              'dureer'=> $duree,
              'salle'=>$salle,
              'idProjet'=>$idProjet,
              'heure'=>$heure,
              'idJury'=>$idJury
             ));
  }
}


$month=date('m');//recuperation de l'année courante
$year=date('y');//recupération du mois courant
//création du calendrier en se basant sur le mois courant et l'annee courante
$calendar = new Calendar($year.'-'.$month.'-01');

//recupération des evenements des projets 

     $stmt2=$db->prepare('select * from soutenance where MONTH(dateSoutenance)=MONTH(CURDATE()) and idProjet in (select idProjet from projet where idCF=:idcf)');
     $stmt2->execute(array( 'idcf'=>$_SESSION['id_cf']));
      while($row3=$stmt2->fetch(PDO::FETCH_ASSOC))
        {
          extract($row3);
          $stmt10=$db->prepare('select sujet from projet where idProjet=:idp');
          $stmt10->execute(array( 'idp'=>$idProjet));
          $row10=$stmt10->fetch(PDO::FETCH_ASSOC);
          extract($row10);
          //pour l'ajout des événements
          $calendar->add_event('Soutenance à '.$heureSoutenance.' du projet '.$sujet, $dateSoutenance, 1, 'red');      
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
  <link href="calendar.css" rel="stylesheet" type="text/css">


  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
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
      <h1>Planifer les soutenances</h1>
    </div><!-- End Page Title -->
    <br>
<form action="planifier_soutenance.php" method="post">
  <div class="btn-group row mb-7">
  <label for="inputText"  style=" margin-top:10px;" class="col-form-label">Le sujet du projet</label>
    <select style="margin-left:180px;margin-top:-45px" class="btn btn-primary dropdown-toggle " name="nomP" class="dropdown-menu dropdown-menu-lg-end ">
       <option disable >Le sujet du projet</option>
        <?php  
           $stmt5=$db->prepare('select sujet from projet where idCF=:idcf');
           $stmt5->execute(array('idcf'=> $_SESSION['id_cf']));
          while($row5=$stmt5->fetch(PDO::FETCH_ASSOC))
          {
            extract($row5);  
            echo '<option>'.$sujet.'</option>';
          }?>

        </select>
  </div>
  <br><br>
    <div class="row mb-7">
    <label for="inputText" class="col-sm-2 col-form-label">La date de la soutenance</label>
        <div class="col-sm-10">
            <input type="date" name="dates" class="form-control">
        </div>
  </div>
  <div class="row mb-7">
    <label for="inputText" class="col-sm-2 col-form-label">La durée de la soutenance</label>
        <div class="col-sm-10">
            <input type="text" name="durees" class="form-control">
        </div>
  </div>
  <div class="row mb-7">
    <label for="inputText" class="col-sm-2 col-form-label">L'heure de la soutenance</label>
        <div class="col-sm-10">
            <input type="text" name="heures" class="form-control">
        </div>
  </div>
  <div class="row mb-7">
    <label for="inputText" class="col-sm-2 col-form-label">La salle de la soutenance</label>
        <div class="col-sm-10">
            <input type="text" name="salles" class="form-control">
        </div>
  </div>
  <div class="btn-group row mb-7">
  <label for="inputText" class="col-sm-2 col-form-label">Le jury</label>
    <select style="margin-left:180px;margin-top:-40px" class="btn btn-primary dropdown-toggle " name="jury" class="dropdown-menu dropdown-menu-lg-end ">
       <option disable >Le jury</option>
        <?php  
         
          $stmt6=$db->prepare('select * from jury where nom1 in (select nomMembre from membrejury where filiere=:fil)');
          $stmt6->execute(array('fil'=>$_SESSION['filiere']));
          while($row6=$stmt6->fetch(PDO::FETCH_ASSOC))
          {
              extract($row6); 
              echo '<option>'.$nom1.' '.$prenom1.' -- '.$nom2.' '.$prenom2.'</option>';
            
          }?>

        </select>
  </div>
  <br>
 <br><br>
  <div class="text-center"><button class="btn btn-primary" name="programmer" type="submit">confirmer</button></div>
  <br><br><br>
</form>
  
  <?=$calendar?>
  
  
  </section>

    

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>2021-2022</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
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