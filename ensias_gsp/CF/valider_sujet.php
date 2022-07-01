<?php
session_start();
include_once '../php_rest/config/Database.php';
if(empty($_SESSION['email']) or empty($_SESSION['mdp'])){
  header("location:http://localhost/Projet-PFA/ensias_gsp/login.php");
    exit();
}

$database=new Database();
$db=$database->connect();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>ENSIAS</title>
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
            
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $_SESSION['prenom_cf']." ".$_SESSION['nom_cf'] ?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php echo $_SESSION['prenom_cf']." ".$_SESSION['nom_cf'] ?></h6>
              <span>Chef de la filière <?php echo $_SESSION['filiere']?> </span>
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
      <h1>Liste des sujets proposés</h1>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Titre du projet</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                <?php 
                  $i=1;$j=1;
                  $stmt1=$db->prepare('select sujet,valide,pasValide from projet where idProjet in (select idprojet from projetencadrant where idEncadrant in(select idEncadrant from encadrant where filiere=:fil))');
                  $stmt1->execute(array('fil'=>$_SESSION['filiere']));
                  while($row1=$stmt1->fetch(PDO::FETCH_ASSOC))
                   {
                    echo "<tr>";
                    extract($row1);
                    $i=$i+1;
                    $j=$j-1;
                   
                    echo "<td>".$sujet."</td>";
                    if(empty($valide) && empty($pasValide))
                        {
                            //echo '<h4> "salam'.$i.'" </h4>';
                        echo '<form action="valider_sujet.php" method="post">';
                        echo  '<td><div class="text-center"><button class="btn btn-primary" name="'.$i.'" type="submit">Valider sujet</button></div></td>';
                        echo  '<td><div class="text-center"><button class="btn btn-primary" name="'.$j.'" type="submit">Ne pas valider sujet</button></div></td>';   
                        echo '</form>';
                        if(isset($_POST[$i]))
                          {
                            $stmt3=$db->prepare('update projet  set valide=:vld where sujet =:sjt');
                            $stmt3->execute(array('sjt'=>$sujet,'vld'=>'valide'));

                            $stmt5=$db->prepare('update projet  set idCF=:idchf where sujet =:sjt');
                            $stmt5->execute(array('sjt'=>$sujet,'idchf'=> $_SESSION['id_cf']));
                             
                            //header("location:http://localhost/Projet-PFA/ensias_gsp/CF/valider_sujet.php");
                          }
                        if(isset($_POST[$j]))
                          {
                          

                            $stmt9=$db->prepare('select * from projet where sujet =:sjt');
                            $stmt9->execute(array('sjt'=>$sujet));
                            $row9=$stmt9->fetch(PDO::FETCH_ASSOC);
                            extract($row9);

                            $stmt4=$db->prepare('delete from projet where sujet =:sjt');
                            $stmt4->execute(array('sjt'=>$sujet));

                            $stmt8=$db->prepare('delete from projetencadrant where idProjet =:idpro');
                            $stmt8->execute(array('idpro'=>$idProjet));

                            //header("location:http://localhost/Projet-PFA/ensias_gsp/CF/valider_sujet.php");
                            
                          }
  
                         }
                        else{
                               echo '<td> </td>';
                               echo '<td> </td>';
                             }
                          
                    echo "</tr>";
                   }
                ?>
                </tbody>
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