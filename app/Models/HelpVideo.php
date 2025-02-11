<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HelpVideo extends Model
{
    use HasFactory;

    protected $table = 'help_videos';

    protected $fillable = [
        'title',
        'url',
        'description',
        'category_id',
        'is_active',
        'views',
        'order',
        'created_by',
        'updated_by',
    ];

    /**
     * Relación con la categoría de ayuda.
     */
    public function category()
    {
        return $this->belongsTo(HelpCategory::class, 'category_id');
    }

    /**
     * Relación con usuario creador.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Relación con usuario que actualizó.
     */
    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Scope para obtener solo videos activos.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
