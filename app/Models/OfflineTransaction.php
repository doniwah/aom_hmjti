<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfflineTransaction extends Model
{
    use HasFactory;
    protected $table = "offlinetransaction";
    public $incrementing = true;
    protected $primaryKey = "id";
    protected $fillable = [
        "id",
        "nama_lengkap",
        "email",
        "nama_ticket",
        "kode_barcode",
        "tempat_penjualan",
        "presence",
        "created_at",
        "updated_at"
    ];
}
