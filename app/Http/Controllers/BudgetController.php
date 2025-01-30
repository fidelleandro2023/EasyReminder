<?php
namespace App\Http\Controllers;
use App\Models\Budget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BudgetController extends Controller
{
    /**
     * Lista los presupuestos del usuario autenticado con paginación.
     */
    public function index()
    {
        $budgets = Budget::where('user_id', Auth::id())->paginate(10);

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
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'required|in:active,inactive',
        ]);

        Budget::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'description' => $request->description,
            'amount' => $request->amount,
            'spent' => 0,  
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status,
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
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'required|in:active,inactive',
        ]);

        // Si el nuevo monto es menor a lo que ya se ha gastado, prevenir error
        if ($request->amount < $budget->spent) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['amount' => 'El monto total no puede ser menor a lo que ya se ha gastado.']);
        }

        $budget->update($request->only('name', 'description', 'amount', 'start_date', 'end_date', 'status'));

        return redirect()->route('budgets.index')->with('success', 'Presupuesto actualizado exitosamente.');
    }

    /**
     * Elimina un presupuesto de manera lógica (soft delete).
     */
    public function destroy(Budget $budget)
    {
        $this->authorize('delete', $budget);

        $budget->delete(); // Soft delete

        return redirect()->route('budgets.index')->with('success', 'Presupuesto eliminado exitosamente.');
    }
}
