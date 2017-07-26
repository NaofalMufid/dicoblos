<?php
session_start();
include '../diadmin/core/core.php';
$core = new Dicoblos();
$pml = new Pemilih();
$cbl = new Coblos();

if(!$pml->Masuk()){
    header("location:?kanal=auth");
}

if ($_GET['kanal']=='proses' && $_GET['aksi']=='pilih'){
    $id = base64_decode($_GET['id']);
    $plh = $cbl->Pilih($id);
    if ($plh == 'Success') {
        $off = $cbl->NonAktif($_SESSION['seje']);
        if ($off == 'Success') {
            $pml->Keluar();
            header('location:?kanal=auth&info=a2');
        }
    }
}    
