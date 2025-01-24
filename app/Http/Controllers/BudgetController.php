<?php
namespace App\Http\Controllers;
use App\Models\Budget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BudgetController extends Controller
{
    /**
     * Lista los presupuestos del usuario autenticado.
     */
    public function index()
    {
        $budgets = Budget::where('user_id', Auth::id())->get();

        return view('budgets.index', compact('budgets'));
    }

    /**
     * Muestra el formulario para crear un nuevo presupuesto.
     */
    public function create()
    {
        return view('budgets.create');
    }

    /**
     * Almacena un nuevo presupuesto en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'amount' => 'required|numeric|min:0.01',
        ]);

        Budget::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'description' => $request->description,
            'amount' => $request->amount,
            'spent' => 0,  
        ]);

        return redirect()->route('budgets.index')->with('success', 'Presupuesto creado exitosamente.');
    }

    /**
     * Muestra los detalles de un presupuesto específico.
     */
    public function show(Budget $budget)
    {
        $this->authorize('view', $budget); 

        return view('budgets.show', compact('budget'));
    }

    /**
     * Muestra el formulario para editar un presupuesto.
     */
    public function edit(Budget $budget)
    {
        $this->authorize('update', $budget);  

        return view('budgets.edit', compact('budget'));
    }

    /**
     * Actualiza un presupuesto en la base de datos.
     */
    public function update(Request $request, Budget $budget)
    {
        $this->authorize('update', $budget);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'amount' => 'required|numeric|min:0.01',
        ]);

        $budget->update($request->only('name', 'description', 'amount'));

        return redirect()->route('budgets.index')->with('success', 'Presupuesto actualizado exitosamente.');
    }

    /**
     * Elimina un presupuesto.
     */
    public function destroy(Budget $budget)
    {
        $this->authorize('delete', $budget);

        $budget->delete();

        return redirect()->route('budgets.index')->with('success', 'Presupuesto eliminado exitosamente.');
    }
}
