<?php

/*
* Telegram Bot PHP dan Database SQL
* 
*
* Fungsi Database untuk Asisten Bot Telegram
*
*/

// masukkan database framework
require_once 'medoo.php';

// koneksikan ke database
// sesuaikan nama database, host, user, dan passwordnya
//
    $database = new medoo([
        'database_type' => 'mysql',
        'database_name' => 'cclub',
        'server' => 'localhost',
        'username' => 'root',
        'password' => 'coyg1798',
        'charset' => 'utf8'
    ]);
//

// fungsi untuk menambah catatan
function catatanTambah($iduser, $pesan)
{
    global $database;
    $last_id = $database->insert('catatan', [
        'id'    => $iduser,
        'waktu' => date('Y-m-d H:i:s').' WIB',
        'pesan' => $pesan,
    ]);

    return $last_id;
}

// fungsi menghapus catatan
function catatanHapus($iduser, $idpesan)
{
    global $database;
    $database->delete('catatan', [
        'AND' => [
            'id' => $iduser,
            'no' => $idpesan,
        ],
    ]);

    return '⛔️ telah dilaksanakan..';
}

// fungsi melihat daftar catatan user
function catatanList($iduser, $page = 0)
{
    global $database;
    $hasil = '😢 Maaf catatan masih kosong..';
    $datas = $database->select('catatan', [
        'no',
        'id',
        'waktu',
        'pesan',
    ], [
        'id' => $iduser,
    ]);
    $jml = count($datas);
    if ($jml > 0) {
        $hasil = "✍🏽 *$jml Catatan-catatan yang tersimpan :*\n";
        $n = 0;
        foreach ($datas as $data) {
            $n++;
            $hasil .= "\n$n. ".substr($data['pesan'], 0, 10)."...\n⌛️ `$data[waktu]`\n";
            $hasil .= "\n👀 /view\_$data[no]\n";
        }
    }

    return $hasil;
}


// fungsi melihat isi pesan catatan
function catatanView($iduser, $idpesan)
{
    global $database;
    $hasil = "😢 Maaf, catatanmu yang itu tidak ditemukan .\nMungkin kamu belum membuatnya..";
    $datas = $database->select('catatan', [
        'no',
        'id',
        'waktu',
        'pesan',
    ], [
        'AND' => [
            'id' => $iduser,
            'no' => $idpesan,
        ],
    ]);
    $jml = count($datas);
    if ($jml > 0) {
        $data = $datas[0];
        $hasil = "✍🏽 Catatan nomor $data[no] yang tersimpan berisi:\n~~~~~~~~~~~~~~~~~~~~~~~\n";
        $hasil .= "\n$data[pesan]\n\n⌛️ `$data[waktu]`";
        $hasil .= "\n\n📛 Hapus? /hapus\_$data[no]";
    }

    return $hasil;
}

// fungsi mencari pesan di catatan
function catatanCari($iduser, $pesan)
{
    global $database;
    $hasil = '😢 Maaf, pencarian catatanmu tidak ditemukan..';
    $datas = $database->select('catatan', [
        'no',
        'id',
        'waktu',
        'pesan',
    ], [
        'pesan[~]' => $pesan,
    ]);
    $jml = count($datas);
    if ($jml > 0) {
        $hasil = "✍🏽 *$jml Catatan-catatan yang kamu cari tersimpan  dengan rapi.*\n";
        $n = 0;
        foreach ($datas as $data) {
            $n++;
            $hasil .= "\n$n. ".substr($data['pesan'], 0, 10)."...\n⌛️ `$data[waktu]`\n";
            $hasil .= "\n👀 /view\_$data[no]\n";
        }
    }

    return $hasil;
}
// fungsi melihat jadwal kelas
function jadwalView($idkelas)
{
    global $database;
    $hasil = "Jadwal kelasmu belum ada silahkan hubungi komting masing-masing";
    $datas = $database->select('jadwal',[
        'kelas_id',
        'semester',
        'makul',
        'hari',
        'waktu',
    ],[
            'kelas_id' => $idkelas,
    ]);

    $jml = count($datas);
    if($jml > 0)
    {
        $no = 0;
        $haasil = "Ini jadwal kelasmu";
        foreach ($datas as $data) {
            $no++;
            $hasil .="\n $no. $data[makul] | $data[hari] | $data[waktu] \n"; 
        }
    }

    return $hasil;
} 

// fungsi mencari jadwal spesifik di jadwal
function jadwalCari($idkelas,$hari)
{
    global $database;
    $hasil = 'Maaf jadwal yang dicari tidak ditemukan.';
    $datak = $database->select('jadwal',[
        'kelas_id',
    ],[
            'kelas_id' => $idkelas,
    ]);

    $jml = count($datas);
    if($jml = 0)
    {
        $hasil = "Jadwal kelasmu belum ada silahkan hubungi komting masing-masing";
    }else{    
            $datas = $database->select('jadwal',[
                'kelas_id',
                'makul',
                'hari',
                'waktu',
            ],[
                'AND' => [
                    'kelas_id' => $idkelas,
                    'hari' => $hari,        
                ],
            ]);

            $jml = count($datas);
            if($jml > 0)
            {
                $hasil = "Ada $jml jadwal untuk kelasmu ";
                $no = 0;
                foreach ($datas as $data) {
                    $no++;
                    $hasil .="\n $no. $data[makul] | $data[hari] | $data[waktu] \n"; 
                }
            }
            else
            {
                $hasil = " Jadwal kelasmu LIBUR \n"; 
            }
    }        

    return $hasil;
} 
//
