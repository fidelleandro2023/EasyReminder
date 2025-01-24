<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    /**
     * La tabla asociada al modelo.
     *
     * @var string
     */
    protected $table = 'payments';

    /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'service_entity_id',
        'amount',
        'due_date',
        'status',
    ];

    protected $dates = ['deleted_at'];
    /**
     * Relaciones: Usuario asociado al pago.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relaciones: Servicio asociado al pago.
     */
    public function serviceEntity()
    {
        return $this->belongsTo(ServiceEntity::class);
    }

    /**
     * Scopes: Filtrar pagos por estado.
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scopes: Filtrar pagos que vencen pronto.
     */
    public function scopeDueSoon($query)
    {
        return $query->where('due_date', '<=', now()->addDays(3));
    }
}
