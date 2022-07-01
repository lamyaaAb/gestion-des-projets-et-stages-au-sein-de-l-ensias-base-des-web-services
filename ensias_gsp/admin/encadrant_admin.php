<?php



session_start();

if(empty($_SESSION['email_admin']) or empty($_SESSION['mdp_admin'])){
  header("location:http://localhost/Projet-PFA/ensias_gsp/login.php");
    exit();
}




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
$stmt=$connect->prepare('SELECT * from encadrant where validite is NULL order by idEncadrant');
$stmt->execute();





?>





<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>ENSIAS GSP</title>
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
        <!--img src="assets/img/logo.png" alt=""-->
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
           
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $_SESSION['prenom_admin']." ".$_SESSION['nom_admin'] ?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php echo $_SESSION['prenom_admin']." ".$_SESSION['nom_admin'] ?></h6>
   
            </li>
            <li>
              <hr class="dropdown-divider">
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
        <a class="nav-link " href="index.php">
          <i class="bi bi-grid"></i>
          <span>La liste des étudiants</span>
        </a>
      </li><!-- End Home Nav -->

      <li class="nav-item">
        <a class="nav-link " href="encadrant_admin.php">
          <i class="bi bi-grid"></i>
          <span>La liste des encadrants</span>
        </a>
      </li><!-- End Home Nav -->
      <li class="nav-item">
        <a class="nav-link " href="cheffiliere_admin.php">
          <i class="bi bi-grid"></i>
          <span>La liste des chefs de filière</span>
        </a>
      </li><!-- End Home Nav -->
      <li class="nav-item">
        <a class="nav-link " href="jurys_admin.php">
          <i class="bi bi-grid"></i>
          <span>La liste des jurys</span>
        </a>
      </li><!-- End Home Nav -->
    </ul>

  </aside><!-- End Sidebar-->

      <main id="main" class="main">

        <div class="pagetitle">
          <h1></h1>
        </div><!-- End Page Title -->
    
        <section class="section">
          <div class="row">
            <div class="col-lg-12">
    
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Table des encadrants</h5>
                  <!-- Table with stripped rows -->
                  <form action="" method="post">
                  <table class="table">
                    
                    <thead>
                      <tr>
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">Email</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody>
    <?php 
    while($row=$stmt->fetch(PDO::FETCH_ASSOC))
  {
   ?>
    
     <tr>
     <td><?php echo $row['nom']; ?></td>
     <td><?php echo $row['prenom']; ?></td>
     <td><?php echo $row['email']; ?></td>      
     <td>
     <a href="valider_encadrant.php?id=<?php echo ($row['idEncadrant']);?> " ><button class="btn btn-primary" name="decider" type="button">Valider</button></a>

     </td>
     <td>
     <a href="nonvalider_encadrant.php?id=<?php echo ($row['idEncadrant']);?> " ><button class="btn btn-primary" name="decider" type="button">Non valider</button></a>

     </td>
    
    </tr>  
 
                   
              <?php 

                 
                  
                    
                    } 
                     
                     
                     
                     ?>

                 </tbody>
                  
       
                
                  </table>
                  </form>
                 <!--br><button class="btn btn-info" name="enregistrer" type="submit">Enregistrer</button-->
               
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