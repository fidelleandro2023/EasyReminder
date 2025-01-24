<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    use HasFactory;

    /**
     * La tabla asociada al modelo.
     *
     * @var string
     */
    protected $table = 'reminders';

    /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'payment_id',
        'reminder_type',
        'status',
    ];

    /**
     * Relación: Usuario que creó el recordatorio.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación: Pago asociado al recordatorio.
     */
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
