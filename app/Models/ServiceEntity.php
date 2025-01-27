<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceEntity extends Model
{
    use HasFactory;

    /**
     * La tabla asociada al modelo.
     *
     * @var string
     */
    protected $table = 'service_entity';

    /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Relación: Pagos asociados a este servicio.
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
    public function services()
    {
        return $this->hasMany(ServiceEntity::class, 'parent_id');
    }
}
