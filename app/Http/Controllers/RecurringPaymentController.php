<?php
namespace App\Http\Controllers;
use App\Models\RecurringPayment;
use App\Models\ServiceEntity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecurringPaymentController extends Controller
{
    /**
     * Lista los pagos recurrentes del usuario autenticado.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {  
            $recurringPayments = RecurringPayment::with('serviceEntity') 
                                                 ->paginate(10); 
        } else { 
            $recurringPayments = RecurringPayment::with('serviceEntity')
                                                 ->where('user_id', Auth::id())
                                                 ->paginate(10); 
        }

        return view('recurring_payments.index', compact('recurringPayments'));
    }

    /**
     * Muestra el formulario para crear un nuevo pago recurrente.
     */
    public function create()
    {
        $categories = ServiceEntity::whereNull('parent_id')
                                   ->with('services')->paginate(10);
                                   
        return view('recurring_payments.create', compact('categories'));
    }

    /**
     * Almacena un nuevo pago recurrente en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'service_entity_id' => 'required|exists:service_entity,id',
            'amount' => 'required|numeric|min:0.01',
            'frequency' => 'required|in:daily,weekly,monthly,yearly',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'nullable|date|after:start_date',
        ]);

        RecurringPayment::create([
            'user_id' => Auth::id(),
            'service_entity_id' => $request->service_entity_id,
            'amount' => $request->amount,
            'frequency' => $request->frequency,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => 'active',
        ]);

        return redirect()->route('recurring_payments.index')->with('success', 'Pago recurrente creado exitosamente.');
    }

    /**
     * Muestra los detalles de un pago recurrente específico.
     */
    public function show(RecurringPayment $recurringPayment)
    {
        $this->authorize('view', $recurringPayment);

        return view('recurring_payments.show', compact('recurringPayment'));
    }

    /**
     * Muestra el formulario para editar un pago recurrente.
     */
    public function edit(RecurringPayment $recurringPayment)
    {
        $categories = ServiceEntity::whereNull('parent_id')->with('services')->get();
        $this->authorize('update', $recurringPayment);

        //$services = ServiceEntity::all();
        return view('recurring_payments.edit', compact('recurringPayment', 'categories'));
    }

    /**
     * Actualiza un pago recurrente en la base de datos.
     */
    public function update(Request $request, RecurringPayment $recurringPayment)
    {
        $this->authorize('update', $recurringPayment);

        $request->validate([
            'service_entity_id' => 'required|exists:service_entity,id',
            'amount' => 'required|numeric|min:0.01',
            'frequency' => 'required|in:daily,weekly,monthly,yearly',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'nullable|date|after:start_date',
            'status' => 'required|in:active,inactive',
        ]);

        $recurringPayment->update($request->all());

        return redirect()->route('recurring_payments.index')->with('success', 'Pago recurrente actualizado exitosamente.');
    }

    /**
     * Elimina un pago recurrente.
     */
    public function destroy(RecurringPayment $recurringPayment)
    {
        $this->authorize('delete', $recurringPayment);

        $recurringPayment->delete();

        return redirect()->route('recurring-payments.index')->with('success', 'Pago recurrente eliminado exitosamente.');
    }
}
