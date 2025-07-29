<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class postingan extends Model
{
    use HasFactory;
    protected $table = 'postingan';
    protected $primaryKey = 'id_postingan';
    protected $fillable = [
        'id_postingan',
        'media_type',
        'media_url',
        'permalink',
        'timestamps',
        'thumbnail_url'
    ];
    public $timestamps = false;
}
