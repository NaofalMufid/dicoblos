<?php //dicoblos/diadmin/kanal/kontak.php
$ctrl = new Dicoblos();
$mdl = new Kontak();
$lib = new Paging();

//Tampil,cari & paging 
$batas = 5;
$posisi = $lib->cariPosisi($batas);
$arrayKn = $ctrl->TampilData('username', 'kontak', $posisi, $batas);
//Cari
if($_POST['do']=='find'){ 
    $arrayKn = $ctrl->CariData('username', $_POST['keyword'], 'kontak');
}
?>
    <h3 class="page-header"><span class="glyphicon glyphicon-phone-alt"></span> Kontak</h3>
    
    
    <!--Tambah Data Kontak-->
    <div class="col-sm-8 col-md-12">
        
    <?php if($_GET['kanal']=='kontak' && $_GET['aksi']=='tambah'){?>    
        
    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="glyphicon glyphicon-send"></span>&nbsp;&nbsp;Balas Pesan
        </div>
        <div class="panel-body">
            <form class="form-horizontal" action="?kanal=kontak&aksi=insert" method="post" enctype="multipart/form-data">
                <div class="form-group form-group-sm">
                    <label for="nik" class="col-sm-3 control-label">NIK :</label>
                    <div class="col-sm-8">
                        <input type="number" name="nik" class="form-control input-sm">
                    </div>
                </div> 
                <div class="form-group form-group-sm">
                    <label for="user" class="col-sm-3 control-label">Username :</label>
                    <div class="col-sm-8">
                        <input type="text" name="user" class="form-control input-sm">
                    </div>
                </div> 
                <div class="form-group form-group-sm">
                    <label for="nama" class="col-sm-3 control-label">Nama :</label>
                    <div class="col-sm-8">
                        <input type="text" name="nama" class="form-control input-sm">
                    </div>
                </div> 
                <div class="form-group form-group-sm">
                    <label for="alamat" class="col-sm-3 control-label">Alamat :</label>
                    <div class="col-sm-8">
                        <textarea name="almt" class="form-control input-sm"></textarea>
                    </div>
                </div> 
                <div class="form-group form-group-sm">
                    <label for="gender" class="col-sm-3 control-label">Gender :</label>
                    <div class="col-sm-4">
                        <select name="jk" class="form-control input-sm">
                            <option value="Pria">Pria</option>
                            <option value="Wanita">Wanita</option>
                        </select>
                    </div>
                </div> 
                <div class="form-group form-group-sm">
                    <label for="level" class="col-sm-3 control-label">Level :</label>
                    <div class="col-sm-5">
                        <select name="lvl" class="form-control input-sm">
                            <option value="Admin">Admin</option>
                            <option value="Super Admin">Super Admin</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-2 col-sm-offset-3">
                    <input type="submit" value=" Simpan " class="btn btn-primary btn-sm" data-id="1" /> 
                </div>
            </form>
        </div>
    </div>
        
    <?php }else{ ?>
    
    <!--Tampil Data Kontak-->
    <div class="row col-sm-8 col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading"><span class="glyphicon glyphicon-phone-alt"></span> Data Kontak</div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-condensed table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>E-mail</th>
                                <th>Subjek</th>
                                <th colspan="2">Aksi</th>
                            </tr>
                        </thead>
                    <?php
                    if(count($arrayKn)){
                        $no = $posisi+1;
                        foreach ($arrayKn as $data){
                            $id = base64_encode($data['nik']);
                            echo "<tbody>
                                <tr>
                                    <td>$no.</td>
                                    <td>$data[nik]</td>
                                    <td>$data[username]</td>
                                    <td>$data[level]</td>
                                    <td><a href='?kanal=kontak&aksi=balas&id=$id' class='tip' data-toggle='tooltip' data-placement='bottom' title='Balas pesan'><i class='glyphicon glyphicon-envelope'></i></a></td> 
                                    <td><a href='?kanal=kontak&aksi=hapus&id=$id' class='tip' data-toggle='tooltip' data-placement='bottom' title='Hapus pesan'><i class='glyphicon glyphicon-trash'></i></a></td> 
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
                        $jml_data = $lib->Jml_data('kontak');
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
    <?php    
    }
    //Menambah Data
    if ($_GET['kanal']=='kontak' && $_GET['aksi']=='insert') {
        $nik = $_POST['nik'];
        $usr = $_POST['user'];
        $nm = $_POST['nama'];
        $almt = $_POST['almt'];
        $jk = $_POST['jk'];
        $lvl = $_POST['lvl'];
        
        $mdl->TambahKn($nik, $usr, $nm, $almt, $jk, $lvl);
        
    //Menghapus Data    
    }elseif ($_GET['kanal']=='kontak' && $_GET['aksi']=='hapus') {
        $id = base64_decode($_GET['id']);
        $mdl->HapusKn($id);
    }
    ?>
    </div>
