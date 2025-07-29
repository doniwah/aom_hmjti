<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $table = "ticket";
    protected $primaryKey = "idTicket";
    protected $fillable = [
        "idTicket",
        "name",
        "sales_in",
        "price",
        "quantity"
    ];
    public function ticket_benefit(){
        return $this->hasMany(ticket_benefits::class,'id_ticket','idTicket');
    }
    public function scopeAvailable($query)
    {
        return $query->whereRaw('limitPurchasing > (SELECT COUNT(*) FROM transaction WHERE transaction.id_ticket = ticket.idTicket AND transaction.confirmation != 3) AND quantity > 0');
    }
}
