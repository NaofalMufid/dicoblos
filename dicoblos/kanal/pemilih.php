<?php
$core = new Dicoblos();
$cbl = new Coblos();
$lib = new Paging();

//batas data yang kan ditampilkan
$batas = 10;
$posisi = $lib->cariPosisi($batas);
$arrayDpt = $core->TampilData('id_coblos', 'pemilih', $posisi, $batas);

//Pengkategorian data berdaarkan DPT yang dipilih
if(isset($_POST['pml'])){
    $arrayDpt = $core->CariData('id_coblos', $_POST['pml'], 'pemilih');
}
?>

<div class="inner cover">
    <h3 class="page-header">Data Daftar Pemilih Tetap</h3>
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
    </div>    
    &nbsp;
    <?php
    if(count($arrayDpt) > 0){
        echo'<table class="table table-responsive table-bordered table-striped">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Tgl. Lahir</th>
                    <th>Gender</th>
                    <th>DPT</th>
                </tr>
            </thead>
            <tbody>';
    
    $no=$posisi+1;
    foreach ($arrayDpt as $data){
        $ktg = $cbl->GetCb('judul', $data['id_coblos']);
        echo"<tr>"
            . "<td>$no.</td>"
            . "<td>$data[nik]</td>"
            . "<td>$data[nama]</td>"
            . "<td>$data[tgl_lahir]</td>"
            . "<td>$data[jk]</td>"
            . "<td>$ktg</td>"
        . "</tr>";
    $no++;
    } 
    echo"</tbody>"
    . "</table>";
                $jml_data = $lib->Jml_data('pemilih');
                $jml_hal = $lib->jumlahHalaman($jml_data, $batas);
                $link_hal = $lib->navHalaman($_GET['halaman'], $jml_hal);
                echo"<nav class='pager pager-sm'>"
                        . "<ul>"
                            . "<li>$link_hal</li>"
                        . "</ul>"
                    . "</nav>";
    }else{
        echo"<div class='jumbotron alert-info'>"
            . "<p>Daftar Pemilih Tetap kosong</p>"
        . "</div>";
    }
    ?>
</div>

