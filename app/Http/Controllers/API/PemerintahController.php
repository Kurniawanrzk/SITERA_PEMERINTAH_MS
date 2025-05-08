<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    Pemerintah
};

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
        return response()
        ->json([
            "bisa"
        ], 200);
    }
}
