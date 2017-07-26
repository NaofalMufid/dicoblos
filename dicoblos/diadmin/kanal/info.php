<?php //dicoblos/diadmin/kanal/info.php
 session_start();
$ctrl = new Dicoblos();
$mdl = new Info();
$lib = new Paging();

//Tampil,cari & paging 
$batas = 5;
$posisi = $lib->cariPosisi($batas);
$arrayInf = $ctrl->TampilData('waktu', 'info', $posisi, $batas);

//Cari
if($_POST['do']=='find'){
    $arrayInf = $ctrl->CariData('judul', $_POST['keyword'], 'info');
}
?>
    <h3 class="page-header"><span class="glyphicon glyphicon-info-sign"></span> Info</h3>
    <!--Tambah Data Info-->
    <div class="col-sm-6 col-md-12">
        
    <?php if($_GET['kanal']=='info' && $_GET['aksi']=='tambah'){?>    
        
    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="glyphicon glyphicon-plus-sign"></span>&nbsp;&nbsp;Tambah Data Info
        </div>
        <div class="panel-body">
            <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                <div class="form-group form-group-sm">
                    <label for="judul" class="col-sm-2">Judul :</label>
                    <div class="col-sm-5">
                        <input type="text" name="jdl" class="form-control input-sm">
                    </div>
                </div> 
                <div class="form-group form-group-sm">
                    <label for="isi" class="col-sm-2">Isi :</label>
                    <div class="col-sm-5">
                        <textarea name="isi" class="form-control input-sm editor"></textarea>
                    </div>
                </div> 
                <div class="form-group form-group-sm">
                    <label for="foto" class="col-sm-2">Foto :</label>
                    <div class="col-sm-4">
                        <input type="file" name="foto" class="form-control input-sm">
                    </div>
                </div>
                <div class="col-sm-2 col-sm-offset-2">
                    <input type="submit" name="simpan" value=" Simpan " class="btn btn-primary btn-sm" data-id="1" /> 
                </div>
            </form>
        </div>
    </div>
        
    <!--Edit Data Info-->
    <?php 
    }elseif ($_GET['kanal']=='info' && $_GET['aksi']=='edit') {
        $id = base64_decode($_GET['id']);
    ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="glyphicon glyphicon-cog"></span>&nbsp;&nbsp;Edit Data Info
        </div>
        <div class="panel-body">
            <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" class="form-control input-sm" value="<?php echo "$id"; ?>"/>
                <div class="form-group form-group-sm">
                    <label for="judul" class="col-sm-2">Judul :</label>
                    <div class="col-sm-5">
                        <input type="text" name="jdl" class="form-control input-sm" value="<?php echo $mdl->GetIn('judul', $id); ?>"/>
                    </div>
                </div> 
                <div class="form-group form-group-sm">
                    <label for="isi" class="col-sm-2">Isi :</label>
                    <div class="col-sm-5">
                        <textarea name="isi" class="form-control input-sm editor"><?php echo $mdl->GetIn('isi', $id); ?></textarea>
                    </div>
                </div> 
                <div class="form-group form-group-sm">
                    <label for="foto" class="col-sm-2">Foto :</label>
                    <div class="col-sm-4">
                        <div class="item">
                            <img src="assets/upload/<?php echo $mdl->GetIn('foto', $id); ?>" width="100" class="img-responsive">
                        </div>
                        <input type="file" name="foto" class="form-control input-sm">
                    </div>
                </div>
                <div class="col-sm-2 col-sm-offset-2">
                <input type="submit" name="update" value=" Update "  class="btn btn-primary btn-sm"/> 
                </div>
            </form>
        </div>
    </div>    
    <?php }else{ ?>
        
    <!--Tampil Data Info-->
    <div class="row col-sm-8 col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading"><span class="glyphicon glyphicon-info-sign"></span> Data Info</div>
            <div class="panel-body">
                <p><a href="?kanal=info&aksi=tambah" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-plus-sign"></span> Tambah Data</a></p>
                <div class="table-responsive">
                    <table class="table table-striped table-condensed table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Waktu</th>
                                <th>Gambar</th>
                                <th>Judul</th>
                                <th>Pengirim</th>
                                <th>Isi</th>
                                <th colspan="2">Aksi</th>
                            </tr>
                        </thead>
                    <?php
                    if(count($arrayInf)){
                        $no = $posisi+1;
                        foreach ($arrayInf as $data){
                            $id = base64_encode($data['id_info']);
                            $jdl = substr($data['judul'], 0,20);
                            $isi = substr($data['isi'], 0,30);
                            echo "<tbody>
                                <tr>
                                    <td>$no.</td>
                                    <td>$data[waktu]</td>
                                    <td><img src='assets/upload/$data[foto]' width='50'></td>
                                    <td>$jdl...</td>
                                    <td>$data[pengirim]</td>
                                    <td>$isi...</td>
                                    <td>
                                        <a href='?kanal=info&aksi=edit&id=$id' class='tip' data-toggle='tooltip' data-placement='bottom' title='Edit data'><i class='glyphicon glyphicon-cog'></i></a> 
                                    </td>
                                    <td>
                                        <a href='?kanal=info&aksi=hapus&id=$id' class='tip' data-toggle='tooltip' data-placement='bottom' title='Hapus data'><i class='glyphicon glyphicon-trash'></i></a> 
                                    </td>
                                </tr>
                            </tbody>";
                        $no++;    
                        }
                    }else{
                        echo"<div class='row col-sm-6 col-md-6'>"
                                . "<div class='alert alert-warning'>"
                                    . "<p>Data tidak ditemukan</p>"
                                . "</div>"
                            . "</div>";
                    } 
                        echo"</table>";
                    //Paging Halaman
                        $jml_data = $lib->Jml_data('info');
                        $jml_hal = $lib->jumlahHalaman($jml_data, $batas);
                        $link_hal = $lib->navHalaman($_GET['halaman'], $jml_hal);
                        echo"<div class='pager pager-sm'>"
                                    . "<ul>"
                                        . "<li>$link_hal</li>"
                                    . "</ul>"
                            . "</div>";
                    ?>
                </div>
            </div>
        </div>
    </div>
    
    <?php }
    //Menambah Data
    if (isset($_POST['simpan'])) {
        $jdl = $_POST['jdl'];
        $isi = $_POST['isi'];
        $pgr = $_SESSION['asma'];
        
        $foto = $_FILES['foto']['name'];
        $tmp = $_FILES['foto']['tmp_name'];
        $dir = "assets/upload";
        
        //Upload foto
        $ctrl->UploadFoto($foto, $tmp, $dir);
        
        $tbh = $mdl->TambahInf($jdl, $isi, $foto, $pgr);
            if($tbh == "Yes"){    
                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=?kanal=info">';
            }
        
    }
    //Mengupdate data    
    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $jdl = $_POST['jdl'];
        $isi = $_POST['isi'];
        
        $foto = $_FILES['foto']['name'];
        $tmp = $_FILES['foto']['tmp_name'];
        $dir = "assets/upload";
        
        $ctrl->UploadFoto($foto, $tmp, $dir);
        
        $edt = $mdl->EditInf($id, $jdl, $isi, $foto);
            if($edt == "Yes"){    
                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=?kanal=info">';
            }
    
    }
    //Menghapus Data    
    if ($_GET['kanal']=='info' && $_GET['aksi']=='hapus') {
        $id = base64_decode($_GET['id']);
        $hps = $mdl->HapusIn($id);
        if($hps == "Yes"){    
                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=?kanal=info">';
        }
    }
    ?>
    </div>
