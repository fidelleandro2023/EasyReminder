<?php
namespace App\Http\Controllers;
use App\Models\Reminder;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReminderController extends Controller
{
    /**
     * Lista los recordatorios del usuario autenticado.
     */
    public function index()
    {
        $reminders = Reminder::with(['payment', 'user'])
            ->where('user_id', Auth::id())
            ->get();

        return view('reminders.index', compact('reminders'));
    }

    /**
     * Muestra el formulario para crear un nuevo recordatorio.
     */
    public function create()
    {
        $payments = Payment::where('user_id', Auth::id())->get();

        return view('reminders.create', compact('payments'));
    }

    /**
     * Almacena un nuevo recordatorio en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'payment_id' => 'required|exists:payments,id',
            'reminder_type' => 'required|in:email,push,sms',
            'status' => 'required|in:active,inactive',
        ]);

        Reminder::create([
            'user_id' => Auth::id(),
            'payment_id' => $request->payment_id,
            'reminder_type' => $request->reminder_type,
            'status' => $request->status,
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
        $this->authorize('update', $reminder);

        $payments = Payment::where('user_id', Auth::id())->get();

        return view('reminders.edit', compact('reminder', 'payments'));
    }

    /**
     * Actualiza un recordatorio en la base de datos.
     */
    public function update(Request $request, Reminder $reminder)
    {
        $this->authorize('update', $reminder);

        $request->validate([
            'payment_id' => 'required|exists:payments,id',
            'reminder_type' => 'required|in:email,push,sms',
            'status' => 'required|in:active,inactive',
        ]);

        $reminder->update($request->all());

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
