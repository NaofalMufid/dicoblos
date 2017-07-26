<?php
session_start();
$core = new Dicoblos();
$pml = new Pemilih();
$kdt = new Kandidat();
$cbl = new Coblos();

//Jika belum login
if(!$pml->Masuk()){
    header('location:index.php?kanal=auth');

}

//tes
if($_GET['kanal']=='coblos' and $_GET['aksi']=='out'){
    $pml->Keluar();
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=?kanal=auth">';
}

$calon = $cbl->Calon($_SESSION['mlh']);
$jdl = $cbl->GetCb('judul', $_SESSION['mlh']);
?>
    <div class="page-header">
            <h3><?php echo $jdl;?></h3>
    </div>
    <div class="inner cover">
        <?php
            foreach ($calon as $data){
                $wakil = $data['nama2'];
                $id = base64_encode($data['id_kandidat']);
                echo"<div class='col-xs-6 col-sm-4'>
                        <ul class='list-group'>
                            <li class='list-group-item'><h4>$data[no_urut]</h4></li>
                            <a href='?kanal=proses&aksi=pilih&id=$id'  class='tip' data-toggle='tooltip' data-placement='top' title='Klik gambar untuk memberi suara'>";
                if(!empty($wakil)){
                    echo"<li class='list-group-item'>
                            <img src='diadmin/assets/upload/$data[foto]' class='img-responsive img-thumbnail' width='100' >
                        </li>    
                        <li class='list-group-item'>
                            <p>$data[nama] - $data[nama2]</p
                            <p>$data[partai] - $data[partai2]</p>
                        </li>";
                }else{
                    echo"<li class='list-group-item'>
                            <img src='diadmin/assets/upload/$data[foto]' class='img-responsive img-thumbnail' width='100' >
                        </li>    
                        <li class='list-group-item'>
                            <p>$data[nama]</p
                            <p>$data[partai]</p>
                        </li>";
                }
                echo "</a></ul></div>";
            }
        ?>
    </div>
    <div class="nav navbar-static-bottom">
        <p class="lead"><a href="?kanal=coblos&aksi=out">Out</a></p>
    </div>