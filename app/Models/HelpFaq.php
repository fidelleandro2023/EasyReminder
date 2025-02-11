<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class HelpFaq extends Model
{
    use HasFactory;

    protected $table = 'help_faqs';

    protected $fillable = [
        'category_id',
        'question',
        'answer',
        'slug',
        'order',
        'is_active',
        'views',
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
     * Scope para obtener solo preguntas activas.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Mutador para generar el slug automáticamente.
     */
    public function setQuestionAttribute($value)
    {
        $this->attributes['question'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }
}
