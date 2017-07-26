<?php //dicoblos/diadmin/core/core.php
/*Class Dicoblos*/
class Dicoblos
{
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $dbnm = "dicoblos";

    public function __construct(){
        mysql_connect($this->host,  $this->user,  $this->pass) or die("Server tidak terhubung");
        mysql_select_db($this->dbnm) or die("Database tidak terhubung");
    }
    
    //fungsi tampil combo
    public function ComboId($field1,$field2,$table){
        $query = mysql_query("SELECT ".$field1.", ".$field2." FROM ".$table." ORDER BY judul");
        while($row = mysql_fetch_array($query))
                $data[] = $row;
            return $data;
    }

    //fungsi tampil data
    public function TampilData($field,$table,$posisi,$batas){
        $query = mysql_query("SELECT * FROM $table ORDER BY $field limit $posisi,$batas");
        while ($row = mysql_fetch_array($query))
                $data[] = $row;
            return $data;
    }

    //fungsi pencarian data
    public function CariData($field,$keyword,$table)
    {
        $query = mysql_query("SELECT * FROM $table WHERE $field LIKE '%$keyword%' ORDER BY no_urut");
        $dapat = mysql_num_rows($query);
        if($dapat > 0){
            while ($row = mysql_fetch_array($query))
                    $data[] = $row;
                return $data;
        }
    }

    //fungsi upload foto
    public function UploadFoto($nm,$tmp,$dir) {
        move_uploaded_file($tmp, "$dir/$nm");
        return ;
    }
    
    //validasi login
    public function LogAdm($user,$pswd) {
        $result = mysql_query("SELECT nik,username,password,level FROM petugas WHERE username='$user'");
        $row = mysql_num_rows($result);
        $data = mysql_fetch_array($result);
        
        if($row == 1){
            /*if(password_verify($pswd, $data['password'])){
                $_SESSION['msk'] = TRUE;
                $_SESSION['asma'] = $data['username'];
                $_SESSION['hak'] = $data['level'];
                $_SESSION['seje'] = $data['nik'];*/
            if($data['password'] == $pswd){
                $_SESSION['msk'] = TRUE;
                $_SESSION['asma'] = $data['username'];
                $_SESSION['hak'] = $data['level'];
                $_SESSION['seje'] = $data['nik'];
                return TRUE;
            }  else {
                return FALSE;
            }
        }
    }
    
    public function Login() {
        return $_SESSION['msk'];
    }
    
    public function Logout() {
        unset($_SESSION['msk']);
    }
}
/*-- End --*/

/*1. Class Petugas*/
class Petugas
{
    //fungsi get data petugas
    public function GetPt($field,$id)
    {
        $query = mysql_query("SELECT * FROM petugas WHERE nik = '$id' ");
        $row = mysql_fetch_array($query);
        if($field)
            return $row[$field];
    }

    //fungsi tambah petugas
    public function TambahPt($nik,$usr,$nm,$almt,$jk,$lvl)
    {
        //fungsi password otomatis
        function PswdAut($panjang)
        {
            $karakter = "QWERTYUIOPASDFGHJKLZXCVBNM1234567890mnbvcxzlkjhgfdsapoiuytrewq";
            $string = "";

            for($i=0;$i<$panjang;$i++)
            {
                $pos = rand(0, strlen($karakter)-1);
                $string .= $karakter{$pos};
            }
            return $string;
        }
        $pswd = PswdAut(10);
        $cek = mysql_query("select *from petugas where username = '$usr' ");
        $hasil = mysql_num_rows($cek);
        if($hasil < 1){
            mysql_query("INSERT INTO petugas VALUES('$nik','$usr','$pswd','$nm','$almt','$jk','$lvl')");
            return "Yes";
        }  else if($hasil >= 1) {
            return "Delay";
        }  else {
            return "No";
        }
    }

    //fungsi edit petugas
    public function EditPt($id,$usr,$pswd,$nm,$almt,$jk,$lvl)
    {
        $sandi = password_hash($pswd, PASSWORD_DEFAULT);
        $query = mysql_query("UPDATE petugas SET username = '$usr',"
                                                ."password = '$sandi',"
                                                . "nama = '$nm',"
                                                . "alamat = '$almt',"
                                                . "jk = '$jk',"
                                                . "level = '$lvl'"
                                                . "WHERE nik = '$id'");


        if($query){
            return "Yes";
        }  else {
            return "No";
        }
    }

    //fungsi hapus petugas
    public function HapusPt($id)
    {
        $query = mysql_query("DELETE FROM petugas WHERE nik = '$id' ");


        if($query){
            return "Yes";
        }  else {
            return "No";
        }
    }
}
/*-- End --*/

