<?php //dicoblos/diadmin/kanal/pemilih.php
$ctrl = new Dicoblos();
$mdl = new Pemilih();
$cbl = new Coblos();
$lib = new Paging();

//Tempil,cari & paging 
$batas = 10;
$posisi = $lib->cariPosisi($batas);
$arrayPm = $ctrl->TampilData('id_coblos', 'pemilih', $posisi, $batas);

//Pencarian
if($_POST['pml']){
    $arrayPm = $ctrl->CariData('id_coblos', $_POST['pml'], 'pemilih');
    
}else if($_POST['do']=='find'){
    $arrayPm = $ctrl->CariData('nama', $_POST['keyword'], 'pemilih');
}
?>
    <h3 class="page-header"><span class="glyphicon glyphicon-user"></span> Pemilih</h3>
    <!--Tambah Data Pemilih-->
    <div class="row col-sm-6 col-md-12">
        
    <?php if($_GET['kanal']=='pemilih' && $_GET['aksi']=='tambah'){ ?>    
        
    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="glyphicon glyphicon-plus-sign"></span>&nbsp;&nbsp;Tambah Data Pemilih
        </div>
        <div class="panel-body">
            <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                <div class="form-group form-group-sm">
                    <label for="nik" class="col-sm-2">NIK :</label>
                    <div class="col-sm-3">
                        <input type="number" name="nik" class="form-control input-sm"/>
                    </div>
                </div> 
                <div class="form-group form-group-sm">
                    <label for="nama" class="col-sm-2">Nama :</label>
                    <div class="col-sm-4">
                        <input type="text" name="nama" class="form-control input-sm"/>
                    </div>
                </div> 
                <div class="form-group form-group-sm">
                    <label for="tgl" class="col-sm-2">Tgl. Lahir :</label>
                    <div class="col-sm-3">
                        <input type="date" name="tgl" class="form-control input-sm"/>*YYYY-MM-DD
                    </div>
                </div> 
                <div class="form-group form-group-sm">
                    <label for="gender" class="col-sm-2">Gender :</label>
                    <div class="col-sm-2">
                        <select name="jk" class="form-control input-sm">
                        <option value='Pria'>Pria</option>
                        <option value='Wanita'>Wanita</option>";
                        </select>
                    </div>
                </div> 
                <div class="form-group form-group-sm">
                    <label for="almt" class="col-sm-2">Alamat :</label>
                    <div class="col-sm-5">
                        <textarea name="almt" class="form-control input-sm"></textarea>
                    </div>
                </div>
                <div class="form-group form-group-sm">
                    <label for="pemilu" class="col-sm-2">Pemilu :</label>
                    <div class="col-sm-4">
                        <select name="pml" class="form-control input-sm">
                            <?php
                            $cbl = $ctrl->ComboId('id_coblos', 'judul', 'coblos');
                            foreach ($cbl as $data){
                                    echo "<option value='$data[id_coblos]'>$data[judul]</option>";
                            }
                            ?>
                        </select>
                    </div>    
                </div>
                <div class="col-sm-2 col-sm-offset-2">
                    <input type="submit" value=" Simpan " name="simpan" class="btn btn-primary btn-sm" data-id="1" />
                </div>
            </form-->
        </div>
    </div>
        
    <!--Edit Data Petugas-->
    <?php 
        }elseif ($_GET['kanal']=='pemilih' && $_GET['aksi']=='edit') {
        $id = base64_decode($_GET['id']);
    ?>
    
    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="glyphicon glyphicon-cog"></span>&nbsp;&nbsp;Edit Data Pemilih
        </div>
        <div class="panel-body">
            <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                <div class="form-group form-group-sm">
                    <label for="nik" class="col-sm-2">NIK :</label>
                    <div class="col-sm-3">
                        <input type="number" name="nik" class="form-control input-sm" readonly="readonly" value="<?php echo "$id"; ?>"/>
                    </div>
                </div> 
                <div class="form-group form-group-sm">
                    <label for="nama" class="col-sm-2">Nama :</label>
                    <div class="col-sm-4">
                        <input type="text" name="nama" class="form-control input-sm" value="<?php echo $mdl->GetPm('nama', $id); ?>"/>
                    </div>
                </div> 
                <div class="form-group form-group-sm">
                    <label for="tgl" class="col-sm-2">Tgl. Lahir :</label>
                    <div class="col-sm-3">
                        <input type="date" name="tgl" class="form-control input-sm" value="<?php echo $mdl->GetPm('tgl_lahir', $id); ?>"/>*YYYY-MM-DD
                    </div>
                </div> 
                <div class="form-group form-group-sm">
                    <label for="gender" class="col-sm-2">Gender :</label>
                    <div class="col-sm-2">
                        <select name="jk" class="form-control input-sm">
                        <?php
                        $gnd = $mdl->GetPm('jk', $id);
                        if($gnd == 'Pria'){
                            echo "<option value='Pria' selected>Pria</option>
                                <option value='Wanita'>Wanita</option>";
                        }else{
                            echo "<option value='Pria'>Pria</option>
                                <option value='Wanita' selected>Wanita</option>";
                        }    
                        ?>
                        </select>
                    </div>
                </div> 
                <div class="form-group form-group-sm">
                    <label for="alamat" class="col-sm-2">Alamat :</label>
                    <div class="col-sm-5">
                        <textarea name="almt" class="form-control input-sm"><?php echo $mdl->GetPm('alamat', $id); ?></textarea>
                    </div>
                </div>
                <div class="form-group form-group-sm">
                    <label for="kategori" class="col-sm-2">Pemilu :</label>
                    <div class="col-sm-4">
                        <select name="pml" class="form-control input-x">
                            <?php
                            $idb = $mdl->GetPm('id_coblos', $id);
                            $cbl = $ctrl->ComboId('id_coblos', 'judul', 'coblos');
                            foreach ($cbl as $data){
                                if($idb == $data['id_coblos'])
                                    echo "<option value='$data[id_coblos]' selected>$data[judul]</option>";
                                else
                                    echo "<option value='$data[id_coblos]'>$data[judul]</option>";
                            }
                            ?>
                        </select> 
                    </div>    
                </div> 
                <div class="col-sm-2 col-sm-offset-2">
                    <input type="submit" value=" Update " name="update" class="btn btn-primary btn-sm"/>
                </div>
            </form>
        </div>
    </div>
    
    <?php }else{ ?>
    
    </div>
        <!--Tampil Data pemilih-->
    <div class="row col-sm-6 col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading"><span class="glyphicon glyphicon-user"></span> Data Pemilih</div>
            <div class="panel-body">
            <div class="form-group form-inline">
                <form method="POST" action="" id="form1">
                    <a href="?kanal=pemilih&aksi=tambah" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-plus-sign"></i> Tambah</a>
                    <select name="pml" id="pml" class="form-control input-sm" onchange="document.getElementById('form1').submit()">
                            <option selected>Pemilu</option>
                            <option value="">Semua</option>
                            <?php
                            $pml = $ctrl->ComboId('id_coblos', 'judul', 'coblos');
                            foreach ($pml as $data){
                                echo "<option value='$data[id_coblos]'>$data[judul]</option>";
                            }
                            ?>
                    </select>
                    <a href="print.php" target="_blank" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-print"></i> Cetak DPT</a>
                </form>
            </div>
                <div class="table-responsive">
                    <table class="table table-striped table-condensed table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Tgl.Lahir</th>
                                <th>Pemilu</th>
                                <th>Aktif</th>
                                <th colspan="2">Aksi</th>
                            </tr>
                        </thead>
                    <?php
                    if(count($arrayPm)){
                        $no = $posisi+1;
                        foreach ($arrayPm as $data){
                            $jdl = $cbl->GetCb('judul', $data['id_coblos']);
                            $id = base64_encode($data['nik']);
                            echo "<tbody>
                                <tr>
                                    <td>$no.</td>
                                    <td>$data[nik]</td>
                                    <td>$data[nama]</td>
                                    <td>$data[tgl_lahir]</td>
                                    <td>$jdl</td>
                                    <td>$data[aktif]</td>
                                    <td>
                                        <a href='?kanal=pemilih&aksi=edit&id=$id' class='tip' data-toggle='tooltip' data-placement='bottom' title='Edit data'><i class='glyphicon glyphicon-cog'></i></a> 
                                    </td>
                                    <td>
                                        <a href='?kanal=pemilih&aksi=hapus&id=$id' class='tip' data-toggle='tooltip' data-placement='bottom' title='Hapus data'><i class='glyphicon glyphicon-trash'></i></a> 
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
                        $jml_data = $lib->Jml_data('pemilih');
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
            $nik = $_POST['nik'];
            $nm = $_POST['nama'];
            $tgl = $_POST['tgl'];
            $jk = $_POST['jk'];
            $almt = $_POST['almt'];
            $pml = $_POST['pml'];
            
            $tbh = $mdl->TambahPm($nik, $nm, $tgl, $jk, $almt, $pml);
            if($tbh == "Yes"){    
                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=?kanal=pemilih">';
            }
    }
    
    //Mengupdate data    
    if (isset($_POST['update'])) {
            $id = $_POST['nik'];
            $nm = $_POST['nama'];
            $tgl = $_POST['tgl'];
            $jk = $_POST['jk'];
            $almt = $_POST['almt'];
            $pml = $_POST['pml'];

            $edt = $mdl->EditPm($id, $nm, $tgl, $jk, $almt, $pml);
            if($edt == "Yes"){    
                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=?kanal=pemilih">';
            }
    //Menghapus Data    
    }
    
    if ($_GET['kanal']== 'pemilih' && $_GET['aksi']=='hapus') {
            $id = base64_decode($_GET['id']);
            $hps = $mdl->HapusPm($id);
            if($hps == "Yes"){
                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=?kanal=pemilih">';
            }
    }
    ?>
    