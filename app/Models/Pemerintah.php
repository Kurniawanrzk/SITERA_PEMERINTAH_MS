<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUuid;

class Pemerintah extends Model
{
    use HasFactory, HasUuid;

    protected $table = "pemerintah";
    public $incrementing = false;
    protected $keyType = 'string'; 
    protected $fillable = [
        'user_id',
        'kode_instansi',
        "nama_instansi",
        "jabatan",
        "nama_jabatan",
        "alamat",
        "email",
        "nomor_telepon"
    ];

}
