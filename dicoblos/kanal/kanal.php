<?php
if ($_GET['kanal']=='coblos') {
    require_once 'coblos.php';
}elseif ($_GET['kanal']=='proses') {
    require_once 'proses.php';
}elseif ($_GET['kanal']=='pemilih') {
    require_once 'pemilih.php';
}elseif ($_GET['kanal']=='kandidat') {
    require_once 'kandidat.php';
}elseif ($_GET['kanal']=='auth') {
    require_once 'login.php';
}elseif ($_GET['kanal']=='qc') {
    require_once 'quick_count.php';
}elseif ($_GET['kanal']=='info') {
    require_once 'info.php';
}elseif ($_GET['kanal']=='panduan') {
    require_once 'panduan.php';
}else{
    require_once 'diadmin/kanal/404NotFound.php';
}