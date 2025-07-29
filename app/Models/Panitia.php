<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panitia extends Model
{
    use HasFactory;
    protected $table = "panitia";
    public $incrementing = false;
    protected $primaryKey = "id_panitia";
    protected $fillable = [
        "id_panitia",
        "nama_panitia"
    ];
}
