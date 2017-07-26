<?php
function Page(){
    if($_SESSION['hak']=='Super Admin'){
        if ($_GET['kanal']=='coblos') {
            require_once 'coblos.php';
        }elseif($_GET['kanal']=='petugas'){
            require_once 'petugas.php';
        }elseif ($_GET['kanal']=='pemilih') {
            require_once 'pemilih.php';
        }elseif ($_GET['kanal']=='kandidat') {
            require_once 'kandidat.php';
        }elseif ($_GET['kanal']=='info') {
            require_once 'info.php';
        }elseif ($_GET['kanal']=='panduan') {
            require_once 'panduan.php';
        }elseif ($_GET['kanal']=='kontak') {
            require_once 'kontak.php';
        }else{
            require_once '404NotFound.php';
        }
    }else if($_SESSION['hak']=='Admin'){
        if ($_GET['kanal']=='pemilih') {
            require_once 'pemilih.php';
        }elseif ($_GET['kanal']=='kandidat') {
            require_once 'kandidat.php';
        }elseif ($_GET['kanal']=='info') {
            require_once 'info.php';
        }elseif ($_GET['kanal']=='panduan') {
            require_once 'panduan.php';
        }elseif ($_GET['kanal']=='kontak') {
            require_once 'kontak.php';
        }else{
            require_once '404NotFound.php';
        }
    }
}    

function Menu(){
    if($_SESSION['hak']=='Super Admin'){    
        echo'<li class="dropdown-header">Master</li>
            <li><a href="index.php?kanal=coblos"><i class="glyphicon glyphicon-pushpin"></i> Pemilu</a></li>
            <li><a href="index.php?kanal=pemilih"><i class="glyphicon glyphicon-user"></i> Pemilih</a></li>
            <li><a href="index.php?kanal=kandidat"><i class="glyphicon glyphicon-education"></i> Kandidat</a></li>
            <li><a href="index.php?kanal=petugas"><i class="glyphicon glyphicon-lock"></i> Petugas</a></li>
            <li role="separator" class="divider"></li>
            <li class="dropdown-header">Information</li>
            <li><a href="index.php?kanal=info"><i class="glyphicon glyphicon-info-sign"></i> Info</a></li>
            <li><a href="index.php?kanal=panduan"><i class="glyphicon glyphicon-book"></i> Panduan</a></li>
            <li><a href="index.php?kanal=kontak"><i class="glyphicon glyphicon-phone-alt"></i> Kontak</a></li>';
    }else if($_SESSION['hak']=='Admin'){    
        echo'<li class="dropdown-header">Master</li>
            <li><a href="index.php?kanal=pemilih"><i class="glyphicon glyphicon-user"></i> Pemilih</a></li>
            <li><a href="index.php?kanal=kandidat"><i class="glyphicon glyphicon-education"></i> Kandidat</a></li>
            <li role="separator" class="divider"></li>
            <li class="dropdown-header">Information</li>
            <li><a href="index.php?kanal=info"><i class="glyphicon glyphicon-info-sign"></i> Info</a></li>
            <li><a href="index.php?kanal=panduan"><i class="glyphicon glyphicon-book"></i> Panduan</a></li>
            <li><a href="index.php?kanal=kontak"><i class="glyphicon glyphicon-phone-alt"></i> Kontak</a></li>';
    }   
            
}