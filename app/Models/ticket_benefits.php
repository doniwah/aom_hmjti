<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ticket_benefits extends Model
{
    use HasFactory;
    protected $table = 'ticket_benefit';
    protected $primaryKey = 'id_ticket_benefits';
    protected $fillable = [
        'name',
        'id_ticket'
    ];
    public $timestamps = false;
    public function Ticket(){
        return $this->belongsTo(Ticket::class,'id_ticket','idTicket');
    }
}
