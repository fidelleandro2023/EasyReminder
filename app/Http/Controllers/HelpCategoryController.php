<?php  

namespace App\Http\Controllers;

use App\Models\HelpCategory;
use Illuminate\Http\Request;

class HelpCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Muestra la lista de categorías de ayuda con paginación.
     */
    public function index()
    {
        $categories = HelpCategory::orderBy('order')->paginate(10); 
        return view('help_categories.index', compact('categories'));
    }

    /**
     * Muestra el formulario para crear una nueva categoría.
     */
    public function create()
    {
        return view('help_categories.create');
    }

    /**
     * Almacena una nueva categoría de ayuda.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255|unique:help_categories',
            'slug'        => 'required|string|max:255|unique:help_categories',
            'description' => 'nullable|string',
            'status'      => 'required|boolean',
            'icon'        => 'nullable|string|max:255',
            'order'       => 'nullable|integer|min:0',
            'created_by'  => 'required|exists:users,id',
        ]);

        HelpCategory::create($request->all());

        return redirect()->route('help-categories.index')->with('success', 'Categoría creada exitosamente');
    }

    /**
     * Muestra una categoría específica con sus guías y FAQs relacionadas.
     */
    public function show($id)
    {
        $category = HelpCategory::with(['faqs', 'guides'])->findOrFail($id);
        return view('help_categories.show', compact('category'));
    }

    /**
     * Muestra el formulario para editar una categoría.
     */
    public function edit($id)
    {
        $category = HelpCategory::findOrFail($id);
        return view('help_categories.edit', compact('category'));
    }

    /**
     * Actualiza una categoría existente.
     */
    public function update(Request $request, $id)
    {
        $category = HelpCategory::findOrFail($id);

        $request->validate([
            'name'        => 'sometimes|string|max:255|unique:help_categories,name,' . $id,
            'slug'        => 'sometimes|string|max:255|unique:help_categories,slug,' . $id,
            'description' => 'nullable|string',
            'status'      => 'sometimes|boolean',
            'icon'        => 'nullable|string|max:255',
            'order'       => 'nullable|integer|min:0',
            'updated_by'  => 'required|exists:users,id',
        ]);

        $category->update($request->all());

        return redirect()->route('help-categories.index')->with('success', 'Categoría actualizada exitosamente');
    }

    /**
     * Elimina una categoría.
     */
    public function destroy($id)
    {
        $category = HelpCategory::findOrFail($id);
        $category->delete();

        return redirect()->route('help-categories.index')->with('success', 'Categoría eliminada exitosamente');
    }

    /**
     * Filtra categorías activas con paginación.
     */
    public function activeCategories()
    {
        $categories = HelpCategory::where('status', true)->orderBy('order')->paginate(10);
        return view('help_categories.active', compact('categories'));
    }
}
