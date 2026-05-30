<?php

namespace App\Http\Controllers;

use App\Services\LaporanSoapService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SoapController extends Controller
{
    public function wsdl()
    {
        $wsdlPath = public_path('soap/laporan.wsdl');
        return response()->file($wsdlPath, [
            'Content-Type' => 'text/xml; charset=utf-8',
        ]);
    }

    public function handle(Request $request)
    {
        while (ob_get_level()) {
            ob_end_clean();
        }

        $wsdlPath = public_path('soap/laporan.wsdl');

        // Debug: pastikan file ada
        if (!file_exists($wsdlPath)) {
            Log::error('SOAP WSDL tidak ditemukan: ' . $wsdlPath);
            return response('WSDL file not found: ' . $wsdlPath, 500);
        }

        try {
            $server = new \SoapServer($wsdlPath, [
                'cache_wsdl' => WSDL_CACHE_NONE,
            ]);

            $server->setObject(new \App\Services\LaporanSoapService());

            ob_start();
            $server->handle($request->getContent()); // <-- pass raw body eksplisit
            $soapResponse = ob_get_clean();

            if (empty($soapResponse)) {
                Log::error('SOAP response kosong');
                return response('SOAP response empty', 500);
            }

            return response($soapResponse, 200)
                ->header('Content-Type', 'text/xml; charset=utf-8');
        } catch (\Throwable $e) {
            Log::error('SOAP Exception: ' . $e->getMessage() . ' di ' . $e->getFile() . ':' . $e->getLine());
            return response('Error: ' . $e->getMessage(), 500);
        }
    }
}
