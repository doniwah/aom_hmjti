<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BelumBayar extends Model
{
    use HasFactory;
    protected $table = "belum_bayar";
    public $incrementing = false;
    protected $primaryKey = "id";
    protected $fillable = [
        "email",
        "status"
    ];
}
