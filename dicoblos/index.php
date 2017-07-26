<?php
    //error_reporting(0);
    require_once 'diadmin/core/core.php';
    require_once 'diadmin/core/library.php';
              
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="diadmin/assets/images/logos.png">

    <title>Dicoblos</title>

    <!-- Bootstrap core CSS -->
    <link href="diadmin/assets/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom styles for this template -->
    <link href="diadmin/assets/css/cover.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="site-wrapper">

      <div class="site-wrapper-inner">

        <div class="cover-container">

          <div class="masthead clearfix">
            <div class="inner">
                <a href="index.php"><h3 class="masthead-brand"><img src="diadmin/assets/images/logos.png" width="30" height="30"> DiCoblos</h3></a>
              <nav>
                <ul class="nav masthead-nav">
                    <li><a href="index.php">Home</a></li>
                  <li><a href="about.html">About</a></li>
                  <li><a href="contact.html">Contact</a></li>
                </ul>
              </nav>
            </div>
          </div>
          <?php
          if(isset($_GET['kanal'])){
              require_once 'kanal/kanal.php';
          }else{
          ?>  
          <div class="inner cover"> 
            <div class="col-xs-6 col-sm-4">
                <a href="?kanal=coblos" class="tip" data-toggle="tooltip" data-placement="bottom" title="Klik untuk mulai Pemilu">
                  <img src="diadmin/assets/images/coblos.png" width="200" height="200" class="img-responsive img-circle" alt="Generic placeholder thumbnail">
                  <h4>Nyoblos</h4>
              </a>
            </div>
            <div class="col-xs-6 col-sm-4">
                <a href="?kanal=kandidat" class="tip" data-toggle="tooltip" data-placement="bottom" title="Melihat profil tentang kandidat">
                    <img src="diadmin/assets/images/calon.png" width="200" height="200" class="img-responsive img-circle" alt="Generic placeholder thumbnail">
                    <h4>Kandidat</h4>
                </a>
            </div>
            <div class="col-xs-6 col-sm-4">
                <a href="?kanal=pemilih" class="tip" data-toggle="tooltip"  data-placement="bottom"  title="Daftar Pemilih Tetap terdaftar">
                    <img src="diadmin/assets/images/pemilih.png" width="200" height="200" class="img-responsive img-circle" alt="Generic placeholder thumbnail">
                    <h4>Pemilih</h4>
                </a>
            </div>
            <div class="col-xs-6 col-sm-4">
              <a href="?kanal=qc" class="tip" data-toggle="tooltip"  data-placement="top"  title="Melihat hasil sementara Pemilu">
                  <img src="diadmin/assets/images/cepat.png" width="200" height="200" class="img-responsive img-circle" alt="Generic placeholder thumbnail">
                  <h4>Quick Count</h4>
              </a>
            </div>
            <div class="col-xs-6 col-sm-4">
                <a href="?kanal=info" class="tip" data-toggle="tooltip"  data-placement="top"  title="Info-info seputar Pemilu">
                    <img src="diadmin/assets/images/info.png" width="200" height="200" class="img-responsive img-circle" alt="Generic placeholder thumbnail">
                    <h4>Info</h4>
                </a>
            </div>
            <div class="col-xs-6 col-sm-4">
                <a href="?kanal=panduan" class="tip" data-toggle="tooltip"  data-placement="top"  title="Panduan untuk melakukan Pemilu">
                    <img src="diadmin/assets/images/panduan.png" width="200" height="200" class="img-responsive img-circle" alt="Generic placeholder thumbnail">
                    <h4>Panduan</h4>
                </a>
            </div>    
          </div>
          <?php
          }
          ?>  
        </div>
      </div>
    </div>
    <footer class="mastfoot">
        <div class="inner">
            <p>&COPY; 2016 Wangan Aji - All Right Reserved</p>
        </div>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="diadmin/assets/js/jquery.min.js"></script>
    <script src="diadmin/assets/js/bootstrap.min.js"></script>
        <script type="text/javascript" charset="utf-8"> 
                $(document).ready(function(){
                        $(".tip").tooltip();
                });
        </script>
  </body>
</html>
