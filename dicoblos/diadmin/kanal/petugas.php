<?php //dicoblos/diadmin/kanal/petugas.php
require_once 'core/core.php';
require_once 'core/library.php';
$ctrl = new Dicoblos();
$mdl = new Petugas();
$lib = new Paging();

if (!$ctrl->Login()) {
    header('location:../login.php');
}
//Tampil,cari & paging 
$batas = 5;
$posisi = $lib->cariPosisi($batas);
$arrayPtgs = $ctrl->TampilData('username', 'petugas', $posisi, $batas);

//Cari
if($_POST['do']=='find'){
    $arrayPtgs = $ctrl->CariData('username', $_POST['keyword'], 'petugas');
}
?>
    <h3 class="page-header"><span class="glyphicon glyphicon-lock"></span>Petugas</h3>
    <!--Tambah Data Petugas-->
    <div class="col-sm-8 col-md-12">
    <?php if($_GET['kanal']=='petugas' && $_GET['aksi']=='tambah'){?>    
    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="glyphicon glyphicon-plus-sign"></span>&nbsp;&nbsp;Tambah Data Petugas
        </div>
        <div class="panel-body">
            <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                <div class="form-group form-group-sm">
                    <label for="nik" class="col-sm-2">NIK :</label>
                    <div class="col-sm-3">
                        <input type="number" name="nik" class="form-control input-sm">
                    </div>
                </div> 
                <div class="form-group form-group-sm">
                    <label for="user" class="col-sm-2">Username :</label>
                    <div class="col-sm-3">
                        <input type="text" name="user" class="form-control input-sm">
                    </div>
                </div> 
                <div class="form-group form-group-sm">
                    <label for="nama" class="col-sm-2">Nama :</label>
                    <div class="col-sm-4">
                        <input type="text" name="nama" class="form-control input-sm">
                    </div>
                </div> 
                <div class="form-group form-group-sm">
                    <label for="alamat" class="col-sm-2">Alamat :</label>
                    <div class="col-sm-5">
                        <textarea name="almt" class="form-control input-sm"></textarea>
                    </div>
                </div> 
                <div class="form-group form-group-sm">
                    <label for="gender" class="col-sm-2">Gender :</label>
                    <div class="col-sm-2">
                        <select name="jk" class="form-control input-sm">
                            <option value="Pria">Pria</option>
                            <option value="Wanita">Wanita</option>
                        </select>
                    </div>
                </div> 
                <div class="form-group form-group-sm">
                    <label for="level" class="col-sm-2">Level :</label>
                    <div class="col-sm-3">
                        <select name="lvl" class="form-control input-sm">
                            <option value="Admin">Admin</option>
                            <option value="Super Admin">Super Admin</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-2 col-sm-offset-2">
                    <input type="submit" name="simpan" value=" Simpan " class="btn btn-primary btn-sm" data-id="1" /> 
                </div>
            </form>
        </div>
    </div>
        
    <!--Edit Data Petugas-->
    <?php 
    }elseif ($_GET['kanal']=='petugas' && $_GET['aksi']=='edit') {
        $id = base64_decode($_GET['id']);
    ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="glyphicon glyphicon-cog"></span>&nbsp;&nbsp;Edit Data Petugas
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
                    <label for="user" class="col-sm-2">Username :</label>
                    <div class="col-sm-3">
                        <input type="text" name="user" class="form-control input-sm" value="<?php echo $mdl->GetPt('username', $id); ?>"/>
                    </div>
                </div> 
                <div class="form-group form-group-sm">
                    <label for="password" class="col-sm-2">Password :</label>
                    <div class="col-sm-4">
                        <input type="password" name="pswd" class="form-control input-sm" value="<?php echo $mdl->GetPt('password', $id); ?>"/>
                    </div>
                </div> 
                <div class="form-group form-group-sm">
                    <label for="nama" class="col-sm-2">Nama :</label>
                    <div class="col-sm-4">
                        <input type="text" name="nama" class="form-control input-sm" value="<?php echo $mdl->GetPt('nama', $id); ?>"/>
                    </div>
                </div> 
                <div class="form-group form-group-sm">
                    <label for="alamat" class="col-sm-2">Alamat :</label>
                    <div class="col-sm-5">
                        <textarea name="almt" class="form-control input-sm"><?php echo $mdl->GetPt('alamat', $id); ?></textarea>
                    </div>
                </div> 
                <div class="form-group form-group-sm">
                    <label for="gender" class="col-sm-2">Gender :</label>
                    <div class="col-sm-2">
                        <select name="jk" class="form-control input-sm">
                        <?php
                        $gnd = $mdl->GetPt('jk', $id);
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
                    <label for="level" class="col-sm-2">Level :</label>
                    <div class="col-sm-3">
                        <select name="lvl" class="form-control input-sm">
                        <?php
                        $level = $mdl->GetPt('level', $id);
                        if($level == 'Admin'){
                            echo "<option value='Admin' selected>Admin</option>
                                <option value='Super Admin'>Super Admin</option>";
                        }else{
                            echo "<option value='Admin'>Admin</option>
                                <option value='Super Admin' selected>Super Admin</option>";
                        }    
                        ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-2 col-sm-offset-2">
                    <input type="submit" name="update" value=" Update " class="btn btn-primary btn-sm"/> 
                </div>
            </form>
        </div>
    </div>    
    <?php }else{ ?>
        
    <!--Tampil Data Petugas-->
    <div class="row col-sm-8 col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading"><span class="glyphicon glyphicon-lock"></span> Data Petugas</div>
            <div class="panel-body">
                <p><a href="?kanal=petugas&aksi=tambah" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-plus-sign"></span> Tambah Data</a></p>
                <div class="table-responsive">
                    <table class="table table-striped table-condensed table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>username</th>
                                <th colspan="2">Aksi</th>
                            </tr>
                        </thead>
                    <?php
                    if(count($arrayPtgs)){
                        $no = $posisi+1;
                        foreach ($arrayPtgs as $data){
                            $id = base64_encode($data['nik']);
                            echo "<tbody>
                                <tr>
                                    <td>$no.</td>
                                    <td>$data[nik]</td>
                                    <td>$data[nama]</td>
                                    <td>$data[alamat]</td>
                                    <td>$data[username]</td>
                                    <td>
                                        <a href='?kanal=petugas&aksi=edit&id=$id' class='tip' data-toggle='tooltip' data-placement='bottom' title='Edit data'><i class='glyphicon glyphicon-cog'></i></a> 
                                    </td>
                                    <td>        
                                        <a href='?kanal=petugas&aksi=hapus&id=$id' class='tip' data-toggle='tooltip' data-placement='bottom' title='Hapus data'><i class='glyphicon glyphicon-trash'></i></a> 
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
                        $jml_data = $lib->Jml_data('petugas');
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
        $usr = $_POST['user'];
        $nm = $_POST['nama'];
        $almt = $_POST['almt'];
        $jk = $_POST['jk'];
        $lvl = $_POST['lvl'];
        
        $tbh = $mdl->TambahPt($nik, $usr, $nm, $almt, $jk, $lvl);
        if($tbh == "Yes"){
                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=?kanal=petugas">';
            }
    }
    
    //Mengupdate data    
    if (isset ($_POST['update'])) {
        $id = $_POST['nik'];
        $usr = $_POST['user'];
        $pswd = $_POST['pswd'];
        $nm = $_POST['nama'];
        $almt = $_POST['almt'];
        $jk = $_POST['jk'];
        $lvl = $_POST['lvl'];

        $edt = $mdl->EditPt($id, $usr, $pswd, $nm, $almt, $jk, $lvl);
        if($edt == "Yes"){
                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=?kanal=petugas">';
        }
    }
    
    //Menghapus Data    
    if ($_GET['kanal']=='petugas' && $_GET['aksi']=='hapus') {
        $id = base64_decode($_GET['id']);
        $hps = $mdl->HapusPt($id);
        if($hps == "Yes"){
                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=?kanal=petugas">';
        }
    }
    ?>
    </div>
