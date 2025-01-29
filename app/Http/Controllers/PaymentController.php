<?php

namespace App\Http\Controllers;
use App\Models\Payment;
use App\Models\ServiceEntity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * Mostrar la lista de pagos.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {  
            $payments = Payment::notDeleted()
                                ->with('user', 'serviceEntity')
                                ->orderBy('due_date', 'asc')
                                ->paginate(10);
        } else { 
            $payments = Payment::notDeleted()
                                ->with('user', 'serviceEntity')
                                ->where('user_id', $user->id)  
                                ->orderBy('due_date', 'asc')
                                ->paginate(10); 
        }

        return view('payments.index', compact('payments'));
    }

    /**
     * Mostrar el formulario para crear un nuevo pago.
     */
    public function create()
    {
        $categories = ServiceEntity::whereNull('parent_id')
        ->with('services')
        ->get();

        return view('payments.create', compact('categories'));
    }

    /**
     * Guardar un nuevo pago en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'service_entity_id' => 'required|exists:service_entity,id',
            'amount' => 'required|numeric|min:0.01',
            'due_date' => 'required|date|after_or_equal:today',
        ]);

        Payment::create([
            'user_id' => Auth::id(),
            'service_entity_id' => $request->service_entity_id,
            'amount' => $request->amount,
            'due_date' => $request->due_date,
            'status' => 'pending',
        ]);

        return redirect()->route('payments.index')->with('success', 'Pago creado exitosamente.');
    }

    /**
     * Mostrar el formulario para editar un pago existente.
     */
    public function edit(Payment $payment)
    {
        $this->authorize('update', $payment);

        $services = ServiceEntity::all();
        return view('payments.edit', compact('payment', 'services'));
    }

    /**
     * Actualizar un pago en la base de datos.
     */
    public function update(Request $request, Payment $payment)
    {
        $this->authorize('update', $payment);

        $request->validate([
            'service_entity_id' => 'required|exists:service_entity,id',
            'amount' => 'required|numeric|min:0.01',
            'due_date' => 'required|date|after_or_equal:today',
            'status' => 'required|in:pending,paid,overdue',
        ]);

        $payment->update($request->only('service_entity_id', 'amount', 'due_date', 'status'));

        return redirect()->route('payments.index')->with('success', 'Pago actualizado exitosamente.');
    }

    /**
     * Eliminar un pago.
     */
    public function destroy(Payment $payment)
    {
        $this->authorize('delete', $payment);

        $payment->delete(); 
    
        return redirect()->route('payments.index')->with('success', 'Pago eliminado exitosamente.');
    }
}
