<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HelpVideo;

class HelpVideoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Mostrar todos los videos con paginación.
     */
    public function index()
    {
        $videos = HelpVideo::with('category')
            ->orderBy('order', 'asc')
            ->paginate(10);

        return view('help_videos.index', compact('videos'));
    }

    /**
     * Mostrar un video específico.
     */
    public function show($id)
    {
        $video = HelpVideo::with('category')->findOrFail($id);

        // Incrementar el contador de visitas
        $video->increment('views');

        return view('help_videos.show', compact('video'));
    }

    /**
     * Mostrar el formulario para crear un nuevo video.
     */
    public function create()
    {
        return view('help_videos.create');
    }

    /**
     * Guardar un nuevo video de ayuda.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:help_videos,title',
            'url' => 'required|url',
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:help_categories,id',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        HelpVideo::create([
            'title' => $request->title,
            'url' => $request->url,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'order' => $request->order ?? 0,
            'is_active' => $request->is_active ?? true,
            'created_by' => auth()->id(),
            'updated_by' => auth()->id(),
        ]);

        return redirect()->route('help_videos.index')->with('success', 'Video creado correctamente.');
    }

    /**
     * Mostrar el formulario para editar un video.
     */
    public function edit($id)
    {
        $video = HelpVideo::findOrFail($id);
        return view('help_videos.edit', compact('video'));
    }

    /**
     * Actualizar un video de ayuda.
     */
    public function update(Request $request, $id)
    {
        $video = HelpVideo::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255|unique:help_videos,title,' . $video->id,
            'url' => 'required|url',
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:help_categories,id',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $video->update([
            'title' => $request->title,
            'url' => $request->url,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'order' => $request->order,
            'is_active' => $request->is_active,
            'updated_by' => auth()->id(),
        ]);

        return redirect()->route('help_videos.index')->with('success', 'Video actualizado correctamente.');
    }

    /**
     * Eliminar un video de ayuda.
     */
    public function destroy($id)
    {
        $video = HelpVideo::findOrFail($id);
        $video->delete();

        return redirect()->route('help_videos.index')->with('success', 'Video eliminado correctamente.');
    }
}
