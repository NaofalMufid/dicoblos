<?php
$core = new Dicoblos();
$cbl = new Coblos();
?>
    <div class="inner cover">
        <form method="POST" action="" id="form1" class="form-inline">
            <select name="pml" id="pml" class="form-control input-sm" onchange="document.getElementById('form1').submit()">
                    <option selected>Katgeori DPT</option>
                    <option value="">Semua</option>
                    <?php
                    $pml = $core->ComboId('id_coblos', 'judul', 'coblos');
                    foreach ($pml as $data){
                        echo "<option value='$data[id_coblos]'>$data[judul]</option>";
                    }
                    ?>
            </select>
        </form>
        
        <?php
        //Tampil kandidat berdasarkan kategori
        $id_cb = $_REQUEST['pml'];
        if(isset($id_cb)){
            //caridata kandidat
            $cln = $core->CariData('id_coblos', $id_cb, 'kandidat');
            $count = count($cln);
            
            //Judul halaman
            $jdl = $cbl->GetCb('judul', $id_cb);
            echo"<h4 class='page-header'>Kandidat $jdl</h4>";
            
            if($count > 0)    
                foreach ($cln as $calon){
                    $idk = base64_encode($calon['id_kandidat']);
                    $ttl = base64_encode($jdl);
                    echo"<div class='col-xs-6 col-sm-4'>
                            <ul class='list-group'>
                                <li class='bg-info list-group-item'>
                                    <h4>$calon[no_urut]</h4>
                                </li>
                                <a href='?kanal=kandidat&aksi=detail&ttl=$ttl&idk=$idk' class='tip' data-toggle='tooltip' data-placement='top' title='Klik untuk profil selengkapnya'>";
                        
                        if(!empty($calon['nama2'])){
                            echo"<li class='list-group-item'>
                                    <img src='diadmin/assets/upload/$calon[foto]' class='img-responsive img-thumbnail' width='100' >
                                </li>    
                                <li class='list-group-item'>
                                    <p>$calon[nama] - $calon[nama2]</p
                                    <p>$calon[partai] - $calon[partai2]</p>
                                </li>";    
                        
                        }else{
                            echo"<li class='list-group-item'>
                                    <img src='diadmin/assets/upload/$calon[foto]' class='img-responsive img-thumbnail' width='100' >
                                </li>    
                                <li class='list-group-item'>
                                    <p>$calon[nama]</p>
                                    <p>$calon[partai]</p>
                                </li>"; 
                        }
                        
                                echo"</a>"
                            . "</ul>"
                        . "</div>";
                    }
            else
                echo"<div class='jumbotron alert-info'><h4>Kandidat $jdl masih kosong</h4></div>";
        
        //Tampil detail kandidat
        }else if($_GET['kanal']=='kandidat' && $_GET['aksi']=='detail'){
            $idk = base64_decode($_GET['idk']);
            $ttl = base64_decode($_GET['ttl']);
            $coba = $core->CariData('id_kandidat', $idk, 'kandidat');
            foreach ($coba as $cln){
                if($cln['id_kandidat']==$idk){
                    echo"<div class='media'>
                            <div class='media-left'>
                                <img class='media-object' src='diadmin/assets/upload/$cln[foto]' alt='kandidat' width='150'>
                            </div>
                            <div class='media-body'>
                                <h4 class='media-heading'>Kandidat $ttl</h4>
                                    <p>Nama : $cln[nama]  $cln[nama2]</p>
                                    <p>Jenis Kelamin : $cln[jk]  $cln[jk2]</p>
                                    <p>Alamat : $cln[alamat]  $cln[alamat2]</p>
                                    <p>Partai : $cln[partai]  $cln[partai2]</p>
                                    <p>Visi : $cln[visi]</p>
                                    <p>No Urut : $cln[no_urut]</p>
                            </div>
                        </div>";
                        }
            }
        //Halaman Utama kandidat    
        }else{
            echo"<div class='jumbotron alert-info'>"
                    . "<h1>Kandidat Pemilu</h1>"
                    . "<p>Cari tahu profil para kandidat melalui navigasi diatas</p>"
                . "</div>";
        }    
        ?>    
    </div> 