<?php
session_start();
error_reporting(0);
require_once 'core.php';
$core = new Dicoblos();

if ($core->Login()) {
    header('location:../index.php');
} 
    $user = strip_tags($_POST['username']);
    $pswd = strip_tags($_POST['password']);
    $cek = $core->LogAdm($user, $pswd);
    
    if($cek) {
        header('location:../index.php');
    }else{
        header('location:../login.php?info=gagal');
    }