/*2. Class Pemilih*/
class Pemilih
{
    //fungsi get data pemilih
    public function GetPm($field,$id)
    {
        $query = mysql_query("SELECT * FROM pemilih WHERE nik = '$id' ");
        $row = mysql_fetch_array($query);
        if($field)
            return $row[$field];
    }

    //fungsi tambah pemilih
    public function TambahPm($nik,$nm,$tgl_lhr,$jk,$almt,$id_cb)
    {
        //fungsi password otomatis
        function PswAut($panjang)
        {
            $karakter = "QWERTYUIOPASDFGHJKLZXCVBNM0987654321mnbvcxzlkjhgfdsapoiuytrewq";
            $string = "";

            for($i=0;$i<$panjang;$i++)
            {
                $pos = rand(0, strlen($karakter)-1);
                $string .= $karakter{$pos};
            }
            return $string;
        }
        
        $pswd = PswAut(8);
        $query = mysql_query("INSERT INTO pemilih(nik,password,nama,tgl_lahir,jk,alamat,id_coblos)"
                . " VALUES('$nik','$pswd','$nm','$tgl_lhr','$jk','$almt','$id_cb')");

        if($query){
            return "Yes";
        }  else {
            return "No";
        }
    }

    //fungsi edit pemilih
    public function EditPm($nik,$nm,$tgl_lhr,$jk,$almt,$id_cb)
    {
        $query = mysql_query("UPDATE pemilih SET nama = '$nm',"
                                                . "tgl_lahir = '$tgl_lhr',"
                                                . "jk = '$jk',"
                                                . "alamat = '$almt',"
                                                . "id_coblos = '$id_cb'"
                                                . "WHERE nik = '$nik'");

        if($query){
            return "Yes";
        }  else {
            return "No";
        }
    }

    //fungsi hapus pemilih
    public function HapusPm($id)
    {
        $query = mysql_query("DELETE FROM pemilih WHERE nik = '$id' ");


        if($query){
            return "Yes";
        }  else {
            return "No";
        }
    }
    
    //validasi login
    public function LogPem($nik,$sandi) {
        $result = mysql_query("SELECT nik,password,id_coblos FROM pemilih WHERE nik='$nik' AND aktif='1'");
        $row = mysql_num_rows($result);
        $data = mysql_fetch_array($result);
        
        if($row == 1){
            if($data['password'] == $sandi){
                $_SESSION['log'] = TRUE;
                $_SESSION['seje'] = $data['nik'];
                $_SESSION['mlh'] = $data['id_coblos'];
                return TRUE;
            }  else {
                return FALSE;
            }
        }
    }
    
    public function Masuk() {
        return $_SESSION['log'];
    }
    
    public function Keluar() {
        unset($_SESSION['log']);
    }
}
/*-- End --*/


/*3. Class Kandidat*/
class Kandidat
{
    //fungsi get data kandidat
    public function GetKd($field,$nik)
    {
        $query = mysql_query("SELECT * FROM kandidat WHERE id_kandidat = '$nik' ");
        $row = mysql_fetch_array($query);
        if($field)
            return $row[$field];
    }

    //fungsi tambah kandidat
    public function TambahKd($nm,$jk,$almt,$partai,$nm2,$jk2,$almt2,$partai2,$visi,$foto,$id_cb,$no)
    {
        //fungsi id otomatis
        function IdOto($pjg)
        {
            $karakter = "0987654321QWERTYUIOPLKJHGFDSAZXCVBNM";
            $idpm = "";

            for($i=0;$i<$pjg;$i++)
            {
                $pos = rand(0, strlen($karakter)-1);
                $idpm .= $karakter{$pos};
            }
            return $idpm;
        }
        
        $id_kan = IdOto(6);
        if(!empty($nm2)){
            $query = mysql_query("INSERT INTO kandidat (id_kandidat,nama,jk,alamat,partai,nama2,jk2,alamat2,partai2,visi,foto,id_coblos,no_urut) "
                . "VALUES('$id_kan','$nm','$jk','$almt','$partai','$nm2','$jk2','$almt2','$partai2','$visi','$foto','$id_cb','$no')");
        }else{
            $query = mysql_query("INSERT INTO kandidat(id_kandidat,nama,jk,alamat,partai,visi,foto,id_coblos,no_urut)"
                . "VALUES('$id_kan','$nm','$jk','$almt','$partai','$visi','$foto','$id_cb','$no')");
        }
            
        if($query){
            return "Yes";
        }  else {
            return "No";
        }
    }
    
