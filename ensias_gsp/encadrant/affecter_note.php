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


if(isset($_POST['affecter']) &&isset($_POST['note'])&&isset($_POST['nomP']))
{
  $nte=$_POST['note'];
  
  $stmt9=$db->prepare('select * from projet where sujet=:sujet');
  $stmt9->execute(array('sujet'=>$_POST['nomP']));
  $row9=$stmt9->fetch(PDO::FETCH_ASSOC);
  extract($row9);  
  if(empty($note))
  {
    $stmt8=$db->prepare('update projet set note=:note where sujet=:sjt');
    $stmt8->execute(array(
      'note'=>$nte,
      'sjt'=>$_POST['nomP']
     ));
  }

  else
    {
         $nouvelle_note=($note+$nte)/2;
         $stmt10=$db->prepare('update projet set note=:note where sujet=:sjt');
         $stmt10->execute(array(
           'note'=>$nouvelle_note,
           'sjt'=>$_POST['nomP']
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
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $_SESSION['prenom_encadrant']." ".$_SESSION['nom_encadrant'] ?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php echo $_SESSION['prenom_encadrant']." ".$_SESSION['nom_encadrant'] ?></h6>
              <span>Encadrant</span>
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
    <a class="nav-link collapsed" href="planning_reunion.php">
      <i class="bi bi-grid"></i>
      <span>Consulter et planifier une séance d'encadrement</span>
    </a>
  </li><!-- End Dashboard Nav -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="planning_soutenance.php">
      <i class="bi bi-menu-button-wide"></i>
      <span>Consulter les soutenances</span>
    </a>
  </li><!-- End Dashboard Nav -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="affecter_note.php">
      <i class="bi bi-menu-button-wide"></i>
      <span>Affecter et consulter les notes</span>
    </a>
  </li><!-- End Dashboard Nav -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="pages-contact.php">
      <i class="bi bi-envelope"></i>
      <span>Contact</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link collapsed" href="proposer_sujet.php">
      <i class="bi bi-menu-button-wide"></i>
      <span>Proposer un sujet</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link collapsed" href="consulter_binome_sujet.php">
      <i class="bi bi-menu-button-wide"></i>
      <span>Consulter les sujets/binômes/monômes</span>
    </a>
  </li></ul>

</aside><!-- End Sidebar-->

  <main id="main" class="main">
  <div class="pagetitle">
      <h1>Affecter la note</h1>
  </div>
  <br>
  <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <br><br>
<form action="affecter_note.php" method="post">
  <div class="btn-group slct">
  <label for="inputText" class="col-sm-2 col-form-label">Le sujet du projet</label>
  <select style="margin-left:80px;" class="btn btn-primary dropdown-toggle " name="nomP" class="dropdown-menu dropdown-menu-lg-end ">
  <option disable >Le sujet du projet</option>
    <?php  
           $stmt5=$db->prepare('select sujet from projet where idProjet in (select idprojet from projetencadrant where idEncadrant=:idenc)');
          $stmt5->execute(array('idenc'=>$_SESSION['id_encadrant']));
          while($row5=$stmt5->fetch(PDO::FETCH_ASSOC))
          {
            extract($row5);  
            echo '<option>'.$sujet.'</option>';
          }?>

        </select>
</div>
<br> <br>
<div class="row mb-7">
    <label for="inputText" class="col-sm-2 col-form-label">La note</label>
        <div class="col-sm-10">
            <input type="text" style="margin-left:27px;width:413px" name="note" class="form-control">
        </div>
  </div>
 <br><br>
  <div class="text-center"><button style="margin-left:-210px;" class="btn btn-primary" name="affecter" type="submit">Affecter la note</button></div>
  <br><br><br>
</form>
</div>
  </div>
    </div>
      </div>
         </section>
<div class="pagetitle">
      <h1>Liste des sujets/notes</h1>
  </div>
  <br>
  <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Table des projets</h5>
              <!-- Table with stripped rows -->
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Titre du projet</th>
                    <th scope="col">Etudiant1</th>
                    <th scope="col">Etudiant2</th>
                    <th scope="col">Note</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $stmt3=$db->prepare('select idProjet from projetencadrant where idEncadrant=:idenc');
                  $stmt3->execute(array('idenc'=>$_SESSION['id_encadrant']));
                  while($row1=$stmt3->fetch(PDO::FETCH_ASSOC))
                  {
                    echo "<tr>";
                    extract($row1);
                    $stmt4=$db->prepare('select sujet from projet where idProjet=:idp');
                    $stmt4->execute(array('idp'=>$idProjet));
                    $row2=$stmt4->fetch(PDO::FETCH_ASSOC);
                    extract($row2);
                    echo "<td>".$sujet."</td>";

                    $stmt5=$db->prepare('select id from projetetudiant where idProjet=:idp');
                    $stmt5->execute(array('idp'=>$idProjet));
                    while($row3=$stmt5->fetch(PDO::FETCH_ASSOC))
                      {
                        extract($row3);

                        $stmt6=$db->prepare('select nom,prenom from etudiant where id=:id');
                        $stmt6->execute(array('id'=>$id));
                        while($row4=$stmt6->fetch(PDO::FETCH_ASSOC))
                           {
                            extract($row4);
                            echo "<td>".$nom." ".$prenom."</td>";
                           }
                      }
                      $stmt7=$db->prepare('select note from projet where idProjet=:idp');
                      $stmt7->execute(array('idp'=>$idProjet));
                      $row5=$stmt7->fetch(PDO::FETCH_ASSOC);
                      extract($row5);
                      echo "<td>".$note."</td>";
                      echo "</tr>";
                  }
                  ?>
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

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
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
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