<?php

/**
 * Bot PHP Telegram ver Curl
 * Lebih Bersih
 * Sample Sederhana untuk Ebook Edisi 3: Membuat Bot Sendiri Menggunakan PHP.
 *
 * Dimodifikasi untuk Ebook II: Telegram Bot PHP dan Database SQL
 *
 * Dibuat oleh Hasanudin HS
 *
 * @hasanudinhs di Telegram dan Twitter
 * Email: banghasan@gmail.com
 *
 * -----------------------
 * Grup @botphp
 * Jika ada pertanyaan jangan via PM
 * langsung ke grup saja.
 * ----------------------
 * asisten.php
 * Bot PHP untuk membuat catatan sederhana
 * Versi 0.1
 * 23 September
 * Last Update : 25 September 2016 00:40 WIB
 *
 * Default adalah poll!
 */

/* buatlah file token.php isinya :

<?php

$token = "isiTokenBotmu";

*/
require_once 'token.php';

// masukkan bot token di sini
define('BOT_TOKEN', $token);

// versi official telegram bot
 define('API_URL', 'https://api.telegram.org/bot'.BOT_TOKEN.'/');

// versi 3rd party, biar bisa tanpa https / tanpa SSL.
//define('API_URL', 'https://api.pwrtelegram.xyz/bot'.BOT_TOKEN.'/');
define('myVERSI', '0.1');
define('lastUPDATE', '10 September 2016');

// ambil databasenya
require_once 'database.php';
// aktifkan ini jika ingin menampilkan debugging poll
$debug = false;

function exec_curl_request($handle)
{
    $response = curl_exec($handle);

    if ($response === false) {
        $errno = curl_errno($handle);
        $error = curl_error($handle);
        error_log("Curl returned error $errno: $error\n");
        curl_close($handle);

        return false;
    }

    $http_code = intval(curl_getinfo($handle, CURLINFO_HTTP_CODE));
    curl_close($handle);

    if ($http_code >= 500) {
        // do not wat to DDOS server if something goes wrong
    sleep(10);

        return false;
    } elseif ($http_code != 200) {
        $response = json_decode($response, true);
        error_log("Request has failed with error {$response['error_code']}: {$response['description']}\n");
        if ($http_code == 401) {
            throw new Exception('Invalid access token provided');
        }

        return false;
    } else {
        $response = json_decode($response, true);
        if (isset($response['description'])) {
            error_log("Request was successfull: {$response['description']}\n");
        }
        $response = $response['result'];
    }

    return $response;
}

function apiRequest($method, $parameters = null)
{
    if (!is_string($method)) {
        error_log("Method name must be a string\n");

        return false;
    }

    if (!$parameters) {
        $parameters = [];
    } elseif (!is_array($parameters)) {
        error_log("Parameters must be an array\n");

        return false;
    }

    foreach ($parameters as $key => &$val) {
        // encoding to JSON array parameters, for example reply_markup
    if (!is_numeric($val) && !is_string($val)) {
        $val = json_encode($val);
    }
    }
    $url = API_URL.$method.'?'.http_build_query($parameters);

    $handle = curl_init($url);
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 5);
    curl_setopt($handle, CURLOPT_TIMEOUT, 60);
    curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);

    return exec_curl_request($handle);
}

function apiRequestJson($method, $parameters)
{
    if (!is_string($method)) {
        error_log("Method name must be a string\n");

        return false;
    }

    if (!$parameters) {
        $parameters = [];
    } elseif (!is_array($parameters)) {
        error_log("Parameters must be an array\n");

        return false;
    }

    $parameters['method'] = $method;

    $handle = curl_init(API_URL);
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 5);
    curl_setopt($handle, CURLOPT_TIMEOUT, 60);
    curl_setopt($handle, CURLOPT_POSTFIELDS, json_encode($parameters));
    curl_setopt($handle, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

    return exec_curl_request($handle);
}

// jebakan token, klo ga diisi akan mati
if (strlen(BOT_TOKEN) < 20) {
    die(PHP_EOL."-> -> Token BOT API nya mohon diisi dengan benar!\n");
}

function getUpdates($last_id = null)
{
    $params = [];
    if (!empty($last_id)) {
        $params = ['offset' => $last_id + 1, 'limit' => 1];
    }
  //echo print_r($params, true);
  return apiRequest('getUpdates', $params);
}

// matikan ini jika ingin bot berjalan
//die('baca dengan teliti yak!');

// ----------- pantengin mulai ini
function sendMessage($idpesan, $idchat, $pesan)
{
    $data = [
    'chat_id'             => $idchat,
    'text'                => $pesan,
    'parse_mode'          => 'Markdown',
    'reply_to_message_id' => $idpesan,
  ];

    return apiRequest('sendMessage', $data);
}

