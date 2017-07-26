<?php
session_start();
error_reporting(0);
require_once 'core.php';
$core = new Dicoblos();
$pml = new Pemilih();

if ($pml->Masuk()) {
    header('location:../../index.php?kanal=coblos');
} 
    $nik = strip_tags($_POST['nik']);
    $pswd = strip_tags($_POST['pswd']);
    $cek = $pml->LogPem($nik, $pswd);
    
    if($cek) {
        header('location:../../index.php?kanal=coblos');
    }else{
        header('location:../../index.php?kanal=auth&info=a1');
    }