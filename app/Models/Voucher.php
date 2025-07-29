<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;
    protected $table = 'voucher';
    protected $primaryKey = 'id_voucher';
    protected $fillable = [
        'id_voucher',
        'kode',
        'discount',
        'start_date',
        'end_date',
        'created_at',
    ];
    public $timestamps = false;

}
