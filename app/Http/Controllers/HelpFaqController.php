<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\HelpFaq;
use App\Models\HelpCategory;

class HelpFaqController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Mostrar todas las preguntas frecuentes en la vista.
     */
    public function index()
    {
        $faqs = HelpFaq::with('category')
            ->orderBy('order', 'asc')
            ->paginate(10);

        return view('faqs.index', compact('faqs'));
    }

    /**
     * Mostrar un formulario para crear una nueva pregunta frecuente.
     */
    public function create()
    {
        $categories = HelpCategory::all();  
        return view('faqs.create', compact('categories'));
    }

    /**
     * Guardar una nueva pregunta frecuente.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id' => 'required|exists:help_categories,id',
            'question'    => 'required|string|max:255',
            'answer'      => 'required|string',
            'order'       => 'nullable|integer',
            'is_active'   => 'boolean',
        ]);

        $data['order'] = $data['order'] ?? 0;
        $data['is_active'] = $data['is_active'] ?? true;
        $data['views'] = 0;
        $data['created_by'] = auth()->id();
        $data['updated_by'] = auth()->id();

        HelpFaq::create($data);

        return redirect()->route('faqs.index')->with('success', 'Pregunta creada correctamente.');
    }

    /**
     * Mostrar una pregunta frecuente en detalle.
     */
    public function show($id)
    {
        $faq = HelpFaq::with('category')->findOrFail($id);
        return view('faqs.show', compact('faq'));
    }

    /**
     * Mostrar el formulario de edición de una pregunta frecuente.
     */
    public function edit($id)
    {
        $faq = HelpFaq::findOrFail($id);
        $categories = HelpCategory::all();
        return view('faqs.edit', compact('faq', 'categories'));
    }

    /**
     * Actualizar una pregunta frecuente.
     */
    public function update(Request $request, $id)
    {
        $faq = HelpFaq::findOrFail($id);

        $data = $request->validate([
            'category_id' => 'sometimes|exists:help_categories,id',
            'question'    => 'sometimes|string|max:255',
            'answer'      => 'sometimes|string',
            'order'       => 'nullable|integer',
            'is_active'   => 'boolean',
        ]);

        $data['updated_by'] = auth()->id();

        $faq->update($data);

        return redirect()->route('faqs.index')->with('success', 'Pregunta actualizada correctamente.');
    }

    /**
     * Eliminar una pregunta frecuente.
     */
    public function destroy($id)
    {
        $faq = HelpFaq::findOrFail($id);
        $faq->delete();   
        return redirect()->route('faqs.index')->with('success', 'Pregunta eliminada correctamente.');
    }
}
