<?php
session_start();
error_reporting(0);
require_once 'core/core.php';
require_once 'core/library.php';
require_once 'kanal/kanal.php';
$core = new Dicoblos();

if (!$core->Login()) {
    header('location:login.php');
}

if($_GET['aksi']=='logout'){
    $core->Logout();
    header('location:login.php');
}
?>
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="assets/images/logos.png" type="image/x-icon">

    <title>:: DiCoblos Administrator ::</title>

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/dashboard.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Menu</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php"><i class="glyphicon glyphicon-pushpin"></i> DiCoblos</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="index.php"><i class="glyphicon glyphicon-th-large"></i> Dashboard</a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    <i class="glyphicon glyphicon-user"></i> <?php echo $_SESSION['asma']?></a>
                <ul class="dropdown-menu">
                    <li><a href="?kanal=profil&id=<?php echo base64_encode($_SESSION['seje']);?>"><i class="glyphicon glyphicon-user"></i> My Account</a></li>
                    <li><a href="?aksi=logout"><i class="glyphicon glyphicon-off"></i> Keluar</a></li>
                </ul>
            </li>
          </ul>
            <form class="navbar-form navbar-right" method="POST" name="cari" action="<?php echo "$_SERVER[PHP_SELF]?kanal=$_GET[kanal]";?>">
                <input type="hidden" name="do" value="find">
                <input type="text" class="form-control" name="keyword" placeholder="Search...">
          </form>
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li><a href="index.php"><i class="glyphicon glyphicon-th-large"></i> Dashboard</a></li>
            <?php echo Menu();?>
          </ul>
            
          <!--Footer-->
          <div class="">
              <p>&COPY; <?php echo date("Y"); ?> Wangan Aji</p>
              <p>All Right Reserved</p>
          </div>
          <!--End-->
        </div>
          
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <?php
          if(isset($_GET['kanal'])){
              echo Page();
          }else{
          ?>  
          <!--Home Page Administrator-->  
          <h1 class="page-header">Dashboard</h1>
          <div class="row placeholders">
            <div class="col-xs-6 col-sm-3 placeholder">
                <img src="assets/images/1.png" width="200" height="200" class="img-responsive img-circle" alt="Generic placeholder thumbnail">
              <h4>Beasiswa</h4>
              <span class="text-muted">Dapatkan beasiswamu</span>
            </div>
          </div>
          <h2 class="sub-header"><?php //echo "Hallo <i>".$_SESSION['nama']."</i>" ?></h2>
          <div class="table-responsive">
              <?php //echo InfoDash();?>
          </div>
          <?php }?>
          <!--End-->
        </div>
      </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/tinymce/tinymce.min.js"></script>
        <script type="text/javascript" charset="utf-8"> 
                $(document).ready(function(){
                        $(".tip").tooltip();
                });
        </script>
        <script type="text/javascript">
            tinymce.init({
                selector: ".editor"
            });
        </script>
    </body>
</html>


