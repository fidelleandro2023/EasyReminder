<?php 
namespace App\Http\Controllers; 
use App\Models\Reminder;
use App\Models\Payment;
use App\Models\RecurringPayment;  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReminderController extends Controller
{
    /**
     * Lista los recordatorios del usuario autenticado.
     */
    public function index()
    {
        $reminders = Reminder::with(['payment', 'recurringPayment', 'user'])
            ->where('user_id', Auth::id())
            ->paginate(10); 

        return view('reminders.index', compact('reminders'));
    }

    /**
     * Muestra el formulario para crear un nuevo recordatorio.
     */
    public function create()
    {
        $payments = Payment::where('user_id', Auth::id())->get();
        $recurringPayments = RecurringPayment::where('user_id', Auth::id())->get(); // Obtener pagos recurrentes

        return view('reminders.create', compact('payments', 'recurringPayments'));
    }

    /**
     * Almacena un nuevo recordatorio en la base de datos.
     */ 
    public function store(Request $request)
    { 
        $filtered_reminder_types = array_filter($request->reminder_types ?? [], function ($value) {
            return !is_null($value);
        });
    
        $request->merge([
            'reminder_types' => $filtered_reminder_types,
            'reminder_date' => $request->reminder_date ?? now()->toDateString()  
        ]);
    
        // dd(json_encode($filtered_reminder_types));
        // dd($request);
        
        $request->validate([
            'payment_id' => 'nullable|exists:payments,id',
            'recurring_payment_id' => 'nullable|exists:recurring_payments,id',
            'reminder_types' => 'nullable|array',
            'reminder_types.*' => 'in:email,push,sms',
            'status' => 'required|in:active,inactive',
            'reminder_date' => 'required|date',
        ]);
    
        if (!$request->payment_id && !$request->recurring_payment_id) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['payment_id' => 'Debe seleccionar al menos un pago único o un pago recurrente.']);
        }
    
        Reminder::create([
            'user_id' => Auth::id(),
            'payment_id' => $request->payment_id,
            'recurring_payment_id' => $request->recurring_payment_id,
            'reminder_types' => json_encode($filtered_reminder_types),
            'status' => $request->status,
            'reminder_date' => $request->reminder_date,  
        ]);
    
        return redirect()->route('reminders.index')->with('success', 'Recordatorio creado exitosamente.');
    }
     
    /**
     * Muestra los detalles de un recordatorio específico.
     */
    public function show(Reminder $reminder)
    {
        $this->authorize('view', $reminder);

        return view('reminders.show', compact('reminder'));
    }

    /**
     * Muestra el formulario para editar un recordatorio.
     */
    public function edit(Reminder $reminder)
    {
        //$this->authorize('update', $reminder);
        $payments = Payment::where('user_id', Auth::id())
                           ->get();
        $recurringPayments = RecurringPayment::where('user_id', Auth::id())
                                             ->get();  

        return view('reminders.edit', compact('reminder', 'payments', 'recurringPayments'));
    }

    /**
     * Actualiza un recordatorio en la base de datos.
     */
    public function update(Request $request, Reminder $reminder)
    {
        $this->authorize('update', $reminder);

        $request->validate([
            'payment_id' => 'nullable|exists:payments,id',
            'recurring_payment_id' => 'nullable|exists:recurring_payments,id',
            'reminder_types' => 'required|array',
            'reminder_types.*' => 'in:email,push,sms',
            'status' => 'required|in:active,inactive',
            'reminder_date' => 'required|date',
        ]);

        $reminder->update([
            'payment_id' => $request->payment_id,
            'recurring_payment_id' => $request->recurring_payment_id,
            'reminder_types' => json_encode($request->reminder_types),
            'status' => $request->status,
            'reminder_date' => $request->reminder_date,
        ]);

        return redirect()->route('reminders.index')->with('success', 'Recordatorio actualizado exitosamente.');
    }

    /**
     * Elimina un recordatorio.
     */
    public function destroy(Reminder $reminder)
    {
        $this->authorize('delete', $reminder);

        $reminder->delete();

        return redirect()->route('reminders.index')->with('success', 'Recordatorio eliminado exitosamente.');
    }
}
