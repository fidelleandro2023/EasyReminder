<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HelpGuide;

class HelpGuideController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Mostrar todas las guías de ayuda con paginación.
     */
    public function index()
    {
        $guides = HelpGuide::with('category')
            ->orderBy('order', 'asc')
            ->paginate(10);

        return view('help_guides.index', compact('guides'));
    }

    /**
     * Mostrar una guía específica por su slug.
     */
    public function show($slug)
    {
        $guide = HelpGuide::with('category')->where('slug', $slug)->firstOrFail();
        
        // Incrementar el contador de visitas
        $guide->increment('views');

        return view('help_guides.show', compact('guide'));
    }

    /**
     * Mostrar el formulario para crear una nueva guía.
     */
    public function create()
    {
        return view('help_guides.create');
    }

    /**
     * Guardar una nueva guía de ayuda.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:help_guides,title',
            'content' => 'required|string',
            'category_id' => 'nullable|exists:help_categories,id',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
            'video_url' => 'nullable|url',
        ]);

        HelpGuide::create([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'order' => $request->order ?? 0,
            'is_active' => $request->is_active ?? true,
            'video_url' => $request->video_url,
            'created_by' => auth()->id(),
            'updated_by' => auth()->id(),
        ]);

        return redirect()->route('help_guides.index')->with('success', 'Guía creada correctamente.');
    }

    /**
     * Mostrar el formulario para editar una guía.
     */
    public function edit($slug)
    {
        $guide = HelpGuide::where('slug', $slug)->firstOrFail();
        return view('help_guides.edit', compact('guide'));
    }

    /**
     * Actualizar una guía de ayuda.
     */
    public function update(Request $request, $slug)
    {
        $guide = HelpGuide::where('slug', $slug)->firstOrFail();

        $request->validate([
            'title' => 'required|string|max:255|unique:help_guides,title,' . $guide->id,
            'content' => 'required|string',
            'category_id' => 'nullable|exists:help_categories,id',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
            'video_url' => 'nullable|url',
        ]);

        $guide->update([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'order' => $request->order,
            'is_active' => $request->is_active,
            'video_url' => $request->video_url,
            'updated_by' => auth()->id(),
        ]);

        return redirect()->route('help_guides.index')->with('success', 'Guía actualizada correctamente.');
    }

    /**
     * Eliminar una guía de ayuda.
     */
    public function destroy($slug)
    {
        $guide = HelpGuide::where('slug', $slug)->firstOrFail();
        $guide->delete();

        return redirect()->route('help_guides.index')->with('success', 'Guía eliminada correctamente.');
    }
}
