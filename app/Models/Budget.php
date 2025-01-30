<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Budget extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * La tabla asociada al modelo.
     *
     * @var string
     */
    protected $table = 'budgets';

    /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'amount',
        'spent',
        'start_date',
        'end_date',
        'status',
    ];

    /**
     * Relación: Usuario propietario del presupuesto.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Calcula el saldo disponible del presupuesto.
     */
    public function getAvailableBudgetAttribute()
    {
        return max(0, $this->amount - $this->spent);
    }

    /**
     * Verifica si el presupuesto ha sido excedido.
     */
    public function isOverBudget()
    {
        return $this->spent > $this->amount;
    }

    /**
     * Scope para obtener solo presupuestos activos.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
