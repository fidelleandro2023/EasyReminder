<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseAnalysis extends Model
{
    use HasFactory;

    /**
     * La tabla asociada al modelo.
     *
     * @var string
     */
    protected $table = 'expense_analysis';

    /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'category',
        'total_amount',
        'month',
        'year',
    ];

    /**
     * Relación: Usuario al que pertenece este análisis de gastos.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
