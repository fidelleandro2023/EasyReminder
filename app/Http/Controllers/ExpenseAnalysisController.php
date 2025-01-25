<?php
namespace App\Http\Controllers;
use App\Models\ExpenseAnalysis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseAnalysisController extends Controller
{
    /**
     * Lista los análisis de gastos del usuario autenticado.
     */
    public function index()
    {
        $expenseAnalyses = ExpenseAnalysis::where('user_id', Auth::id())->get();

        return view('expense_analysis.index', compact('expenseAnalyses'));
    }

    /**
     * Muestra el formulario para crear un nuevo análisis de gastos.
     */
    public function create()
    {
        return view('expense_analysis.create');
    }

    /**
     * Almacena un nuevo análisis de gastos en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|string|max:255',
            'total_spent' => 'required|numeric|min:0',
            'period' => 'required|string|max:100',
        ]);

        ExpenseAnalysis::create([
            'user_id' => Auth::id(),
            'category' => $request->category,
            'total_spent' => $request->total_spent,
            'period' => $request->period,
        ]);

        return redirect()->route('expense-analysis.index')->with('success', 'Análisis de gasto creado exitosamente.');
    }

    /**
     * Muestra los detalles de un análisis de gastos específico.
     */
    public function show(ExpenseAnalysis $expenseAnalysis)
    {
        $this->authorize('view', $expenseAnalysis);

        return view('expense_analysis.show', compact('expenseAnalysis'));
    }

    /**
     * Elimina un análisis de gastos.
     */
    public function destroy(ExpenseAnalysis $expenseAnalysis)
    {
        $this->authorize('delete', $expenseAnalysis);

        $expenseAnalysis->delete();

        return redirect()->route('expense-analysis.index')->with('success', 'Análisis de gasto eliminado exitosamente.');
    }
}
