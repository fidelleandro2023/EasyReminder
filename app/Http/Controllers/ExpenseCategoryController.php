<?php

namespace App\Http\Controllers;

use App\Models\ExpenseCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseCategoryController extends Controller
{
    /**
     * Lista las categorías de gastos del usuario autenticado.
     */
    public function index()
    {
        $expenseCategories = ExpenseCategory::where('user_id', Auth::id())->get();

        return view('expense_categories.index', compact('expenseCategories'));
    }

    /**
     * Muestra el formulario para crear una nueva categoría de gasto.
     */
    public function create()
    {
        return view('expense_categories.create');
    }

    /**
     * Almacena una nueva categoría de gasto en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:expense_categories,name,NULL,id,user_id,' . Auth::id(),
            'description' => 'nullable|string|max:500',
        ]);

        ExpenseCategory::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('expense-categories.index')->with('success', 'Categoría de gasto creada exitosamente.');
    }

    /**
     * Muestra los detalles de una categoría de gasto específica.
     */
    public function show(ExpenseCategory $expenseCategory)
    {
        $this->authorize('view', $expenseCategory);

        return view('expense_categories.show', compact('expenseCategory'));
    }

    /**
     * Muestra el formulario para editar una categoría de gasto.
     */
    public function edit(ExpenseCategory $expenseCategory)
    {
        $this->authorize('update', $expenseCategory);

        return view('expense_categories.edit', compact('expenseCategory'));
    }

    /**
     * Actualiza una categoría de gasto en la base de datos.
     */
    public function update(Request $request, ExpenseCategory $expenseCategory)
    {
        $this->authorize('update', $expenseCategory);

        $request->validate([
            'name' => 'required|string|max:255|unique:expense_categories,name,' . $expenseCategory->id . ',id,user_id,' . Auth::id(),
            'description' => 'nullable|string|max:500',
        ]);

        $expenseCategory->update($request->only('name', 'description'));

        return redirect()->route('expense-categories.index')->with('success', 'Categoría de gasto actualizada exitosamente.');
    }

    /**
     * Elimina una categoría de gasto.
     */
    public function destroy(ExpenseCategory $expenseCategory)
    {
        $this->authorize('delete', $expenseCategory);

        $expenseCategory->delete();

        return redirect()->route('expense-categories.index')->with('success', 'Categoría de gasto eliminada exitosamente.');
    }
}
