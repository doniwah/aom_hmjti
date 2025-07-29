<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponsorships extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'logo','id_sponsorship_categori'
    ];
    public function sponsorshipcategories(){
        return $this->belongsTo(sponsorship_categori::class,'id_sponsorship_categori');
    }
}
