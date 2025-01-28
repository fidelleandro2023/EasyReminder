<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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
        'next_due_date',
        'status',
        'day_of_month',
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

    /**
     * Scope: Obtener pagos activos.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Mutador: Asegurarse de que la fecha de inicio sea una instancia de Carbon.
     */
    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = Carbon::parse($value);
    }

    /**
     * Mutador: Asegurarse de que la fecha de fin sea una instancia de Carbon.
     */
    public function setEndDateAttribute($value)
    {
        $this->attributes['end_date'] = $value ? Carbon::parse($value) : null;
    }

    /**
     * Accessor: Obtener la fecha del próximo vencimiento como instancia de Carbon.
     */
    public function getNextDueDateAttribute($value)
    {
        return $value ? Carbon::parse($value) : null;
    }

    /**
     * Método: Calcular la próxima fecha de vencimiento basado en la frecuencia.
     */
    public function calculateNextDueDate()
    {
        $nextDueDate = Carbon::parse($this->next_due_date ?? $this->start_date);

        switch ($this->frequency) {
            case 'monthly':
                $nextDueDate->addMonth();
                if ($this->day_of_month) {
                    $nextDueDate->day($this->day_of_month);
                }
                break;

            case 'quarterly':
                $nextDueDate->addMonths(3);
                break;

            case 'yearly':
                $nextDueDate->addYear();
                break;
        }

        // Asegurarse de que la próxima fecha no exceda la fecha de fin
        if ($this->end_date && $nextDueDate->greaterThan(Carbon::parse($this->end_date))) {
            $this->status = 'completed'; // Marcar como completado
            $this->save();
            return null;
        }

        return $nextDueDate;
    }

    /**
     * Método: Actualizar la próxima fecha de vencimiento.
     */
    public function updateNextDueDate()
    {
        $this->next_due_date = $this->calculateNextDueDate();
        $this->save();
    }
}
