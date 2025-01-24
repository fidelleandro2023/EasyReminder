<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecurringPayment extends Model
{
    use HasFactory;

    /**
     * La tabla asociada al modelo.
     *
     * @var string
     */
    protected $table = 'recurring_payments';

    /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'service_entity_id',
        'amount',
        'frequency',
        'start_date',
        'end_date',
        'status',
    ];

    /**
     * Relación: Usuario propietario del pago recurrente.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación: Servicio asociado al pago recurrente.
     */
    public function serviceEntity()
    {
        return $this->belongsTo(ServiceEntity::class);
    }
}
