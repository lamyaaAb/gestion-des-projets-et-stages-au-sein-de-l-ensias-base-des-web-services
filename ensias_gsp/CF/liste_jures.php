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

if(isset($_POST['affecter']) && isset($_POST['jr1']) && isset($_POST['jr2']))
{
  $nm1=strtok($_POST['jr1']," "); 
  $nm2=strtok($_POST['jr2']," "); 

   //recuperation de id1
  $stmt3=$db->prepare('select idMembreJury as id1,nomMembre as nom1,prenomMembre as prenom1 from membreJury where nomMembre =:nm');
  $stmt3->execute(array('nm'=>$nm1));
  $row3=$stmt3->fetch(PDO::FETCH_ASSOC);
  extract($row3);

//recuperation de id2
  $stmt4=$db->prepare('select idMembreJury as id2,nomMembre as nom2,prenomMembre as prenom2 from membrejury where nomMembre =:nom');
  $stmt4->execute(array('nom'=>$nm2));
  $row4=$stmt4->fetch(PDO::FETCH_ASSOC);
  extract($row4);

  
  //insertion dans la table des jurés
  $stmt7=$db->prepare('insert into jury(nom1,prenom1,nom2,prenom2,filiere) values(:nm1,:pnm1,:nm2,:pnm2,:fil)');
  $stmt7->execute(array('nm1'=>$nom1,'pnm1'=>$prenom1,'nm2'=>$nom2,'pnm2'=>$prenom2,'fil'=>  $_SESSION['filiere']));

  $stmt8=$db->prepare('select idJury  from jury where nom1 =:n');
  $stmt8->execute(array('n'=>$nom1));
  $row8=$stmt8->fetch(PDO::FETCH_ASSOC);
  extract($row8);      


  $stmt5=$db->prepare('update membrejury set idJury=:idj where idMembreJury =:id');
  $stmt5->execute(array('idj'=>$idJury,'id'=>$id1));

  $stmt6=$db->prepare('update membrejury set idJury=:idj where idMembreJury =:id');
  $stmt6->execute(array('idj'=>$idJury,'id'=>$id2));


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
      <h1>Affecter les jurés</h1>
    </div><!-- End Page Title -->
   
    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <!-- Table with stripped rows -->
              <form action="liste_jures.php" method="post">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Membre de jury 1</th>
                    <th scope="col">Membre de jury 2</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody> 
               
                  <tr>
                    <td>
                      <div class="btn-group row mb-7">
                        <select  class="btn btn-primary dropdown-toggle " name="jr1" class="dropdown-menu dropdown-menu-lg-end ">
                           <option disable >Membre de jury 1</option>
                            <?php  
                               $stmt1=$db->prepare('select nomMembre,prenomMembre from membrejury where filiere=:fil');
                               $stmt1->execute(array('fil'=>$_SESSION['filiere']));
                              while($row1=$stmt1->fetch(PDO::FETCH_ASSOC))
                              {
                                extract($row1);  
                                echo '<option>'.$nomMembre.' '.$prenomMembre.'</option>';
                              }?>
                    
                            </select>
                      </div>
                    </td>
                    <td>
                      <div class="btn-group row mb-7">
                        <select  class="btn btn-primary dropdown-toggle " name="jr2" class="dropdown-menu dropdown-menu-lg-end ">
                           <option disable >Membre de jury 2</option>
                            <?php  
                               $stmt2=$db->prepare('select nomMembre,prenomMembre from membrejury where filiere=:fil');
                               $stmt2->execute(array('fil'=>$_SESSION['filiere']));
                              while($row2=$stmt2->fetch(PDO::FETCH_ASSOC))
                              {
                                extract($row2);  
                                echo '<option>'.$nomMembre.' '.$prenomMembre.'</option>';
                              }?>
                    
                            </select>
                      </div>
                    </td>
                    <td><button type="submit" name="affecter" class="btn btn-outline-primary">Affecter jury</button></td>
                </tr>
             
                </tbody>
              </table>
              </form>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->



  <main id="main" class="main">

<div class="pagetitle">
  <h1>Liste des jurés</h1>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <!-- Table with stripped rows -->
          <table class="table">
            <thead>
              <tr>
                <th scope="col">Membre de jury 1</th>
                <th scope="col">Membre de jury 2</th>
              </tr>
            </thead>
            <tbody> 
            <?php 
                  $stmt7=$db->prepare('select * from jury where filiere=:fil');
                  $stmt7->execute(array('fil'=>$_SESSION['filiere']));
                  while($row7=$stmt7->fetch(PDO::FETCH_ASSOC))
                   {
                    echo "<tr>";
                    extract($row7);
                    echo "<td>".$nom1." ".$prenom1."</td>";
                    echo "<td>".$nom2." ".$prenom2."</td>";     
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