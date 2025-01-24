<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentHistory extends Model
{
    use HasFactory;

    /**
     * La tabla asociada al modelo.
     *
     * @var string
     */
    protected $table = 'payment_histories';

    /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'payment_id',
        'paid_date',
        'amount_paid',
        'payment_method',
    ];

    /**
     * Relación: Pago asociado.
     */
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    /**
     * Relación: Usuario que realizó el pago.
     */
    public function user()
    {
        return $this->hasOneThrough(
            User::class,
            Payment::class,
            'id',         
            'id',         
            'payment_id',  
            'user_id'     
        );
    }
}
