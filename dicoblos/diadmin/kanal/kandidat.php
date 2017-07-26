<?php //dicoblos/diadmin/kanal/kandidat.php
$ctrl = new Dicoblos();
$mdl = new Kandidat();
$cbl = new Coblos();
$lib = new Paging();

//Tampil,cari & paging 
$batas = 10;
$posisi = $lib->cariPosisi($batas);
$arrayKd = $ctrl->TampilData('id_coblos', 'kandidat', $posisi, $batas);

//Cari
if($_POST['pml']){
    $arrayKd = $ctrl->CariData('id_coblos', $_POST['pml'], 'kandidat');
}else if($_POST['do']=='find'){
    $arrayKd = $ctrl->CariData('nama', $_POST['keyword'], 'kandidat');
}
?>
    <h3 class="page-header"><span class="glyphicon glyphicon-education"></span> Kandidat</h3>
    
    <div class="row col-sm-8 col-md-12">
    <!--Tambah Data Kandidat -->
    <?php if($_GET['kanal']=='kandidat' && $_GET['aksi']=='tambah'){?>    
    
    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="glyphicon glyphicon-plus-sign"></span>&nbsp;&nbsp;Tambah Data Kandidat
        </div>
        <div class="panel-body">
            <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                
                <?php if($_GET['data']=='psg'){ ?>
                <!--Data Wakil-->
                <div class="panel-heading">
                    <p>Data Kepala </p>    
                </div>
                <?php }?>
                <div class="form-group form-group-sm">
                    <label for="nama" class="col-sm-2">Nama :</label>
                    <div class="col-sm-4">
                        <input type="text" name="nama" class="form-control input-sm">
                    </div>
                </div> 
                <div class="form-group form-group-sm">
                    <label for="gender" class="col-sm-2">Gender :</label>
                    <div class="col-sm-2">
                        <select name="jk" class="form-control input-sm">
                            <option value="Pria">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                </div> 
                <div class="form-group form-group-sm">
                    <label for="alamat" class="col-sm-2">Alamat :</label>
                    <div class="col-sm-5">
                        <textarea name="almt" class="form-control input-sm"></textarea>
                    </div>
                </div> 
                <div class="form-group form-group-sm">
                    <label for="prt" class="col-sm-2">Partai :</label>
                    <div class="col-sm-4">
                        <input type="text" name="prt" class="form-control input-sm"/>
                    </div>    
                </div>    
                <?php if($_GET['data']=='psg'){ ?>
                <!--Data Wakil-->
                <div class="panel-heading">
                    <p>Data Wakil </p>    
                </div>
                <div class="form-group form-group-sm">
                    <label for="nama2" class="col-sm-2">Nama :</label>
                    <div class="col-sm-4">
                        <input type="text" name="nama2" class="form-control input-sm">
                    </div>
                </div> 
                <div class="form-group form-group-sm">
                    <label for="gender2" class="col-sm-2">Gender :</label>
                    <div class="col-sm-2">
                        <select name="jk2" class="form-control input-sm">
                            <option value="Pria">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                </div> 
                <div class="form-group form-group-sm">
                    <label for="alamat2" class="col-sm-2">Alamat :</label>
                    <div class="col-sm-5">
                        <textarea name="almt2" class="form-control input-sm"></textarea>
                    </div>
                </div> 
                <div class="form-group form-group-sm">
                    <label for="prt2" class="col-sm-2">Partai :</label>
                    <div class="col-sm-4">
                        <input type="text" name="prt2" class="form-control input-sm"/>
                    </div>    
                </div>    
                <?php } ?>
                
                <?php if($_GET['data']=='psg'){ ?>
                <!--Data Wakil-->
                <div class="panel-heading">
                    <p>Data Pasangan </p>    
                </div>
                <?php }?>
                 
                <div class="form-group form-group-sm">
                    <label for="visi" class="col-sm-2">Visi :</label>
                    <div class="col-sm-5">
                        <textarea name="visi" class="form-control input-sm"></textarea>
                    </div>
                </div>
                <div class="form-group form-group-sm">
                    <label for="foto" class="col-sm-2">Foto :</label>
                    <div class="col-sm-3">
                        <input type="file" name="foto" class="form-control input-sm"/>
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
                <div class="form-group form-group-sm">
                    <label for="no" class="col-sm-2">No.Urut :</label>
                    <div class="col-sm-2">
                        <input type="number" name="no" class="form-control input-sm"/>
                    </div>    
                </div>    
                <div class="col-sm-2 col-sm-offset-2">
                    <input type="submit" name="simpan" value=" Simpan " class="btn btn-primary btn-sm" data-id="1" /> 
                </div>
            </form>
        </div>
    </div>
    
    <!--Edit Data Kandidat-->
    <?php 
    }elseif ($_GET['kanal']=='kandidat' && $_GET['aksi']=='edit') {
        $id = base64_decode($_GET['id']);
    ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="glyphicon glyphicon-cog"></span>&nbsp;&nbsp;Edit Data Kandidat
        </div>
        <div class="panel-body">
            <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                <div class="form-group form-group-sm">
                    <label for="id" class="col-sm-2">Id Kandidat :</label>
                    <div class="col-sm-2">
                        <input type="text" name="id" class="form-control input-sm" readonly="readonly" value="<?php echo"$id";?>"/>
                    </div>
                </div>
                
                <!--Data Kepala-->
                <div class="form-group form-group-sm">
                    <label for="nama" class="col-sm-2">Nama :</label>
                    <div class="col-sm-4">
                        <input type="text" name="nama" class="form-control input-sm" value="<?php echo $mdl->GetKd('nama', $id);?>"/>
                    </div>
                </div> 
                <div class="form-group form-group-sm">
                    <label for="gender" class="col-sm-2">Gender :</label>
                    <div class="col-sm-2">
                        <select name="jk" class="form-control input-sm">
                        <?php
                        $gnd = $mdl->GetKd('jk', $id);
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
                        <textarea name="almt" class="form-control input-sm"><?php echo $mdl->GetKd('alamat', $id);?></textarea>
                    </div>
                </div> 
                <div class="form-group form-group-sm">
                    <label for="prt" class="col-sm-2">Partai :</label>
                    <div class="col-sm-4">
                        <input type="text" name="prt" class="form-control input-sm" value="<?php echo $mdl->GetKd('partai', $id);?>"/>
                    </div>    
                </div>
                
                <?php 
                $wakil = $mdl->GetKd('nama2', $id);
                if(!empty($wakil)){ 
                ?>
                <!--Data Wakil-->
                <div class="form-group form-group-sm">
                    <label for="nama" class="col-sm-2">Nama :</label>
                    <div class="col-sm-4">
                        <input type="text" name="nama2" class="form-control input-sm" value="<?php echo $mdl->GetKd('nama2', $id);?>"/>
                    </div>
                </div> 
                <div class="form-group form-group-sm">
                    <label for="gender" class="col-sm-2">Gender :</label>
                    <div class="col-sm-2">
                        <select name="jk2" class="form-control input-sm">
                        <?php
                        $gnd = $mdl->GetKd('jk2', $id);
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
                        <textarea name="almt2" class="form-control input-sm"><?php echo $mdl->GetKd('alamat2', $id);?></textarea>
                    </div>
                </div>
                <div class="form-group form-group-sm">
                    <label for="prt" class="col-sm-2">Partai :</label>
                    <div class="col-sm-4">
                        <input type="text" name="prt2" class="form-control input-sm" value="<?php echo $mdl->GetKd('partai2', $id);?>"/>
                    </div>    
                </div>    
                <?php } ?>
                
                <!--******-->
                <div class="form-group form-group-sm">
                    <label for="visi" class="col-sm-2">Visi :</label>
                    <div class="col-sm-5">
                        <textarea name="visi" class="form-control input-sm"><?php echo $mdl->GetKd('visi', $id);?></textarea>
                    </div>
                </div> 
                <div class="form-group form-group-sm">
                    <label for="foto" class="col-sm-2">Foto :</label>
                    <div class="col-sm-3">
                        <div class="item">
                            <img src="assets/upload/<?php echo $mdl->GetKd('foto', $id); ?>" width="100" class="img-responsive" alt="Foto Kandidat">
                        </div>
                        <input type="file" name="foto" class="form-control input-sm"/>
                    </div>    
                </div>       
                <div class="form-group form-group-sm">
                    <label for="pemilu" class="col-sm-2">Pemilu :</label>
                    <div class="col-sm-3">
                        <select name="pml" class="form-control input-x">
                            <?php
                            $idb = $mdl->GetKd('id_coblos', $id);
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
                <div class="form-group form-group-sm">
                    <label for="no" class="col-sm-2">No.Urut :</label>
                    <div class="col-sm-2">
                        <input type="number" name="no" class="form-control input-sm" value="<?php echo $mdl->GetKd('no_urut', $id);?>"/>
                    </div>    
                </div>    
                <div class="col-sm-2 col-sm-offset-2">
                    <input type="submit" name="update" value=" Update " class="btn btn-primary btn-sm" data-id="1" /> 
                </div>
            </form>
        </div>
    </div>
    
    <?php } else { ?>
    
    <!--Tampil Data kandidat-->
        <div class="panel panel-default">
            <div class="panel-heading"><span class="glyphicon glyphicon-education"></span> Data Kandidat</div>
            <div class="panel-body">
                <div class="form-group">
                <form method="POST" action="" class="form-inline" id="form1">
                    <a href="?kanal=kandidat&aksi=tambah" class="btn btn-success btn-sm tip" data-toggle="tooltip" data-placement="bottom" title="Tambah data untuk kandidat tunggal"><span class="glyphicon glyphicon-plus-sign"></span> Kandidat Tunggal</a>
                    <a href="?kanal=kandidat&aksi=tambah&data=psg" class="btn btn-danger btn-sm tip" data-toggle="tooltip" data-placement="bottom" title="Tambah data untuk kandidat pasangan"><span class="glyphicon glyphicon-plus-sign"></span> Kandidat Pasangan</a>
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
                </form>
                </div>    
                <div class="table-responsive">
                    <table class="table table-striped table-condensed table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Foto</th>
                                <th>Suara</th>
                                <th>Pemilu</th>
                                <th>No.Urut</th>
                                <th colspan="2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>        
                    <?php
                    if(count($arrayKd)){
                        $no = $posisi+1;
                        foreach ($arrayKd as $data){
                            $jdl = $cbl->GetCb('judul', $data['id_coblos']);
                            $id = base64_encode($data['id_kandidat']);
                            if(empty($data[nama2])){
                            echo "<tr>
                                    <td>$no.</td>
                                    <td>$data[nama]</td>
                                    <td><img src='assets/upload/$data[foto]' width='50' alt='Foto Kandidat'></td>
                                    <td>$data[jml_suara]</td>
                                    <td>$jdl</td>
                                    <td>$data[no_urut]</td>
                                    <td>
                                        <a href='?kanal=kandidat&aksi=edit&id=$id' class='tip' data-toggle='tooltip' data-placement='bottom' title='Edit data'><i class='glyphicon glyphicon-cog'></i></a> 
                                    </td>
                                    <td>
                                        <a href='?kanal=kandidat&aksi=hapus&id=$id' class='tip' data-toggle='tooltip' data-placement='bottom' title='Hapus data'><i class='glyphicon glyphicon-trash'></i></a> 
                                    </td>
                                </tr>";
                            }else{
                                echo "<tr>
                                    <td>$no.</td>
                                    <td>$data[nama] - $data[nama2]</td>
                                    <td><img src='assets/upload/$data[foto]' width='50' alt='Foto Kandidat'></td>
                                    <td>$data[jml_suara]</td>
                                    <td>$jdl</td>
                                    <td>$data[no_urut]</td>
                                    <td>
                                        <a href='?kanal=kandidat&aksi=edit&id=$id' class='tip' data-toggle='tooltip' data-placement='bottom' title='Edit data'><i class='glyphicon glyphicon-cog'></i></a> 
                                    </td>
                                    <td>
                                        <a href='?kanal=kandidat&aksi=hapus&id=$id' class='tip' data-toggle='tooltip' data-placement='bottom' title='Hapus data'><i class='glyphicon glyphicon-trash'></i></a> 
                                    </td>
                                </tr>";
                            }
                        $no++;    
                        }
                    }else{
                        echo"<div class='row col-sm-6 col-md-6'>"
                                . "<div class='alert alert-warning'>"
                                    . "<p>Data tidak ditemukan</p>"
                                . "</div>"
                            . "</div>";
                    } 
                        echo"</tbody></table>";
                    //Paging Halaman
                        $jml_data = $lib->Jml_data('kandidat');
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
    <?php }
		echo"</div>";
    //Menambah Data
    if ($_POST['simpan']) {
        $nm = $_POST['nama'];
        $jk = $_POST['jk'];
        $almt = $_POST['almt'];
        $prt = $_POST['prt'];
        $nm2 = $_POST['nama2'];
        $jk2 = $_POST['jk2'];
        $almt2 = $_POST['almt2'];
        $prt2 = $_POST['prt2'];
        $vs = $_POST['visi'];
        $pml = $_POST['pml'];
        $no = $_POST['no'];
        
        //upload foto
        $nm_ft = $_FILES['foto']['name'];
        $tmp = $_FILES['foto']['tmp_name'];
        $dir = "assets/upload";
        $ctrl->UploadFoto($nm_ft, $tmp, $dir);
        
        //insert into database
            $tbh = $mdl->TambahKd($nm, $jk, $almt, $prt, $nm2, $jk2, $almt2, $prt2, $vs, $nm_ft, $pml, $no);
        
            if($tbh == "Yes"){
                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=?kanal=kandidat">';
            }    
    }
    
    //Mengupdate data    
    if (isset($_POST['update'])) {
        //Ketua
        $id = $_POST['id'];
        $nm = $_POST['nama'];
        $jk = $_POST['jk'];
        $almt = $_POST['almt'];
        $prt = $_POST['prt'];
        $nm2 = $_POST['nama2'];
        $jk2 = $_POST['jk2'];
        $almt2 = $_POST['almt2'];
        $prt2 = $_POST['prt2'];
        $vs = $_POST['visi'];
        $pml = $_POST['pml'];
        $no = $_POST['no'];
        
        //upload foto
        $nm_ft = $_FILES['foto']['name'];
        $tmp = $_FILES['foto']['tmp_name'];
        $dir = "assets/upload";
        $ctrl->UploadFoto($nm_ft, $tmp, $dir);
        
        //update into database
            $edt = $mdl->EditKd($id, $nm, $jk, $almt, $prt, $nm2, $jk2, $almt2, $prt2, $vs, $nm_ft, $pml, $no);
            
            if($edt == "Yes"){
                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=?kanal=kandidat">';
            }
    }
    
    //Menghapus Data    
    if ($_GET['kanal']=='kandidat' && $_GET['aksi']=='hapus') {
        $id = base64_decode($_GET['id']);
        $hps = $mdl->HapusKd($id);
        
        if($hps == "Yes"){
                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=?kanal=kandidat">';
        }    
    }
    ?>
