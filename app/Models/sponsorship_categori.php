<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sponsorship_categori extends Model
{
    use HasFactory;
    protected $table = 'sponsorship_categori';
    protected $primaryKey = 'id_sponsorship_categori';
    public $timestamps = false;
}
