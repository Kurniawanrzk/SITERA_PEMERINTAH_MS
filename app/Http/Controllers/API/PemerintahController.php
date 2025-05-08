<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    Pemerintah
};
use GuzzleHttp\Client;

class PemerintahController extends Controller
{
    public function cekUser($user_id)
    {
        $pemerintah = Pemerintah::where("user_id", $user_id);

        if($pemerintah->exists())
        {
            return response()
            ->json([
                "status" => true,
                "data" => [
                    "id" => $pemerintah->first()->id,
                    "nama" => $pemerintah->first()->nama_instansi
                ]
            ], 200);
        } else {
            return response()
            ->json([
                'status' => false,
                "message" => "user tidak ada"
            ], 401);
        }
    }


    public function getTransaksiSeluruhBSU(Request $request)
    {
        $token = $request->get("token");
        $client = new Client(["timeout" => 5]);
    
        $response = $client->request("GET", "http://145.79.10.111:8003/api/v1/bsu/cek-semua-transaksi-bsu", [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => $token,
            ]
        ]);
    
        $responseData = json_decode($response->getBody()->getContents(), true);
        $transaksi = $responseData['data']; // ambil array transaksi
    
        $total_sampah = 0;
        foreach ($transaksi as $item) {
            foreach ($item['detail_transaksi'] as $item1) {
                $total_sampah += $item1['berat'];
            }
        }
    
        return response()->json([
            "status" => true,
            "data" => [
                "total_sampah" => $total_sampah,
            ]
        ]);
    }

    public function getNasabahSeluruhBSU(Request $request)
    {
        $token = $request->get("token");
        $client = new Client(['timeout' => 5]);

        $response = $client->request("GET", "http://145.79.10.111:8004/api/v1/nasabah/cek-seluruh-nasabah", [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => $token,
            ]
        ]);
        $responseData = json_decode($response->getBody()->getContents(), true);
        $nasabah = count($responseData['data']); // ambil array transaksi

        return response()
        ->json([
            "status" => true,
            "data" => $nasabah
        ], 200);

    }

    
}
