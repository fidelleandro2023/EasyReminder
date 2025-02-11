<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HelpCategory extends Model
{
    use HasFactory;

    protected $table = 'help_categories';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'status',
        'icon',
        'order',
        'created_by',
        'updated_by',
    ];

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
     * Relación con las preguntas frecuentes.
     */
    public function faqs()
    {
        return $this->hasMany(HelpFaq::class, 'category_id');
    }

    /**
     * Relación con las guías de ayuda.
     */
    public function guides()
    {
        return $this->hasMany(HelpGuide::class, 'category_id');
    }
}
