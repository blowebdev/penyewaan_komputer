<?php 
// error_reporting(0);
$server="localhost";
$username="root";
$password="";
$db="penyewaan_komputer";
$conn = mysqli_connect($server,$username,$password,$db);
$base_url = "http://localhost/sewa_komputer/";

function hari_tanggal($waktu)
{
    $hari_array = array(
        'Minggu',
        'Senin',
        'Selasa',
        'Rabu',
        'Kamis',
        'Jumat',
        'Sabtu'
    );
    $hr = date('w', strtotime($waktu));
    $hari = $hari_array[$hr];
    $tanggal = date('j', strtotime($waktu));
    $bulan_array = array(
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember',
    );
    $bl = date('n', strtotime($waktu));
    $bulan = $bulan_array[$bl];
    $tahun = date('Y', strtotime($waktu));
    $jam = date( 'H:i:s', strtotime($waktu));
    
    //untuk menampilkan hari, tanggal bulan tahun jam
    //return "$hari, $tanggal $bulan $tahun $jam";

    //untuk menampilkan hari, tanggal bulan tahun
    return "$hari, $tanggal $bulan $tahun  $jam";
}

function hp($nohp) {
    // kadang ada penulisan no hp 0811 239 345
    $nohp = str_replace(" ","",$nohp);
    // kadang ada penulisan no hp (0274) 778787
    $nohp = str_replace("(","",$nohp);
    // kadang ada penulisan no hp (0274) 778787
    $nohp = str_replace(")","",$nohp);
    // kadang ada penulisan no hp 0811.239.345
    $nohp = str_replace(".","",$nohp);

    // cek apakah no hp mengandung karakter + dan 0-9
    if(!preg_match('/[^+0-9]/',trim($nohp))){
        // cek apakah no hp karakter 1-3 adalah +62
        if(substr(trim($nohp), 0, 3)=='+62'){
            $hp = trim($nohp);
        }
        // cek apakah no hp karakter 1 adalah 0
        elseif(substr(trim($nohp), 0, 1)=='0'){
            $hp = '62'.substr(trim($nohp), 1);
        }

        else{
            $hp = $nohp;
        }
    }
    return $hp;
}

function sendWa1($hp, $text)
{
    $data = [
        'api_key' => 'efacb2a793deade57af9fb2fd3f79b91911c5324',
        'sender' => '6285283716130',
        'number' => $hp,
        'message' => $text
    ];
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://wa.srv2.wapanels.com/send-message',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    $djson2 = json_decode($response,true);

    // var_dump($djson2);
}

function generateUniqueTransactionCode($prefix = 'TRX') {
    $uniqueId = uniqid(); // Mendapatkan ID unik berdasarkan waktu saat ini
    $transactionCode = $prefix . strtoupper(substr(md5($uniqueId), 0, 8)); // Menggabungkan prefix dengan substring unik dari ID

return $transactionCode;
}

function status($txt){
    if ($txt=='PROSES') {
        return "<label class='text-warning'>PROSES</label>";
    }elseif ($txt=='BATAL') {
         return "<label class='text-danger'>BATAL</label>";
    }elseif($txt=='LUNAS'){
        return "<label class='text-success'>DISETUJUI</label>";
    }
}

?>
