<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;

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
    ];

    /**
     * Relación: Usuario propietario del presupuesto.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Método para calcular el saldo disponible.
     */
    public function getAvailableBudgetAttribute()
    {
        return $this->amount - $this->spent;
    }
}
