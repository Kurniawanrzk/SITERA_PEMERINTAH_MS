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


    public function getTotalSampahSeluruhBSU(Request $request)
    {
        $token = $request->get("token");

        $client = new Client([
            "timeout" => 5
        ]);

        $response = $client->request("GET", "http://145.79.10.111:8003/api/v1/bsu/cek-semua-transaksi-bsu", [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => $token,
            ]
        ]);

        $transaksi = json_decode($response->getBody()->getContents(), true);

        return response()->json([
            $transaksi['data']
        ]);
    }
}
