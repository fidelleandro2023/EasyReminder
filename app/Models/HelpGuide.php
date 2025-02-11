<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class HelpGuide extends Model
{
    use HasFactory;

    protected $table = 'help_guides';

    protected $fillable = [
        'title',
        'content',
        'category_id',
        'slug',
        'order',
        'is_active',
        'views',
        'video_url',
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
     * Scope para obtener solo guías activas.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Mutador para generar el slug automáticamente.
     */
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }
}