function processMessage($message)
{
    global $database;
    if ($GLOBALS['debug']) {
        print_r($message);
    }

    if (isset($message['message'])) {
        $sumber = $message['message'];
        $idpesan = $sumber['message_id'];
        $idchat = $sumber['chat']['id'];

        $namamu = $sumber['from']['first_name'];
        $iduser = $sumber['from']['id'];

        if (isset($sumber['text'])) {
            $pesan = $sumber['text'];

            if (preg_match("/^\/view_(\d+)$/i", $pesan, $cocok)) {
                $pesan = "/view $cocok[1]";
            }

            if (preg_match("/^\/hapus_(\d+)$/i", $pesan, $cocok)) {
                $pesan = "/hapus $cocok[1]";
            }

     // print_r($pesan);

          $pecah = explode(' ', $pesan, 3);
          $katapertama = strtolower($pecah[0]);

          // Untuk perintah pencatatn
          switch ($katapertama) {
            case '/start':
              $text = "Hai `$namamu`.. Apa kabar !\n\nUntuk bantuan ketik: /help";
              break;

            case '/help':
              $text = '💁🏼 Aku adalah *teman bot*'." \n";
              $text .= "💌 Berikut menu yang tersedia spesial buat kamu, iya kamu..\n\n";
              $text .= "➕ /tambah `[pesan]` untuk menambah catatan\n";
              $text .= "🔃 /list melihat daftar catatan tersedia\n";
              $text .= "🔍 /cari mencari catatan\n";
              $text .= " jadwal id kelas | ex : jadwal TI23 \n";
              $text .= " jadwal id kelas hari | ex : jadwal TI13 rabu \n";
              $text .= "⌛️ /time info waktu sekarang\n";
              $text .= "🆘 /help info bantuan ini\n\n";
              $text .= '😎 *Ingin diskusi?* Silakan bergabung ke @botphp';
              break;

            case '/time':
              $text = "⌛️ Waktu Sekarang :\n";
              $text .= date('d-m-Y H:i:s');
              break;

            case '/tambah':
              if (isset($pecah[1])) {
                  $pesanproses = $pecah[1];
                  $r = catatanTambah($iduser, $pesanproses);
                  $text = '😘 catatan disimpan !';
              } else {
                  $text = '⛔️ *ERROR:* _Pesan yang ditambahkan tidak boleh kosong!_';
                  $text .= "\n\nContoh: `/pesan besok aku sahur mau puasa sunnah`";
              }
              break;

            case '/view':
              if (isset($pecah[1])) {
                  $pesanproses = $pecah[1];
                  $text = catatanView($iduser, $pesanproses);
              } else {
                  $text = '⛔️ *ERROR:* `nomor pesan tidak boleh kosong.`';
              }
              break;

            case '/hapus':
              if (isset($pecah[1])) {
                  $pesanproses = $pecah[1];
                  $text = catatanHapus($iduser, $pesanproses);
              } else {
                  $text = '⛔️ *ERROR:* `nomor pesan tidak boleh kosong.`';
              }
              break;

            case '/list':
              $text = catatanList($iduser);
              if ($GLOBALS['debug']) {
                  print_r($text);
              }
              break;

            case '/cari':
              // saya gunakan pregmatch ini salah satunya untuk mencegah SQL injection
              // hanya huruf dan angka saja yang akan diproses
              if (preg_match("/^\/cari ((\w| )+)$/i", $pesan, $cocok)) {
                  $pesanproses = $cocok[1];
                  $text = catatanCari($iduser, $pesanproses);
              } else {
                  $text = '⛔️ *ERROR:* `kata kunci harus berupa kata (huruf dan angka) saja.`';
              }
              break;

            default:
              $text = '😥 Ngomong apa ya Ente, kagak paham Ane.';
              break;
          }

          // Untuk perintah penjadwalan
          if($pecah[0] == "jadwal")
          {
            if (isset($pecah[1]) AND isset($pecah[2])) {
              $pesanproses1 = strtolower($pecah[1]);
              $pesanproses2 = ucwords($pecah[2]);
              $text = jadwalCari($pesanproses1,$pesanproses2);  
            
            } elseif(isset($pecah[1])) {
              $pesanproses = strtolower($pecah[1]);
              $text = jadwalView($pesanproses);
 
            } else {
              $text  = ' Ngomong apa ya Ente, kagak paham Ane. ';
            }
          }

        } else {
            $text = 'Ada yang aneh denganmu..';
        }

        $hasil = sendMessage($idpesan, $idchat, $text);
        if ($GLOBALS['debug']) {
            // hanya nampak saat metode poll dan debug = true;
      echo 'Pesan yang dikirim: '.$text.PHP_EOL;
            print_r($hasil);
        }
    }
}

// pencetakan versi dan info waktu server, berfungsi jika test hook
echo 'Ver. '.myVERSI.' OK Start!'.PHP_EOL.date('Y-m-d H:i:s').PHP_EOL;

function printUpdates($result)
{
    foreach ($result as $obj) {
        // echo $obj['message']['text'].PHP_EOL;
    processMessage($obj);
        $last_id = $obj['update_id'];
    }

    return $last_id;
}

// AKTIFKAN INI jika menggunakan metode poll
// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
$last_id = null;
while (true) {
    $result = getUpdates($last_id);
    if (!empty($result)) {
        echo '+';
        $last_id = printUpdates($result);
    } else {
        echo '-';
    }

    sleep(1);
}

// AKTIFKAN INI jika menggunakan metode webhook
// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
/*$content = file_get_contents("php://input");
$update = json_decode($content, true);

if (!$update) {
  // ini jebakan jika ada yang iseng mengirim sesuatu ke hook
  // dan tidak sesuai format JSON harus ditolak!
  exit;
} else {
  // sesuai format JSON, proses pesannya
  processMessage($update);
}*/

/*

Sekian.

*/
