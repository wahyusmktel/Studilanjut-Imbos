<?php

use SimpleSoftwareIO\QrCode\Facades\QrCode;

if (!function_exists('generateQrCodeBase64')) {
    function generateQrCodeBase64($text) {
        $qrCode = QrCode::format('png')->size(100)->generate($text);
        return 'data:image/png;base64,' . base64_encode($qrCode);
    }
}
