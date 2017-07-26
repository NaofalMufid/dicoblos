<?php //dicoblos/diadmin/kanal/coblos.php
$ctrl = new Dicoblos();
$mdl = new Coblos();
$lib = new Paging();

//Tampil,cari & paging 
$batas = 5;
$posisi = $lib->cariPosisi($batas);
$arrayCb = $ctrl->TampilData('judul', 'coblos', $posisi, $batas);

//Cari
if($_POST['do']=='find'){
    $arrayCb = $ctrl->CariData('judul', $_POST['keyword'], 'coblos');
}
?>
    <h3 class="page-header"><span class="glyphicon glyphicon-pushpin"></span> Pemilu</h3>
    
    <!--Tambah Data Pemilu-->
    <div class="col-sm-8 col-md-12">
        
    <?php if($_GET['kanal']=='coblos' && $_GET['aksi']=='tambah'){?>    
    
    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="glyphicon glyphicon-plus-sign"></span>&nbsp;&nbsp;Tambah Data Pemilu
        </div>
        <div class="panel-body">
            <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                <div class="form-group form-group-sm">
                    <label for="kategori" class="col-sm-2">Judul :</label>
                    <div class="col-sm-4">
                        <input type="text" name="jdl" class="form-control input-sm">
                    </div>    
                </div>
                <div class="form-group form-group-sm">
                    <label for="awl" class="col-sm-2">Mulai</label>
                    <div class="col-sm-3">
                        <input type="datetime" name="mulai" class="form-control input-sm">
                    </div>
                </div> 
                <div class="form-group form-group-sm">
                    <label for="akh" class="col-sm-2">Selesai :</label>
                    <div class="col-sm-3">
                        <input type="datetime" name="slsi" class="form-control input-sm">
                    </div>
                </div>
                <div class="col-sm-2 col-sm-offset-2">
                    <input type="submit" name="simpan" value=" Simpan " class="btn btn-primary btn-sm" data-id="1" />
                </div>
            </form>
        </div>
    </div>
        
    <!--Edit Data Pemilu-->
    <?php 
    }elseif ($_GET['kanal']=='coblos' && $_GET['aksi']=='edit') {
        $id = base64_decode($_GET['id']);
    ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="glyphicon glyphicon-cog"></span>&nbsp;&nbsp;Edit Data Pemilu
        </div>
        <div class="panel-body">
            <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $id;?>">
                <div class="form-group form-group-sm">
                    <label for="kategori" class="col-sm-2">Judul :</label>
                    <div class="col-sm-4">
                        <input type="text" name="jdl"class="form-control input-sm" value="<?php echo $mdl->GetCb('judul', $id)?>">
                    </div>    
                </div>
                <div class="form-group form-group-sm">
                    <label for="awl" class="col-sm-2">Mulai</label>
                    <div class="col-sm-3">
                        <input type="datetime" name="mulai" class="form-control input-sm" value="<?php echo $mdl->GetCb('awal', $id);?>">
                    </div>
                </div> 
                <div class="form-group form-group-sm">
                    <label for="akh" class="col-sm-2">Selesai :</label>
                    <div class="col-sm-3">
                        <input type="datetime" name="slsi" class="form-control input-sm" value="<?php echo $mdl->GetCb('akhir', $id);?>">
                    </div>
                </div> 
                <div class="col-sm-2 col-sm-offset-2">
                    <input type="submit" name="update" value=" Update " class="btn btn-primary btn-sm"/>
                </div>
            </form>
        </div>
    </div>    
    <?php }else{?>
        
    <!--Tampil Data Pemilu-->
    <div class="row col-sm-8 col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading"><span class="glyphicon glyphicon-pushpin"></span> Data Pemilu</div>
            <div class="panel-body">
                <p><a href="?kanal=coblos&aksi=tambah" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-plus-sign"></span> Tambah Data</a></p>
                <div class="table-responsive">
                    <table class="table table-striped table-condensed table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Judul</th>
                                <th>Waktu</th>
                                <th>Aktif</th>
                                <th colspan="2">Aksi</th>
                            </tr>
                        </thead>
                    <?php
                    if(count($arrayCb)){
                        $no = $posisi+1;
                        foreach ($arrayCb as $data){
                            $id = base64_encode($data['id_coblos']);
                            echo "<tbody>
                                <tr>
                                    <td>$no.</td>
                                    <td>$data[judul]</td>
                                    <td>$data[awal] - $data[akhir]</td>
                                    <td>$data[aktif]</td>
                                    <td>
                                        <a href='?kanal=coblos&aksi=edit&id=$id' class='tip' data-toggle='tooltip' data-placement='bottom' title='Edit data'><i class='glyphicon glyphicon-cog'></i></a> 
                                    </td>
                                    <td>
                                        <a href='?kanal=coblos&aksi=hapus&id=$id' class='tip' data-toggle='tooltip' data-placement='bottom' title='Hapus data'><i class='glyphicon glyphicon-trash'></i></a> 
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
                        $jml_data = $lib->Jml_data('coblos');
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
        $mli = $_POST['mulai'];
        $slsi = $_POST['slsi'];
        
        $tbh = $mdl->TambahCb($jdl, $mli, $slsi);
        if($tbh == "Yes"){
                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=?kanal=coblos">';
        }
    }
    
    //Mengupdate data    
    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $jdl = $_POST['jdl'];
        $mli = $_POST['mulai'];
        $slsi = $_POST['slsi'];
        
        $edt = $mdl->EditCb($id, $jdl, $mli, $slsi);
        if($edt == "Yes"){
                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=?kanal=coblos">';
        }
    //Menghapus Data    
    }elseif ($_GET['kanal']=='coblos' && $_GET['aksi']=='hapus') {
        $id = base64_decode($_GET['id']);
        $hps = $mdl->HapusCb($id);
        if($hps == "Yes"){
                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=?kanal=coblos">';
        }
    }
    ?>
    </div>