    //fungsi edit kandidat
    public function EditKd($id,$nm,$jk,$almt,$partai,$nm2,$jk2,$almt2,$partai2,$visi,$foto,$id_cb,$no)
    {
        if(!empty($foto) && !empty($nm2)){
            $query = mysql_query("UPDATE kandidat SET nama = '$nm',"
                . "jk = '$jk',"
                . "alamat = '$almt',"
                . "partai = '$partai',"
                . "nama2 = '$nm2',"
                . "jk2 = '$jk2',"
                . "alamat2 = '$almt2',"
                . "partai2 = '$partai2',"
                . "visi = '$visi',"
                . "foto = '$foto',"
                . "id_coblos = '$id_cb',"
                . "no_urut = '$no'"
                . "WHERE id_kandidat = '$id'");
        }else if(!empty($nm2) && empty($foto)){
            $query = mysql_query("UPDATE kandidat SET nama = '$nm',"
                . "jk = '$jk',"
                . "alamat = '$almt',"
                . "partai = '$partai',"
                . "nama2 = '$nm2',"
                . "jk2 = '$jk2',"
                . "alamat2 = '$almt2',"
                . "partai2 = '$partai2',"
                . "visi = '$visi',"
                . "id_coblos = '$id_cb',"
                . "no_urut = '$no'"
                . "WHERE id_kandidat = '$id'");
        }else if(!empty ($foto)){    
            $query = mysql_query("UPDATE kandidat SET nama = '$nm',"
                    . "jk = '$jk',"
                    . "alamat = '$almt',"
                    . "partai = '$partai',"
                    . "visi = '$visi',"
                    . "foto = '$foto',"
                    . "id_coblos = '$id_cb',"
                    . "no_urut = '$no'"
                    . "WHERE id_kandidat = '$id'");
        }else{
            $query = mysql_query("UPDATE kandidat SET nama = '$nm',"
                    . "jk = '$jk',"
                    . "alamat = '$almt',"
                    . "partai = '$partai',"
                    . "visi = '$visi',"
                    . "id_coblos = '$id_cb',"
                    . "no_urut = '$no'"
                    . "WHERE id_kandidat = '$id'");
        }
        
        if($query){
            return "Yes";
        }  else {
            return "No";
        }
    }
    
    //fungsi hapus kandidat
    public function HapusKd($id)
    {
        $query = mysql_query("DELETE FROM kandidat WHERE id_kandidat = '$id' ");


        if($query){
            return "Yes";
        }  else {
            return "No";
        }
    }
    
    /*Fungsi untuk front end*/
    /**#COYG**/
}
/*-- End --*/

/*6. Class Coblos*/
class Coblos
{
    /*Pemilu*/
    
    //menampilkan kandidat sesuai dengan kategori pemilu yang diikuti 
    public function Calon($id_cb){
        $query = mysql_query("SELECT kandidat.id_kandidat,kandidat.nama,kandidat.partai,kandidat.nama2,kandidat.partai2,kandidat.no_urut,kandidat.foto,"
                . "coblos.id_coblos,coblos.judul "
                . "FROM kandidat,coblos WHERE kandidat.id_coblos = coblos.id_coblos "
                . "HAVING id_coblos = '$id_cb' ORDER BY no_urut");
        while ($row = mysql_fetch_array($query))
                $data[] = $row;
            return $data;
    }
    
    //pemberian hak suara oleh pemilih
    public function Pilih($id) {
        
        $query = mysql_query("UPDATE kandidat SET jml_suara=jml_suara+1 WHERE id_kandidat='$id'");
        if ($query) {
            return "Success";
        }  else {
            return "Failed";
        }
    }
    
    //nonaktifkan hak suara pemilih
    public function NonAktif($nik) {
       $query = mysql_query("UPDATE pemilih SET aktif = '0' where nik = '$nik'");
        if ($query) {
            return "Success";
        }  else {
            return "Failed";
        }
    }
    
    
    
    /*end*/
    
    //fungsi get data coblos
    public function GetCb($field,$id)
    {
        $query = mysql_query("SELECT * FROM coblos WHERE id_coblos = '$id' ");
        $row = mysql_fetch_array($query);
        if($field)
            return $row[$field];
    }
    
    //fungsi tambah coblos
    public function TambahCb($jdl,$mli,$slsi)
    {
        //fungsi id otomatis
        function Id($panjang)
        {
            $karakter = "QWERTYUIOPASDFGHJKLZXCVBNM1234567890";
            $string = "";

            for($i=0;$i<$panjang;$i++)
            {
                $pos = rand(0, strlen($karakter)-1);
                $string .= $karakter{$pos};
            }
            return $string;
        }
        $id = Id(5);
        $query = mysql_query("INSERT INTO coblos(id_coblos,judul,awal,akhir) VALUES('$id','$jdl','$mli','$slsi')");

        if($query){
            return "Yes";
        }  else {
            return "No";
        }
    }

