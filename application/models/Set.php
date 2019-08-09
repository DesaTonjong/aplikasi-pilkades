<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Set extends CI_Model {

    public function generateString($length = 10){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $randomString = '';
      for ($i = 0; $i < $length; $i++) {
          $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function generateString_text($length = 10){
        $characters = 'abcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $randomString = '';
      for ($i = 0; $i < $length; $i++) {
          $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function generateStringUpper($length = 10){
        $characters = '123456789ABCDEFGHIJKLMNPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
      for ($i = 0; $i < $length; $i++) {
          $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function generateStringUpperLower($length = 10){
        $characters = '123456789ABCDEFGHIJKLMNPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $randomString = '';
      for ($i = 0; $i < $length; $i++) {
          $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function generateNumber($length = 10){
        $characters = '1234567890';
        $charactersLength = strlen($characters);
        $randomString = '';
      for ($i = 0; $i < $length; $i++) {
          $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    
    public function nik_space($nik='')
    {
        $nik    = substr($nik, 0,6) . " " . substr($nik, 6,6) . " " . substr($nik, 12,4);
        return $nik;
    }

    public function normalizeChars($s) {
        $replace = array(
            'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'Ae', 'Å'=>'A', 'Æ'=>'A', 'Ă'=>'A', 'Ą' => 'A', 'ą' => 'a',
            'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'ae', 'å'=>'a', 'ă'=>'a', 'æ'=>'ae',
            'þ'=>'b', 'Þ'=>'B',
            'Ç'=>'C', 'ç'=>'c', 'Ć' => 'C', 'ć' => 'c',
            'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E', 'Ę' => 'E', 'ę' => 'e',
            'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 
            'Ğ'=>'G', 'ğ'=>'g',
            'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'İ'=>'I', 'ı'=>'i', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i',
            'Ł' => 'L', 'ł' => 'l',
            'Ñ'=>'N', 'Ń' => 'N', 'ń' => 'n',
            'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'Oe', 'Ø'=>'O', 'ö'=>'oe', 'ø'=>'o',
            'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o',
            'Š'=>'S', 'š'=>'s', 'Ş'=>'S', 'ș'=>'s', 'Ș'=>'S', 'ş'=>'s', 'ß'=>'ss', 'Ś' => 'S', 'ś' => 's',
            'ț'=>'t', 'Ț'=>'T',
            'Ù'=>'U', 'Ú'=>'U', 'Û'=>'U', 'Ü'=>'Ue',
            'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ü'=>'ue', 
            'Ý'=>'Y',
            'ý'=>'y', 'ý'=>'y', 'ÿ'=>'y',
            'Ž'=>'Z', 'ž'=>'z', 'Ż' => 'Z', 'ż' => 'z', 'Ź' => 'Z', 'ź' => 'z'
        );
        return strtr($s, $replace);
    }

    public function now_print(){
        $date = new DateTime();
        $date->setTimezone(new DateTimeZone('Asia/Jakarta'));
        $now = $date->format('Y-m-d H:i:s');
        return $now;
    }

    public function now_date(){
        $date = new DateTime();
        $date->setTimezone(new DateTimeZone('Asia/Jakarta'));
        $now = $date->format('Y-m-d');
        return $now;
    }

    public function now_time(){
        $date = new DateTime();
        $date->setTimezone(new DateTimeZone('Asia/Jakarta'));
        $now = $date->format('H:i');
        return $now;
    }

    public function valid_email($email="")
    {
        if($email!=""){
            return !!filter_var($email, FILTER_VALIDATE_EMAIL);
        }
    }

    public function tgl_indo($date){
        $BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
     
        $tahun = date_format($date, "Y");
        $bulan = date_format($date, "m");
        $tgl   = date_format($date, "d");
     
        $result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;     
        return $result;
    }

    public function tgl_indo_sort($date){
        $BulanIndo = array("Jan", "Peb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agust", "Sept", "Okt", "Nov", "Des");
     
        $tahun = date_format($date, "Y");
        $bulan = date_format($date, "m");
        $tgl   = date_format($date, "d");
     
        $result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;     
        return $result;
    }

    public function nama_hari($date=""){
        if($date!=""){
            $day = date('D', strtotime($date));
            $dayList = array(
                'Sun' => 'Minggu',
                'Mon' => 'Senin',
                'Tue' => 'Selasa',
                'Wed' => 'Rabu',
                'Thu' => 'Kamis',
                'Fri' => 'Jumat',
                'Sat' => 'Sabtu'
            );

            $result = $dayList[$day]; 

            return $result;
        }else{
            return '';
        }
    }

    public function nama_hari_tanggal($date=""){
        if($date!=""){
            $BulanIndo = array("Jan", "Peb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agust", "Sept", "Okt", "Nov", "Des");

            $tahun = date_format($date, "Y");
            $bulan = date_format($date, "m");
            $tgl   = date_format($date, "d");

            $day = date('D', strtotime($date));
            $dayList = array(
                'Sun' => 'Minggu',
                'Mon' => 'Senin',
                'Tue' => 'Selasa',
                'Wed' => 'Rabu',
                'Thu' => 'Kamis',
                'Fri' => 'Jumat',
                'Sat' => 'Sabtu'
            );

            $result = $dayList[$day] . ', '. $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun; 

            return $result;
        }else{
            return '';
        }
    } 

    public function date_time_indo_sort($date_time){
        $BulanIndo = array("Jan", "Peb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agust", "Sept", "Okt", "Nov", "Des");
     
        $tahun = date_format($date_time, "Y");
        $bulan = date_format($date_time, "m");
        $tgl   = date_format($date_time, "d");
        $time   = date_format($date_time, "H:i:s");
     
        $result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun ." " . $time;     
        return $result;
    }

    public function bulan_indo($date_time){
        $BulanIndo = array("Januari", "Pebruari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
     
        $tahun = date_format($date_time, "Y");
        $bulan = date_format($date_time, "m");
        $tgl   = date_format($date_time, "d");
     
        $result = array($BulanIndo[(int)$bulan-1],  $tahun);     
        return $result;
    }

    public function is_date($str='')
    {
        try {
            $dt = new DateTime( trim($str) );
        }
        catch( Exception $e ) {
            return false;
        }
        $month = $dt->format('m');
        $day = $dt->format('d');
        $year = $dt->format('Y');
        if( checkdate($month, $day, $year) ) {
            return true;
        }
        else {
            return false;
        }

    }

    public function phone_format($value='')
    {
        $dig1 = substr($value, 0, 3);
        $dig2 = substr($value, 3, 3);
        $dig3 = substr($value, 6, 4);
        return $dig1 . ' ' . $dig2 . ' ' . $dig3;
    }

    public function time_sort($date_time){     
        $result = date_format(date_create($date_time), 'h:i');     
        return $result;
    }

    public function mail_secret($email='')
    {
        $mail  = explode('@', $email);
        $len    = strlen($mail[0]);
        if($len>=8){
            $str1   = substr($mail[0], 0,3);
            $str2   = substr($mail[0], -4);
            $string     = $str1 .'~~~~'. $str2 . '@'. $mail[1];
        }else{
            $str1   = substr($mail[0], 0,2);
            $str2   = substr($mail[0], -3);
            $string     = $str1 .'~~~~'. $str2 . '@'. $mail[1];
        }
        return $string;
    }

    public function valid_file($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        // don't download content
        curl_setopt($ch, CURLOPT_NOBODY, 1);
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if(curl_exec($ch)!==FALSE)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function string_besar_kecil($string){
        $string_kecil = strtolower($string);
        $string_new = ucwords($string_kecil);
        return $string_new;
    }

    public function alpha_numeric_checking($string='')
    {
        if(preg_match('/^[a-zA-Z]+[a-zA-Z0-9._]+$/', $string))
        {
            return true;
        }
        else
        {
            return false;
        }
    }  

    public function set_barcode($code)
    {
        //load library
        $this->load->library('libraries/zend');
        //load in folder Zend
        //$this->zend->load('Zend/Barcode');
        //generate barcode
        return Zend_Barcode::render('code128', 'image', array('text'=>$code), array());
    }

     function penyebut($x) {
        $nilai = abs($x);
        $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
        $temp = "";
        if ($nilai < 12) {
            $temp = " ". $huruf[$nilai];
        } else if ($nilai <20) {
            $temp = $this->penyebut($nilai - 10). " belas";
        } else if ($nilai < 100) {
            $temp = $this->penyebut($nilai/10)." puluh". $this->penyebut($nilai % 10);
        } else if ($nilai < 200) {
            $temp = " seratus" . $this->penyebut($nilai - 100);
        } else if ($nilai < 1000) {
            $temp = $this->penyebut($nilai/100) . " ratus" . $this->penyebut($nilai % 100);
        } else if ($nilai < 2000) {
            $temp = " seribu" . $this->penyebut($nilai - 1000);
        } else if ($nilai < 1000000) {
            $temp = $this->penyebut($nilai/1000) . " ribu" . $this->penyebut($nilai % 1000);
        } else if ($nilai < 1000000000) {
            $temp = $this->penyebut($nilai/1000000) . " juta" . $this->penyebut($nilai % 1000000);
        } else if ($nilai < 1000000000000) {
            $temp = $this->penyebut($nilai/1000000000) . " milyar" . $this->penyebut(fmod($nilai,1000000000));
        } else if ($nilai < 1000000000000000) {
            $temp = $this->penyebut($nilai/1000000000000) . " trilyun" . $this->penyebut(fmod($nilai,1000000000000));
        }     
        return $temp;
    }
     
     
    public function terbilang($x, $style=4) {
        if($x<0) {
            $hasil = "minus ". trim($this->penyebut($x));
        } else {
            $hasil = trim($this->penyebut($x));
        }     
        switch ($style) {
            case 1:
                $hasil = strtoupper($hasil);
                break;
            case 2:
                $hasil = strtolower($hasil);
                break;
            case 3:
                $hasil = ucwords($hasil);
                break;
            default:
                $hasil = ucfirst($hasil);
                break;
        }     
        return $hasil .' Saudi Riyal';
    }

}