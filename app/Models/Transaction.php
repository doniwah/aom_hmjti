<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table = "transaction";
    protected $primaryKey = "id_transaction";
    protected $keyType = 'string';
    protected $fillable = [
        "id_transaction",
        "id_user",
        "no_telp",
        "id_ticket",
        "id_panitia",
        "ticket_price",
        "transaction_fee",
        "voucher_discount",
        "total_prices",
        "id_voucher",
        "payment_method",
        "bukti_pembayaran",
        "status",
        "confirmation",
        "kode_barcode",
        "created_at",
        "updated_at"
    ];
    public function user(){
        return $this->belongsTo(User::class,'id_user');
    }
    public function ticket(){
        return $this->belongsTo(Ticket::class,'id_ticket');
    }
    public function voucher(){
        return $this->belongsTo(Voucher::class,'id_voucher');
    }
    public function panitia(){
        return $this->belongsTo(Panitia::class,'id_panitia');
    }
}
