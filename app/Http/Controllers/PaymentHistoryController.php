<?php
namespace App\Http\Controllers;
use App\Models\PaymentHistory;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentHistoryController extends Controller
{
    /**
     * Lista los historiales de pagos.
     */
    public function index()
    {
        $paymentHistories = PaymentHistory::with(['payment', 'user'])
            ->orderBy('paid_date', 'desc')
            ->get();

        return view('payment_histories.index', compact('paymentHistories'));
    }

    /**
     * Muestra el formulario para registrar un nuevo historial de pago.
     */
    public function create()
    {
        $payments = Payment::where('status', 'pending')->get();

        return view('payment_histories.create', compact('payments'));
    }

    /**
     * Almacena un historial de pago en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'payment_id' => 'required|exists:payments,id',
            'paid_date' => 'required|date|before_or_equal:today',
            'amount_paid' => 'required|numeric|min:0.01',
            'payment_method' => 'required|string|max:255',
        ]);
 
        PaymentHistory::create($request->all());
  
        $payment = Payment::find($request->payment_id);
        $payment->update(['status' => 'paid']);

        return redirect()->route('payment_histories.index')->with('success', 'Historial de pago registrado exitosamente.');
    }

    /**
     * Muestra los detalles de un historial de pago específico.
     */
    public function show(PaymentHistory $paymentHistory)
    {
        return view('payment_histories.show', compact('paymentHistory'));
    }

    /**
     * Elimina un historial de pago.
     */
    public function destroy(PaymentHistory $paymentHistory)
    {
        $paymentHistory->delete();

        return redirect()->route('payment_histories.index')->with('success', 'Historial de pago eliminado exitosamente.');
    }
}
