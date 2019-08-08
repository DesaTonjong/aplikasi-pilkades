<?php defined('BASEPATH') OR exit('No direct script access allowed');
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\LabelAlignment;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Response\QrCodeResponse;
class Endroid_qr extends QrCode{
    public function __construct(){
        parent::__construct();
    }
    protected function ci()
    {
        return get_instance();
    }

}