    //fungsi edit coblos
    public function EditCb($id,$jdl,$mli,$slsi)
    {
        $query = mysql_query("UPDATE coblos SET judul = '$jdl',"
                                                . "awal = '$mli',"
                                                . "akhir = '$slsi'"
                                                . "WHERE id_coblos = '$id'");


        if($query){
            return "Yes";
        }  else {
            return "No";
        }
    }

    //fungsi hapus coblos
    public function HapusCb($id)
    {
        $query = mysql_query("DELETE FROM coblos WHERE id_coblos = '$id' ");


        if($query){
            return "Yes";
        }  else {
            return "No";
        }
    }
}
/*-- End --*/

/* Class Info*/
class Info
{
    //fungsi get data info
    public function GetIn($field,$id)
    {
        $query = mysql_query("SELECT * FROM info WHERE id_info = '$id' ");
        $row = mysql_fetch_array($query);
        if($field == $field)
            return $row[$field];
    }

    //fungsi tambah info dengan foto
    public function TambahInf($jdl,$isi,$foto,$pengirim)
    {   
        if(!empty($foto)){
            $query = mysql_query("INSERT INTO info(judul,isi,waktu,foto,pengirim) VALUES('$jdl','$isi',now(),'$foto','$pengirim')");
        }else{
            $query = mysql_query("INSERT INTO info(judul,isi,waktu,pengirim) VALUES('$jdl','$isi',now(),'$pengirim')");
        }
        
        if($query){
            return "Yes";
        }  else {
            return "No";
        }
    }

    //fungsi edit info dengan foto
    public function EditInf($id,$jdl,$isi,$foto)
    {
        if(!empty($foto)){
            $query = mysql_query("UPDATE info SET judul = '$jdl',"
                                                ."isi = '$isi',"
                                                . "foto = '$foto'"
                                                . "WHERE id_info = '$id'");
        }else{                                        
            $query = mysql_query("UPDATE info SET judul = '$jdl',"
                                                ."isi = '$isi'"
                                                . "WHERE id_info = '$id'");
        }
        
        if($query){
            return "Yes";
        }  else {
            return "No";
        }
    }

    //fungsi hapus info
    public function HapusIn($id)
    {
        $query = mysql_query("DELETE FROM info WHERE id_info = '$id' ");


        if($query){
            return "Yes";
        }  else {
            return "No";
        }
    }
}
/*-- End --*/


/*4. Class Panduan*/
class Panduan
{
    //fungsi get data panduan
    public function GetPn($field,$id)
    {
        $query = mysql_query("SELECT * FROM panduan WHERE id_panduan = '$id' ");
        $row = mysql_fetch_array($query);
        if($field)
            return $row[$field];
    }

    //fungsi tambah panduan
    public function TambahPn($jdl,$isi)
    {
        $query = mysql_query("INSERT INTO panduan(judul,isi) VALUES('$jdl','$isi')");

        if($query){
            return "Yes";
        }  else {
            return "No";
        }
    }

    //fungsi edit panduan
    public function EditPn($id,$jdl,$isi)
    {
        $query = mysql_query("UPDATE panduan SET judul = '$jdl',"
                                                ."isi = '$isi'"
                                                . "WHERE id_panduan = '$id'");

        if($query){
            return "Yes";
        }  else {
            return "No";
        }
    }

    //fungsi hapus panduan
    public function HapusPn($id)
    {
        $query = mysql_query("DELETE FROM panduan WHERE id_panduan = '$id' ");


        if($query){
            return "Yes";
        }  else {
            return "No";
        }
    }
}
/*-- End --*/

/*5. Class Kontak*/
class Kontak
{


    //fungsi tambah kontak
    public function TambahKn($nm,$email,$sub,$psn)
    {
        $query = mysql_query("INSERT INTO panduan(nama,email,subjek,pesan,waktu) VALUES('$jdl','$isi','$sub','$psn',now())");

        if($query){
            return "Yes";
        }  else {
            return "No";
        }
    }

    //fungsi hapus kontak
    public function HapusKn($id)
    {
        $query = mysql_query("DELETE FROM kontak WHERE id_kontak = '$id' ");


        if($query){
            return "Yes";
        }  else {
            return "No";
        }
    }
}
/*-- End --*/