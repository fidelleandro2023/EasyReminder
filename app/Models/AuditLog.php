<?php 
namespace App\Models; 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    use HasFactory;

    /**
     * La tabla asociada al modelo.
     *
     * @var string
     */
    protected $table = 'audit_logs';

    /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'action',
        'entity',
        'entity_id',
        'details',
        'ip_address',
        'created_at',
    ];

    /**
     * Relación: Usuario que realizó la acción.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
