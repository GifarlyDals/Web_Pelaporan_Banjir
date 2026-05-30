<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$wsdl = 'http://localhost/LaporBanjir/public/soap/laporan.wsdl';

$wsdlContent = @file_get_contents($wsdl);
if (!$wsdlContent) {
    die("GAGAL: WSDL tidak bisa diakses\n");
}
echo "✅ WSDL berhasil diakses\n\n";

try {
    $client = new SoapClient($wsdl, [
        'trace'      => true,
        'exceptions' => true,
        'cache_wsdl' => WSDL_CACHE_NONE,
    ]);

    // Test 1: getJumlahLaporan
    echo "=== getJumlahLaporan ===\n";
    print_r($client->getJumlahLaporan([]));

    // Test 2: getSemuaLaporan
    echo "\n=== getSemuaLaporan ===\n";
    print_r($client->getSemuaLaporan([]));

    // Test 3: getLaporanById
    echo "\n=== getLaporanById (id=1) ===\n";
    print_r($client->getLaporanById(['id' => 1]));

    // Test 4: getLaporanTerverifikasi
    echo "\n=== getLaporanTerverifikasi ===\n";
    print_r($client->getLaporanTerverifikasi([]));

} catch (SoapFault $e) {
    echo "❌ SoapFault: " . $e->getMessage() . "\n";
    if (isset($client)) {
        echo "\n== RESPONSE ==\n" . $client->__getLastResponse();
    }
}